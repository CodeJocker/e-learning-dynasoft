<?php

namespace App\Http\Controllers\Instructor\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('instructor.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            // Check if user is instructor
            if (auth()->user()->role !== 'instructor') {
                auth()->logout();
                return back()->withErrors(['email' => 'Only instructors can login here'])->onlyInput('email');
            }

            return redirect()->route('instructor.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }
}
