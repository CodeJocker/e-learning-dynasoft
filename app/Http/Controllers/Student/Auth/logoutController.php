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
        // Log the user out of the 'student' guard
        Auth::guard('student')->logout();

        // Invalidate the user's session to prevent reuse
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent fixation attacks
        $request->session()->regenerateToken();

        // Redirect to the student login page with a success message
        return redirect()->route('student.login')
            ->with('success', 'You have been logged out successfully.');
    }
}
