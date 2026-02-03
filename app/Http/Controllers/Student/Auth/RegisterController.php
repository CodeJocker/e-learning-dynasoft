<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use App\Mail\OTPMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('student.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $otp = rand(100000, 999999);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp' => $otp,
            'is_verified' => false,
            'role' => 'student',
        ]);

        // Create profile for the user
        Profile::create([
            'user_id' => $user->id,
            'bio' => null,
            'skills' => [],
            'privacy_setting' => 'public',
        ]);

        try {
            Mail::to($user->email)->send(new OTPMail($otp));
        } catch (\Exception $e) {
            // Log mail error but don't fail registration
            \Log::error('OTP Mail Error: ' . $e->getMessage());
        }

        return redirect()->route('student.otp.verify', ['email' => $user->email])
                         ->with('success', 'Account created! OTP sent to your email.');
    }
}

