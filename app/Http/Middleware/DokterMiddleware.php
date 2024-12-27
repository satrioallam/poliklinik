<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DokterMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('dokter_id')) {
            return redirect()->route('dokter.loginForm')
                ->with('error', 'Silakan login terlebih dahulu.');
        }
        return $next($request);
    }
}
