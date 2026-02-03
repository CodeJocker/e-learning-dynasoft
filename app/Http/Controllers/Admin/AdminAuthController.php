<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role !== 'admin') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors([
                    'email' => 'Unauthorized access'
                ]);
            }
            $request->session()->regenerate(); // Add this line
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials'
        ]);
    }

    public function logout(Request $request)
    {

        Log::info('Logout method triggered for User: ' . (Auth::user()->email ?? 'Guest'));
        Auth::logout();

        Log::info('Session invalidated.');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // FIX: You must return the redirect to move the user to the login page
        return redirect()->route('admin.login');
    }
}
