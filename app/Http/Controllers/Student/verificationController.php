<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    public function showVerifyForm($email)
    {
        return view('student.auth.verify_otp', ['email' => $email]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email', 
            'otp' => 'required|numeric'
        ]);

        $user = User::where('email', $request->email)
                    ->where('otp', $request->otp)
                    ->first();
                    dd($user);

        if (!$user) {
            return back()->with('error', 'Invalid OTP code.');
        }

        $user->update([
            'is_verified' => true,
            'email_verified_at' => now(), 
            'otp' => null
        ]);

        return redirect()->route('student.login')
                         ->with('success', 'Email verified! Please login.');
    }

    public function resendOtp($email)
    {
        $user = User::where('email', $email)->first();
        if (!$user) return back()->with('error', 'User not found.');

        $newOtp = rand(100000, 999999);
        $user->update(['otp' => $newOtp]);
        Mail::to($user->email)->send(new OTPMail($newOtp));

        return back()->with('success', 'A new OTP has been sent.');
    }
}
