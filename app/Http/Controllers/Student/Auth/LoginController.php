<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt authentication with student guard
        if (Auth::guard('student')->attempt($request->only('email', 'password'))) {
            $user = Auth::guard('student')->user();

            // Check if email is verified
            if (!$user->is_verified) {
                Auth::guard('student')->logout();
                return redirect()->route('student.showVerifyForm', ['email' => $user->email])
                                 ->with('error', 'Please verify your email first. Check your inbox for the OTP code.');
            }

            $request->session()->regenerate();
            return redirect()->route('student.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->onlyInput('email');
    }
}
