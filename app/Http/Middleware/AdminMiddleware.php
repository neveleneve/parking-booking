<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->level == '0') {
                return $next($request);
            } else {
                return redirect(route('login'));
            }
        } else {
            return redirect(route('login'));
        }
    }
}
