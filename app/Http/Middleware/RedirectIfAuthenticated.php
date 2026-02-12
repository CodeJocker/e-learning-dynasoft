<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::check()) {
            $role = Auth::user()->role ?? null;
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            if ($role === 'instructor') {
                return redirect()->route('instructor.dashboard');
            }
            return redirect()->route('student.dashboard');
        }

        return $next($request);
    }
}
