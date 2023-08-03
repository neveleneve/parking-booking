<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use App\Models\Slot;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
            $data = Transaksi::paginate(10);
        } elseif (Auth::user()->level == '1') {
            $data = Transaksi::where('user_id', Auth::user()->id)->paginate(10);
        }
        return view('authenticate.transaksi.index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        $slot = Slot::all();
        $saldo = Saldo::where('user_id', Auth::user()->id)->first();
        return view('authenticate.transaksi.create', [
            'slot' => $slot,
            'saldo' => $saldo,
        ]);
    }

    public function store(Request $request)
    {
        $validasi =  Validator::make($request->all(), [
            'slot' => 'required|numeric',
            'tanggal' => 'required|date|after:' . date('Y-m-d H:i:s'),
            'credit' => 'required|numeric|gte:minimum',
            'agreement' => 'required|numeric',
        ]);
        if ($validasi->fails()) {
            return redirect(route('transaksi.create'))->with([
                'alert' => 'Ada kesalahan dalam pemesanan. Silakan ulangi!',
                'color' => 'danger',
            ]);
        } else {
            $slot = Slot::find($request->slot);
            if ($slot->is_booked) {
                return redirect(route('transaksi.create'))->with([
                    'alert' => $slot->name . ' sudah dipesan. Silakan pesan slot lain yang belum dipesan!',
                    'color' => 'danger',
                ]);
            }
            if (!$slot->status) {
                return redirect(route('transaksi.create'))->with([
                    'alert' => $slot->name . ' sedang tidak aktif. Silakan pesan slot lain yang aktif!',
                    'color' => 'danger',
                ]);
            }

            $slot->update([
                'is_booked' => true,
                'booking_date' => date('Y-m-d H:i:s', strtotime($request->tanggal)),
            ]);
            Saldo::where('user_id', Auth::user()->id)->decrement('credit', 20000);
            Transaksi::create([
                'kode_transaksi' => $this->randomString(5),
                'user_id' => Auth::user()->id,
                'slot_id' => $slot->id,
                'status' => '0',
            ]);
            return redirect(route('transaksi.index'))->with([
                'alert' => 'Berhasil melakukan pemesanan slot parkir',
                'color' => 'success',
            ]);
        }
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
