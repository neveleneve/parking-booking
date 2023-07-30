<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;

class TransaksiController extends Controller
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
            $data = Transaksi::get();
        } elseif (Auth::user()->level == '1') {
            $data = Transaksi::where('user_id', Auth::user()->id)->get();
        }
        return view('authenticate.transaksi.index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        $slotParkir = Slot::all();
        return view('authenticate.transaksi.create', [
            'slot' => $slotParkir
        ]);
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
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
