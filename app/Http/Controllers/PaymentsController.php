<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentsController extends Controller {
    public function __construct() {
        $this->middleware('auth');
        Config::$serverKey = config('midtrans.serverKey');
        Config::$clientKey = config('midtrans.clientKey');
        Config::$isProduction = config('midtrans.isProduction');
    }

    public function index() {
        if (Auth::user()->level == '0') {
            $data = Pembayaran::with('user')
                ->orderBy('created_at')
                ->get();
        } elseif (Auth::user()->level == '1') {
            $data = Pembayaran::where('user_id', Auth::user()->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }
        return view('authenticate.payments.index', [
            'data' => $data
        ]);
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
    }

    public function show($id) {
        $data = Pembayaran::where('order_id', $id)
            ->first();
        return view('authenticate.payments.show', [
            'data' => $data
        ]);
    }

    public function edit($id) {
        $data = Pembayaran::where('order_id', $id)
            ->first();
        if ($data->status == '3' || $data->status == '2') {
            Alert::warning('Tidak Bisa Akses', 'Pembayaran sudah selesai!');
            return redirect(route('pembayaran.index'));
        } else {
            return view('authenticate.payments.edit', [
                'data' => $data
            ]);
        }
    }

    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }
}
