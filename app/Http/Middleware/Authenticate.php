<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (!Auth::check()) {
            $path = $request->path();
            if (str_starts_with($path, 'admin')) {
                return redirect()->route('admin.login');
            }
            if (str_starts_with($path, 'instructor')) {
                return redirect()->route('instructor.login');
            }
            return redirect()->route('student.login');
        }

        return $next($request);
    }
}
