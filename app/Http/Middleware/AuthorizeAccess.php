<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthorizeAccess
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. If not logged in, redirect based on the URL they are trying to access
        if (!Auth::check()) {
            return $this->redirectToLogin($request);
        }

        $user = Auth::user();

        // 2. Fundamental Role Check
        // If the user's role is not in the list of roles allowed for this route...
        if (!in_array($user->role, $roles)) {
            Auth::logout();
            return $this->redirectToLogin($request)->with('error', 'Unauthorized access for your role.');
        }

        // 3. Role-Specific Logic (Verification, etc.)
        // We only perform these checks IF the user has already passed the role check above.
        
        // STUDENT: Must be verified
        if ($user->role === 'student' && !$user->is_verified) {
            $email = $user->email;
            Auth::logout();
            return redirect()->route('student.showVerifyForm', ['email' => $email])
                             ->with('error', 'Please verify your email first.');
        }

        // ADMIN/INSTRUCTOR: Add any specific secondary checks here if needed
        // (e.g., checking if an instructor account is 'active' by an admin)

        // 4. Proceed with the request
        $response = $next($request);

        // 5. Security: Prevent browser caching of sensitive authenticated pages
        return $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
                        ->header('Pragma', 'no-cache')
                        ->header('Expires', 'Sun, 02 Jan 1990 00:00:00 GMT');
    }

    /**
     * Helper to determine which login route to hit based on the URL path.
     */
    protected function redirectToLogin(Request $request)
    {
        if ($request->is('admin*')) {
            return redirect()->route('login');
        }

        if ($request->is('instructor*')) {
            return redirect()->route('login');
        }

        return redirect()->route('login');
    }
}