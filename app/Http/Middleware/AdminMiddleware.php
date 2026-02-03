<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
public function handle(Request $request, Closure $next)
{
    // Check 1: Is anyone even logged in?
    if (!Auth::check()) {
        return redirect()->route('admin.login')
            ->with('error', 'Please login to access the dashboard.');
    }

    // Check 2: They are logged in, but are they an Admin?
    if (Auth::user()->role !== 'admin') {
        // Log them out if they tried to sneak into admin area
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login')
            ->with('error', 'Unauthorized access.');
    }

    // Check 3: Add No-Cache headers so the "Back" button fails
    $response = $next($request);
    
    return $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
                    ->header('Pragma', 'no-cache')
                    ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
}
}
