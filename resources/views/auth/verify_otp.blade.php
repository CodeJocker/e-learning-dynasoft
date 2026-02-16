@extends('layouts.auth')

@section('title', 'Verify Your Identity')

@section('form')
<div class="mb-8 text-center">
    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-500/10 mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04c0 4.833 3.533 8.996 8.618 10.388a11.954 11.954 0 005.182-2.352M6.75 21H17.25" />
        </svg>
    </div>
    <h2 class="text-2xl font-bold text-white">Security Check</h2>
    <p class="text-zinc-400 text-sm mt-2 px-4">
        We've sent a 6-digit code to <br>
        <span class="text-emerald-400 font-medium">{{ $email }}</span>
    </p>
</div>

<form method="POST" action="{{ route('student.otp.submit') }}" class="space-y-6">
    @csrf
    <input type="hidden" name="email" value="{{ $email }}">

    <div>
        <label class="block text-zinc-500 text-xs uppercase tracking-widest font-bold text-center mb-4">Enter Verification Code</label>
        <input type="text" name="otp" placeholder="000000" maxlength="6" required autofocus
            class="w-full px-4 py-4 rounded-2xl bg-zinc-900 border border-zinc-800 text-white text-center text-3xl font-mono tracking-[0.75em] placeholder-zinc-700 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 focus:outline-none transition-all">
        @error('otp')
            <p class="text-red-400 text-xs mt-2 text-center">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="w-full py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold shadow-lg shadow-emerald-900/20 transition-all transform active:scale-[0.98]">
        Verify & Continue
    </button>
</form>

<div class="mt-8 pt-6 border-t border-zinc-800/50">
    <p class="text-zinc-500 text-sm text-center mb-3">Didn't receive the code?</p>
    <form method="POST" action="{{ route('student.otp.resend') }}">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <button type="submit" class="w-full py-2.5 rounded-xl bg-zinc-800/50 hover:bg-zinc-800 text-zinc-300 text-sm font-semibold transition-all border border-zinc-700/50">
            Resend New Code
        </button>
    </form>
</div>
@endsection

@section('footer')
<a href="{{ route('student.login') }}" class="inline-flex items-center text-zinc-500 hover:text-emerald-500 text-sm transition font-medium">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
    </svg>
    Return to Login
</a>
@endsection