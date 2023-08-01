<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Saldo;
use App\Models\Slot;
use App\Models\Transaksi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;

class TopUpController extends Controller
{
    public function __construct()
    {
        $this->middleware('customer');
        Config::$serverKey = config('midtrans.serverKey');
        Config::$clientKey = config('midtrans.clientKey');
        Config::$isProduction = config('midtrans.isProduction');
    }

    public function index(Request $request)
    {
        $request->validate([
            'total' => 'required|numeric|min:20000'
        ]);

        $transactionDetails = [
            'order_id' => uniqid() . $this->randomString(5),
            'gross_amount' => $request->total,
        ];

        $snapToken = Snap::getSnapToken([
            'transaction_details' => $transactionDetails,
            "customer_details" => [
                "first_name" => Auth::user()->name,
                "email" => Auth::user()->email,
            ]
        ]);

        Pembayaran::create([
            'user_id' => Auth::user()->id,
            'order_id' => $transactionDetails['order_id'],
            'nominal' => $transactionDetails['gross_amount'],
            'snap_token' => $snapToken,
            'status' => '0',
            'status_code' => null,
            'transaction_status' => null,
        ]);

        return view('authenticate.topup.index', [
            'data' => $transactionDetails,
            'snapToken' => $snapToken,
        ]);
    }

    public function paymentFinish(Request $request)
    {
        $statusResponse = Transaction::status($request->order_id);
        try {
            $paymentStatus = $statusResponse->transaction_status;
            if ($statusResponse->status_code == '200') {
                if ($paymentStatus === 'capture' || $paymentStatus === 'settlement') {
                    $data = Pembayaran::where('order_id', $request->order_id)->first();
                    if ($data->status != 3) {
                        Pembayaran::where('order_id', $request->order_id)
                            ->update([
                                'status' => '3',
                                'status_code' => $statusResponse->status_code,
                                'transaction_status' => $statusResponse->transaction_status,
                            ]);
                        Saldo::where('user_id', Auth::user()->id)->increment('credit', $data->nominal);
                    }
                    return view('authenticate.payments.finish');
                } elseif ($paymentStatus === 'pending') {
                    Pembayaran::where('order_id', $request->order_id)
                        ->update([
                            'status' => '1',
                            'status_code' => $request->status_code,
                            'transaction_status' => $request->transaction_status,
                        ]);
                } else {
                    Pembayaran::where('order_id', $request->order_id)
                        ->update([
                            'status' => '1',
                            'status_code' => $request->status_code,
                            'transaction_status' => $request->transaction_status,
                        ]);
                }
            } else {
                Pembayaran::where('order_id', $request->order_id)
                    ->update([
                        'status' => '1',
                        'status_code' => $statusResponse->status_code,
                        'transaction_status' => $statusResponse->transaction_status,
                    ]);
                return redirect(route('payments.index'))->with([
                    'alert' => 'Berhasil membatalkan top up!',
                    'color' => 'success',
                ]);
            }
        } catch (Exception $e) {
            dd([5, $e]);
            // echo 'Error: ' . $e->getMessage();
        }
    }

    public function paymentUnfinish(Request $request)
    {
        dd($request->all());
    }

    public function paymentError(Request $request)
    {
        dd($request->all());
    }

    public function control($id)
    {
        $transaksi = Transaksi::with('slot')->find($id);
        return view('authenticate.transaksi.control', [
            'data' => $transaksi
        ]);
    }

    public function controlUpdate(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'id' => 'required',
            'kode_transaksi' => 'required',
            'status_pakai' => 'required',
        ]);
        if ($validasi->fails()) {
            return redirect(route('transaksi.control', ['id' => $request->id]))->with([
                'alert' => 'Gagal melakukan kendali. Silakan ulangi!',
                'color' => 'danger',
            ]);
        } else {
            $transaksi = Transaksi::find($request->id);
            $slot = Slot::find($transaksi->slot_id);
            $alert = [
                'alert' => null,
                'color' => null,
            ];
            if ($request->status_pakai == 0) {
                $slot->update([
                    'status_pakai' => '1'
                ]);
                $alert = [
                    'alert' => 'Berhasil membuka palang!',
                    'color' => 'success',
                ];
            } elseif ($request->status_pakai == 1) {
                $slot->update([
                    'status_pakai' => '2'
                ]);
                $alert = [
                    'alert' => 'Berhasil mennutup palang!',
                    'color' => 'success',
                ];
            } elseif ($request->status_pakai == 2) {
                $slot->update([
                    'status_pakai' => '3'
                ]);
                $alert = [
                    'alert' => 'Berhasil membuka palang!',
                    'color' => 'success',
                ];
            } elseif ($request->status_pakai == 3) {
                $slot->update([
                    'status_pakai' => '0'
                ]);
                $transaksi->update([
                    'status' => '1'
                ]);
                $alert = [
                    'alert' => 'Berhasil mennutup palang!',
                    'color' => 'success',
                ];
            }
            return redirect(route('transaksi.control', ['id' => $request->id]))->with($alert);
        }
    }

    public function paymentCancellation(Request $request)
    {
        Pembayaran::where('order_id', $request->order_id)->delete();
        return redirect(route('payments.index'))->with([
            'alert' => 'Berhasil membatalkan top up!',
            'color' => 'success',
        ]);
    }

    public function randomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = rand(0, strlen($characters) - 1);
            $string .= $characters[$randomIndex];
        }
        return $string;
    }
}
