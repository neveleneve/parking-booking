<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProfilController extends Controller {
    public function index() {
        return view('authenticate.profil.index');
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        return view('authenticate.profil.edit');
    }

    public function update(Request $request, $profil) {
        // dd($request->all());
        $data = User::find($profil);
        $data->update([
            'name' => $request->nama
        ]);
        Alert::success('Berhasil', 'Berhasil mengubah data profil!');
        return redirect(route('profil.index'));
    }

    public function destroy($id) {
        //
    }
}
