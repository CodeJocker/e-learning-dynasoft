<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Log the student out of the application.
     */
    public function studentLogout(Request $request)
    {
        // 1. Log the user out of the 'web' guard
        Auth::logout();

        // 2. Invalidate the user's session to prevent reuse
        $request->session()->invalidate();

        // 3. Regenerate the CSRF token to prevent fixation attacks
        $request->session()->regenerateToken();

        // 4. Redirect to the student login page with a success message
        return redirect()->route('student.login')
            ->with('success', 'You have been logged out successfully.');
    }
}