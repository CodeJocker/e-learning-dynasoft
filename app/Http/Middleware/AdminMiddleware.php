<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 1. If not logged in, redirect to login
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'Please login first.');
        }

        // 2. If logged in but not an admin, redirect
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('admin.login')->with('error', 'Unauthorized access.');
        }

        $response = $next($request);

        // 3. FORCE NO-CACHE (The fix for your issue)
        // This tells the browser: "Do not store this page in memory. Always ask the server."
        return $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
                        ->header('Pragma', 'no-cache')
                        ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
    }
}