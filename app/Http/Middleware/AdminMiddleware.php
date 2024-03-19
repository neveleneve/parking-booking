<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminMiddleware {
    public function handle(Request $request, Closure $next) {
        if (Auth::check()) {
            if (Auth::user()->level == '0') {
                return $next($request);
            } else {
                // return redirect(route('login'));
                abort(401);
            }
        } else {
            Alert::warning('Kamu Belum Login!', 'Login dulu yaaa');
            return redirect(route('login'));
        }
    }
}
