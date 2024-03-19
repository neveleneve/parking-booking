<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware {
    public function handle(Request $request, Closure $next) {
        if (Auth::check()) {
            if (Auth::user()->level == '1') {
                return $next($request);
            } else {
                // return redirect(route('login'));
                abort(401);
            }
        } else {
            return redirect(route('login'));
        }
    }
}
