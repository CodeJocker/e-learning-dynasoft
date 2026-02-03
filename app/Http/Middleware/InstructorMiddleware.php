<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('instructor.login');
        }

        // 2. Check if logged-in user is an instructor
        if (Auth::user()->role !== 'instructor') {
            abort(403, 'Unauthorized access. Instructor access required.');
        }

        return $next($request);
    }
}
