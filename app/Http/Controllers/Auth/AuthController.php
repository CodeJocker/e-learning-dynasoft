<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use App\Mail\OTPMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;


class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Generate OTP
        $otp = rand(100000, 999999);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->name,
            'email' => $request->email,
            'otp' => $otp,
            'password' => Hash::make($request->password),
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
            \Log::error('OTP Mail Error: ' . $e->getMessage());
        }

        return redirect()->route('student.showVerifyForm', ['email' => $user->email])
                        ->with('success', 'Account created! OTP sent to your email.');
    }
}
