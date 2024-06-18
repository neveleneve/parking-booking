<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        if (Auth::user()->level == '0') {
            $data = Transaksi::whereDate('created_at', date('Y-m-d'))->get();
            $view = 'authenticate.dashboard.admin.index';
        } elseif (Auth::user()->level == '1') {
            $data = User::find(Auth::user()->id);
            $view = 'authenticate.dashboard.customer.index';
        }
        return view($view, [
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
        //
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }
}
