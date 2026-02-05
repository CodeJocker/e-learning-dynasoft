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

        // If user is not verified, redirect to verification notice
        if ($user && !$user->is_verified) {
            return redirect()->route('verification.notice');
        }

        return $next($request);
    }
}
