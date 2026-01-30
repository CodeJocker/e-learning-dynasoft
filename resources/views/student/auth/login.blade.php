@extends('layouts.auth')

@section('content')
<div class="w-full max-w-md bg-gray-900 border border-gray-800 p-8 rounded-2xl shadow-2xl">
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-white">Welcome Back</h2>
        <p class="text-gray-400 text-sm mt-2">Please enter your student credentials</p>
    </div>

    <form action="{{ route('student.login.submit') }}" method="POST" class="space-y-6">
        @csrf
        
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1.5">Email Address</label>
            <input type="email" name="email" required
                class="w-full bg-gray-950 border border-gray-800 rounded-xl px-4 py-2.5 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition text-white" 
                placeholder="name@university.edu">
        </div>

        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label class="text-sm font-medium text-gray-300">Password</label>
                <a href="#" class="text-xs text-indigo-400 hover:text-indigo-300 transition">Forgot password?</a>
            </div>
            <input type="password" name="password" required
                class="w-full bg-gray-950 border border-gray-800 rounded-xl px-4 py-2.5 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition text-white">
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-gray-800 bg-gray-950 text-indigo-600 focus:ring-indigo-500">
            <label for="remember" class="ml-2 text-sm text-gray-400">Remember me</label>
        </div>

        <button type="submit" 
            class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-3 rounded-xl shadow-lg shadow-indigo-500/20 transition-all active:scale-[0.98]">
         <a href="{{ route('student.dashboard') }}">Sign In</a>
        </button>
    </form>

    <div class="mt-8 pt-6 border-t border-gray-800 text-center">
        <p class="text-sm text-gray-500">
            Don't have an account yet? 
            <a href="{{ route('student.register') }}" class="text-indigo-400 hover:text-indigo-300 font-medium transition">Register now</a>
        </p>
    </div>
</div>
@endsection