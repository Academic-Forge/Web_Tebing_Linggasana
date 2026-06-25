<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // If user is logged in but not admin, redirect to katalog (don't logout)
        if (Auth::check()) {
            return redirect()->route('katalog.index')->with('error', 'Akses ditolak! Halaman ini hanya untuk Administrator.');
        }

        // Guest: redirect to login
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }
}
