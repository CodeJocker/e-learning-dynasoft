<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('student')->user();

        // If user is not verified, redirect to verification notice
        if ($user && !$user->is_verified) {
            $email = $user->email;
            auth('student')->logout();
            return redirect()->route('student.showVerifyForm', ['email' => $email])
                             ->with('error', 'Please verify your email first.');
        }

        return $next($request);
    }
}
