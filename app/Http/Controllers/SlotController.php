<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SlotController extends Controller {
    public function __construct() {
        $this->middleware('admin');
    }

    public function index() {
        $data = Slot::get();
        return view('admin.slot.index', [
            'data' => $data
        ]);
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        $validasi = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validasi->fails()) {
            Alert::error('Gagal', 'Terjadi kesalahan ketika menambah slot parkir. Silakan ulang!');
            return redirect(route('slot.index'));
        } else {
            Slot::create([
                'name' => $request->name,
                'token' => $this->randomString(),
            ]);
            Alert::success('Berhasil', 'Berhasil menambah slot parkir!');
            return redirect(route('slot.index'));
        }
    }

    public function show(Slot $slot) {
        return view('admin.slot.show', [
            'data' => $slot
        ]);
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, Slot $slot) {
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'status' => 'required',
        ]);

        if ($validasi->fails()) {
            return redirect(route('slot.show', ['slot' => $slot->id]))
                ->with([
                    'alert' => 'Terjadi kesalahan ketika mengubah data slot parkir. Silakan ulangi!',
                    'color' => 'danger',
                ]);
        } else {
            $slot->update([
                'name' => $request->nama,
                'status' => $request->status,
            ]);
            Alert::success('Berhasil', 'Berhasil mengubah data slot parkir!');
            return redirect(route('slot.show', ['slot' => $slot->id]));
        }
    }

    public function destroy(Slot $slot) {
        //
    }
}
