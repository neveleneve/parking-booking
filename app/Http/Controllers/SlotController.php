<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SlotController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $data = Slot::get();
        return view('admin.slot.index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validasi->fails()) {
            return redirect(route('slot.index'))
                ->with([
                    'alert' => 'Terjadi kesalahan ketika menambah slot parkir. Silakan ulangi!',
                    'color' => 'danger',
                ]);
        } else {
            Slot::create([
                'name' => $request->name,
                'token' => $this->randomString(),
            ]);
            return redirect(route('slot.index'))
                ->with([
                    'alert' => 'Berhasil menambah slot parkir!',
                    'color' => 'success',
                ]);
        }
    }

    public function show($id)
    {
        $data = Slot::find($id);
        return view('admin.slot.show', [
            'data' => $data
        ]);
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
