<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is logged in as a doctor AND their username is 'admin'
        if (Session::has('dokter_nama') && Session::get('dokter_nama') === 'admin') {
            return $next($request);
        }

        // Redirect to the doctor login if not an admin
        return redirect()->route('dokter.loginForm')->with('error', 'Unauthorized access.');
    }
}
