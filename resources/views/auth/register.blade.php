@extends('layouts.auth')

@section('title', 'Join Our Community')

@section('form')
<div class="mb-8 text-center">
    <h2 class="text-2xl font-bold text-white">Create Student Account</h2>
    <p class="text-zinc-400 text-sm mt-2">Start your learning journey with us today</p>
</div>

<form action="{{ route('student.register.submit') }}" method="POST" class="space-y-5">
    @csrf

    <div>
        <label class="block text-zinc-400 text-sm font-medium mb-1.5 ml-1">Full Name</label>
        <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-zinc-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </span>
            <input type="text" name="name" placeholder="John Doe" value="{{ old('name') }}"
                class="w-full pl-10 pr-4 py-3 rounded-xl bg-zinc-900 border border-zinc-800 text-white placeholder-zinc-600 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
        </div>
        @error('name')
            <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-zinc-400 text-sm font-medium mb-1.5 ml-1">Email Address</label>
        <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-zinc-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </span>
            <input type="email" name="email" placeholder="name@example.com" value="{{ old('email') }}"
                class="w-full pl-10 pr-4 py-3 rounded-xl bg-zinc-900 border border-zinc-800 text-white placeholder-zinc-600 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
        </div>
        @error('email')
            <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-zinc-400 text-sm font-medium mb-1.5 ml-1">Password</label>
            <input type="password" name="password" placeholder="••••••••"
                class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-800 text-white placeholder-zinc-600 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
            @error('password')
                <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="block text-zinc-400 text-sm font-medium mb-1.5 ml-1">Confirm</label>
            <input type="password" name="password_confirmation" placeholder="••••••••"
                class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-800 text-white placeholder-zinc-600 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all">
        </div>
    </div>

    <div class="pt-2">
        <p class="text-zinc-500 text-[11px] text-center mb-4">
            By clicking register, you agree to our 
            <a href="#" class="text-emerald-500 hover:underline">Terms of Service</a> and 
            <a href="#" class="text-emerald-500 hover:underline">Privacy Policy</a>.
        </p>
        
        <button type="submit" class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold shadow-lg shadow-emerald-900/20 transition-all transform active:scale-[0.98]">
            Create My Account
        </button>
    </div>
</form>
@endsection

@section('footer')
<p class="text-zinc-500 text-sm">
    Already a student? 
    <a href="{{ route('student.login') }}" class="text-emerald-500 font-semibold hover:text-emerald-400 transition underline-offset-4 hover:underline">
        Sign in here
    </a>
</p>
@endsection