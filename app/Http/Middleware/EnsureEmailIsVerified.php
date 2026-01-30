<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user && !$user->is_verified) {
            $email = $user->email;
            auth()->logout();
            return redirect()->route('student.otp.verify', ['email' => $email])
                             ->with('error', 'Please verify your email first.');
        }

        return $next($request);
    }
}
