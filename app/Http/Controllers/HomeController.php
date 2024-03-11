<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {
    public function index(Request $request) {
        return view('welcome');
    }

    public function edit() {
        return view('authenticate.profil.edit');
    }
}
