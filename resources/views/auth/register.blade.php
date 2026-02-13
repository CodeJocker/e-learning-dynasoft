@extends('layouts.auth')

@section('title', 'Create Account')

@section('content')
<!-- Logo -->
<div class="text-center mb-8">
    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-600 rounded-2xl mb-4">
        @svg('heroicon-o-academic-cap', 'w-8 h-8 text-white')
    </div>
    <h1 class="text-3xl font-bold text-white">Join E-Learn</h1>
    <p class="text-gray-400 mt-2">Start your learning journey today</p>
</div>

<!-- Flash Messages -->
@if(session('success'))
    <div class="mb-4 p-4 rounded-xl bg-green-900/50 border border-green-600 text-green-300 text-sm text-center">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 p-4 rounded-xl bg-red-900/50 border border-red-600 text-red-300 text-sm text-center">
        {{ session('error') }}
    </div>
@endif

@if(session('info'))
    <div class="mb-4 p-4 rounded-xl bg-green-900/50 border border-green-600 text-green-300 text-sm text-center">
        {{ session('info') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-6 p-4 rounded-xl bg-red-900/60 border border-red-600 text-red-200 text-sm">
        <div class="flex items-center gap-2 mb-2">
            @svg('heroicon-o-exclamation-triangle', 'w-5 h-5 text-red-400')
            <span class="font-medium">Please fix the following errors:</span>
        </div>
        <ul class="list-disc list-inside space-y-1 ml-7">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Form Card -->
<div class="bg-zinc-900/80 border border-zinc-700 rounded-2xl p-8 shadow-2xl backdrop-blur-sm">
    <form action="{{ route('student.register.submit') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Full Name</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                placeholder="Enter your full name"
                value="{{ old('name') }}"
                class="w-full px-4 py-3 rounded-xl bg-zinc-950 border @error('name') border-red-500 focus:ring-red-500 @else border-zinc-700 focus:ring-green-500 @endif text-white placeholder-zinc-500 focus:outline-none focus:ring-2 transition-all"
            >
            @error('name')
                <p class="text-red-400 text-sm mt-1 flex items-center gap-1">
                    @svg('heroicon-o-exclamation-circle', 'w-4 h-4')
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                placeholder="Enter your email"
                value="{{ old('email') }}"
                class="w-full px-4 py-3 rounded-xl bg-zinc-950 border @error('email') border-red-500 focus:ring-red-500 @else border-zinc-700 focus:ring-green-500 @endif text-white placeholder-zinc-500 focus:outline-none focus:ring-2 transition-all"
            >
            @error('email')
                <p class="text-red-400 text-sm mt-1 flex items-center gap-1">
                    @svg('heroicon-o-exclamation-circle', 'w-4 h-4')
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                placeholder="Create a password"
                class="w-full px-4 py-3 rounded-xl bg-zinc-950 border @error('password') border-red-500 focus:ring-red-500 @else border-zinc-700 focus:ring-green-500 @endif text-white placeholder-zinc-500 focus:outline-none focus:ring-2 transition-all"
            >
            @error('password')
                <p class="text-red-400 text-sm mt-1 flex items-center gap-1">
                    @svg('heroicon-o-exclamation-circle', 'w-4 h-4')
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirm Password</label>
            <input 
                type="password" 
                id="password_confirmation" 
                name="password_confirmation" 
                placeholder="Confirm your password"
                class="w-full px-4 py-3 rounded-xl bg-zinc-950 border border-zinc-700 text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-500 transition-all"
            >
        </div>

        <div class="flex items-start gap-2">
            <input type="checkbox" id="terms" class="mt-1 w-4 h-4 rounded border-zinc-600 bg-zinc-950 text-blue-500 focus:ring-blue-500">
            <label for="terms" class="text-sm text-gray-400">
                I agree to the 
                <a href="#" class="text-green-400 hover:text-green-300 transition-colors">Terms of Service</a>
                and
                <a href="#" class="text-green-400 hover:text-green-300 transition-colors">Privacy Policy</a>
            </label>
        </div>

        <button 
            type="submit" 
            class="w-full py-3 px-4 rounded-xl bg-green-600 hover:bg-green-700 text-white font-semibold transition-all transform hover:scale-[1.02] active:scale-[0.98] shadow-lg shadow-green-600/25"
        >
            Create Account
        </button>
    </form>

    <!-- Footer -->
    <div class="mt-6 text-center">
        <p class="text-gray-400">
            Already have an account? 
            <a href="{{ route('student.login') }}" class="text-green-400 hover:text-green-300 font-medium transition-colors">Sign in</a>
        </p>
    </div>
</div>

<!-- Additional Links -->
<div class="mt-6 text-center">
    <a href="{{ route('student.login') }}" class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-white transition-colors">
        @svg('heroicon-o-arrow-left', 'w-4 h-4')
        Back to login
    </a>
</div>
@endsection
