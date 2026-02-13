<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OTPMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class VerificationController extends Controller
{
    /**
     * Show OTP verification form.
     */
    public function showVerifyForm()
    {
        return view('auth.verify_otp');
    }

    /**
     * Verify the OTP.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $email = session('register_email');

        if (!$email) {
            return redirect()->route('student.register')
                ->withErrors(['otp' => 'Session expired. Please register again.']);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('student.register')
                ->withErrors(['otp' => 'User not found. Please register again.']);
        }

        if ($user->otp !== $request->otp) {
            return back()->withErrors(['otp' => 'Invalid OTP. Please try again.']);
        }

        if ($user->otp_expires_at->isPast()) {
            return back()->withErrors(['otp' => 'OTP has expired. Please request a new one.']);
        }

        // Mark email as verified
        $user->update([
            'email_verified_at' => now(),
            'otp' => null,
            'otp_expires_at' => null,
        ]);

        // Clear session
        Session::forget('register_email');

        // Redirect to login page
        return redirect()->route('student.login')
            ->with('success', 'Email verified successfully! Please login to access your dashboard.');
    }

    /**
     * Resend OTP.
     */
    public function resend(Request $request)
    {
        $email = session('register_email');

        if (!$email) {
            return back()->withErrors(['otp' => 'Session expired. Please register again.']);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'User not found. Please register again.']);
        }

        // Generate new OTP
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $otpExpiresAt = now()->addMinutes(10);

        // Update user with new OTP
        $user->update([
            'otp' => $otp,
            'otp_expires_at' => $otpExpiresAt,
        ]);

        // Send new OTP email
        Mail::to($user->email)->send(new OTPMail($otp));

        return back()->with('status', 'New OTP has been sent to your email.');
    }
}
