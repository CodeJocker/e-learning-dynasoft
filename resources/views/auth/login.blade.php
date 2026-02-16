@extends('layouts.auth')

@section('title', 'Welcome Back')

@section('form')
<div class="mb-8">
    <h2 class="text-2xl font-bold text-white text-center">Student Login</h2>
    <p class="text-zinc-400 text-center text-sm mt-2">Access your courses and continue learning</p>
</div>

<form action="{{ route('student.login.submit') }}" method="POST" class="space-y-5">
    @csrf

    <div>
        <label class="block text-zinc-400 text-sm font-medium mb-2 ml-1">Email Address</label>
        <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-zinc-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                </svg>
            </span>
            <input type="email" name="email" placeholder="name@example.com" value="{{ old('email') }}"
                class="w-full pl-10 pr-4 py-3 rounded-xl bg-zinc-900 border border-zinc-800 text-white placeholder-zinc-600 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
        </div>
        @error('email')
            <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <div class="flex justify-between items-center mb-2 ml-1">
            <label class="block text-zinc-400 text-sm font-medium">Password</label>
            <a href="#" class="text-xs text-emerald-500 hover:text-emerald-400 transition">Forgot password?</a>
        </div>
        <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-zinc-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </span>
            <input type="password" name="password" placeholder="••••••••"
                class="w-full pl-10 pr-4 py-3 rounded-xl bg-zinc-900 border border-zinc-800 text-white placeholder-zinc-600 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
        </div>
        @error('password')
            <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="w-full py-3 mt-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold shadow-lg shadow-emerald-900/20 transition-all transform active:scale-[0.98]">
        Sign In to Dashboard
    </button>
</form>
@endsection

@section('footer')
<p class="text-zinc-500 text-sm">
    New to the platform? 
    <a href="{{ route('student.register') }}" class="text-emerald-500 font-semibold hover:text-emerald-400 transition underline-offset-4 hover:underline">
        Create an account
    </a>
</p>
@endsection