<?php

namespace App\Http\Controllers;

use App\Helpers\TransactionHelper;
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
use RealRashid\SweetAlert\Facades\Alert;

class TopUpController extends Controller {
    public function __construct() {
        $this->middleware('customer');
        Config::$serverKey = config('midtrans.serverKey');
        Config::$clientKey = config('midtrans.clientKey');
        Config::$isProduction = config('midtrans.isProduction');
    }

    public function index(Request $request) {
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
            'transaction_status' => 'initiate',
        ]);

        return view('authenticate.topup.index', [
            'data' => $transactionDetails,
            'snapToken' => $snapToken,
        ]);
    }

    public function paymentFinish(Request $request) {
        $pembayaran = Pembayaran::where('order_id', $request->order_id)->first();
        $transaksi = Transaction::status($request->order_id);
        $helper = new TransactionHelper($request->order_id);
        $status = $helper->isDataShouldUpdate();
        if ($status) {
            $increase = $helper->isCreditIncrease();
            if ($increase) {
                Saldo::where('user_id', $pembayaran->user_id)->increment('credit', $transaksi->gross_amount);
            }
            $pembayaran->update([
                'status' => $helper->statusUpdate(),
                'transaction_status' => $transaksi->transaction_status
            ]);
        }
        $alert = $helper->alertStatus();
        alert($alert['title'], $alert['text'], $alert['type']);
        return redirect(route('pembayaran.index'));
    }

    public function paymentUnfinish(Request $request) {
        $pembayaran = Pembayaran::where('order_id', $request->order_id)->first();
        $transaksi = Transaction::status($request->order_id);
        $helper = new TransactionHelper($request->order_id);
        $status = $helper->isDataShouldUpdate();
        $increase = $helper->isCreditIncrease();
        if ($status) {
            if ($increase) {
                Saldo::where('user_id', $pembayaran->user_id)->increment('credit', $transaksi->gross_amount);
            }
            $pembayaran->update([
                'status' => $helper->statusUpdate(),
                'transaction_status' => $transaksi->transaction_status
            ]);
        }
        $alert = $helper->alertStatus();
        alert($alert['title'], $alert['text'], $alert['type']);
        // return redirect(route('dashboard.index'));
        return redirect(route('pembayaran.index'));
    }

    public function paymentError(Request $request) {
        $pembayaran = Pembayaran::where('order_id', $request->order_id)->first();
        $transaksi = Transaction::status($request->order_id);
        $helper = new TransactionHelper($request->order_id);
        $status = $helper->isDataShouldUpdate();
        if ($status) {
            $increase = $helper->isCreditIncrease();
            if ($increase) {
                Saldo::where('user_id', $pembayaran->user_id)->increment('credit', $transaksi->gross_amount);
            }
            $pembayaran->update([
                'status' => $helper->statusUpdate(),
                'transaction_status' => $transaksi->transaction_status
            ]);
        }
        $alert = $helper->alertStatus();
        alert($alert['title'], $alert['text'], $alert['type']);
        return redirect(route('pembayaran.index'));
    }

    public function control($id) {
        $transaksi = Transaksi::with('slot')->find($id);
        return view('authenticate.transaksi.control', [
            'data' => $transaksi
        ]);
    }

    public function controlUpdate(Request $request) {
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
                $transaksi->update([
                    'jam_masuk' => date('Y-m-d H:i:s')
                ]);
                $alert = [
                    'title' => '',
                    'message' => 'Sedang membuka palang! Menunggu respon sensor...',
                ];
            } elseif ($request->status_pakai == 1) {
                $slot->update([
                    'status_pakai' => '2'
                ]);
            } elseif ($request->status_pakai == 2) {
                $slot->update([
                    'status_pakai' => '3'
                ]);
                $transaksi->update([
                    'status' => '1',
                    'jam_keluar' => date('Y-m-d H:i:s')
                ]);
            } elseif ($request->status_pakai == 3) {
                $slot->update([
                    'is_booked' => '0',
                    'status_pakai' => '0',
                    'booking_date' => null
                ]);
            }
            Alert::info('Info Title', 'Info Message');
            return redirect(route('transaksi.control', ['id' => $request->id]));
        }
    }

    public function paymentCancellation(Request $request) {
        Transaction::cancel($request->order_id);
        Pembayaran::where('order_id', $request->order_id)->update([
            'status' => '3',
            'transaction_status' => 'cancel'
        ]);
        Alert::success('Berhasil!', 'Berhasil membatalkan pembayaran!');
        return redirect(route('pembayaran.index'));
    }

    public function randomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = rand(0, strlen($characters) - 1);
            $string .= $characters[$randomIndex];
        }
        return $string;
    }
}
