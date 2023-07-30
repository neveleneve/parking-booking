<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        Config::$serverKey = config('midtrans.serverKey');
        Config::$clientKey = config('midtrans.clientKey');
        Config::$isProduction = config('midtrans.isProduction');
    }

    public function index()
    {
        if (Auth::user()->level == '0') {
            $data = Pembayaran::get();
        } elseif (Auth::user()->level == '1') {
            $data = Pembayaran::where('user_id', Auth::user()->id)
                ->get();
        }
        return view('authenticate.payments.index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $data = Pembayaran::where('order_id', $id)
            ->first();
        return view('authenticate.payments.view', [
            'data' => $data
        ]);
    }

    public function edit($id)
    {
        // di edit ini, harus cek status pembayaran dulu. jika pembayaran sudah selesai, ubah statusnya lalu direct ke show. (belum diubah)
        $datapembayaran = Pembayaran::where('order_id', $id)
            ->first();
        $datauser = User::find($datapembayaran->user_id);
        $transactionDetails = [
            'order_id' => $datapembayaran->order_id,
            'gross_amount' => $datapembayaran->nominal,
        ];

        $snapToken = Snap::getSnapToken([
            'transaction_details' => $transactionDetails,
            "customer_details" => [
                "first_name" => $datauser->name,
                "email" => $datauser->email,
            ]
        ]);
        Pembayaran::where('order_id', $id)->update([
            'snap_token' => $snapToken
        ]);
        $data = Pembayaran::where('order_id', $id)
            ->first();
        return view('authenticate.payments.edit', [
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
