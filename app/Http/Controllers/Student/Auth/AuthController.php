<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function sendOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) return back()->with('error', 'Email not found');

        $otp = rand(100000, 999999);
        $user->update(['otp' => $otp]);

        Mail::raw("Your OTP is: $otp", function ($m) use ($user) {
            $m->to($user->email)->subject('Email Verification');
        });

        return back()->with('success', 'OTP sent');
    }
}

?>