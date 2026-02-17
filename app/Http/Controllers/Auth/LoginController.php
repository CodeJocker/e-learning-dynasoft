<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    //
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

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                // 1. Handle Unverified Students
                if ($user->role === 'student' && !$user->is_verified) {
                    Auth::logout();
                    return redirect()->route('student.showVerifyForm', ['email' => $user->email])
                        ->with('error', 'Please verify your email first.');
                }

                $request->session()->regenerate();

                // 2. Role-Based Redirection
                return match($user->role) {
                    'student'    => redirect()->route('student.dashboard'),
                    'instructor' => redirect()->route('instructor.dashboard'),
                    'admin'      => redirect()->route('admin.dashboard'),
                    default      => redirect('/'),
                };
            }

            return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }
}
