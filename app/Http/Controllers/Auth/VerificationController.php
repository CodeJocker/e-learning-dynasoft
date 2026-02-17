<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    //
     public function showVerifyForm($email)
    {
        return view('auth.verify_otp', ['email' => $email]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email', 
            'otp' => 'required|numeric|digits:6'
        ]);

        $user = User::where('email', $request->email)
                    ->where('otp', $request->otp)
                    ->first();

        if (!$user) {
            return back()->with('error', 'User not found !.');
        }

        $user->update([
            'is_verified' => true,
            'email_verified_at' => now(),
            'otp' => null
        ]);

        return redirect()->route('login')
                         ->with('success', 'Email verified! Please login.');
    }

    public function resendOtp(Request $request) 
    {
        $email = $request->validate([
            'email' => 'required|email',
        ]);
        
        $user = User::where('email', $email)->first();

        if (!$user) return back()->with('error', 'User not found.');
        
         if ($user->is_verified) {
            return redirect()->route('student.login')
                             ->with('info', 'Email is already verified. Please login.');
        }

        $newOtp = rand(100000, 999999);
        $user->update(['otp' => $newOtp]);
        
        Mail::to($user->email)->send(new \App\Mail\OTPMail($newOtp));

        return back()->with('success', 'A new OTP has been sent.');
    }

}
