<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;
use Carbon\Carbon;

class VerificationController extends Controller
{
    /**
     * Show the OTP input form.
     */
    public function showVerifyForm($email)
    {
        return view('auth.verify_otp', ['email' => $email]);
    }

    /**
     * Handle the OTP submission.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|numeric|digits:6',
        ]);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        // Check if OTP has expired (10 minutes validity)
        if ($user->otp_expires_at && Carbon::parse($user->otp_expires_at)->isPast()) {
            return back()->withErrors(['otp' => 'OTP has expired. Please request a new one.']);
        }

        // Check if OTP matches
        if ($user->otp == $request->otp) {
            $user->is_verified = true;
            $user->email_verified_at = now();
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();

            // Log the student in automatically using the student guard
            Auth::guard('student')->login($user);

            return redirect()->route('student.dashboard')
                             ->with('success', 'Email verified successfully! Welcome aboard.');
        }

        // Return back with error if OTP is wrong
        return back()->withErrors(['otp' => 'Invalid OTP code. Please try again.']);
    }

    /**
     * Handle OTP Resending.
     */
    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        if ($user->is_verified) {
            return redirect()->route('student.login')
                             ->with('info', 'Email is already verified. Please login.');
        }

        // Generate new OTP with expiry
        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        // Send OTP email
        Mail::to($user->email)->send(new OTPMail($otp));

        return back()->with('success', 'A new OTP has been sent to your email.');
    }
}
