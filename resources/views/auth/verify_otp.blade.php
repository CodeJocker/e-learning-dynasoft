@extends('layouts.auth')

@section('title', 'Verify Your Email')

@section('form')
<p class="text-zinc-400 text-sm text-center mb-4">
    We've sent a 6-digit verification code to <strong class="text-white">{{ $email }}</strong>. 
    Enter it below to complete your registration.
</p>

<form method="POST" action="{{ route('student.otp.submit') }}" class="space-y-4">
    @csrf
    <input type="hidden" name="email" value="{{ $email }}">

    <div>
        <input type="text" name="otp" placeholder="Enter 6-digit OTP" maxlength="6" required autofocus
            class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-800 text-white text-center text-xl tracking-widest placeholder-zinc-500 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        @error('otp')
            <p class="text-red-400 text-sm mt-1 text-center">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="w-full py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">
        Verify Email
    </button>
</form>

<form method="POST" action="{{ route('student.otp.resend') }}" class="mt-4">
    @csrf
    <input type="hidden" name="email" value="{{ $email }}">
    <button type="submit" class="w-full py-3 rounded-xl bg-zinc-800 hover:bg-zinc-700 text-zinc-300 font-medium transition">
        Resend OTP Code
    </button>
</form>
@endsection

@section('footer')
Back to <a href="{{ route('student.login') }}" class="text-blue-400 hover:underline">Login</a>
@endsection
