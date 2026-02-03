<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentMiddleware
{
    public function handle(Request $request, Closure $next)
{
    if (!Auth::check()) {
        return redirect()->route('student.login');
    }

    if (Auth::user()->role !== 'student') {
        Auth::logout(); 
        return redirect()->route('student.login')->with('error', 'Unauthorized.');
    }

    if (!Auth::user()->is_verified) {
        $email = Auth::user()->email;
        return redirect()->route('student.otp.verify', ['email' => $email]);
    }

    return $next($request);
}
}
