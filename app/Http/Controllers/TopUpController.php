<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

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
            'order_id' => uniqid(),
            'gross_amount' => $request->total,
        ];

        $snapToken = Snap::getSnapToken([
            'transaction_details' => $transactionDetails
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
        dd($request->all());
    }

    public function paymentUnfinish(Request $request)
    {
        dd($request->all());
    }

    public function paymentError(Request $request)
    {
        dd($request->all());
    }
}
