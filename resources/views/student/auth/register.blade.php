@extends('layouts.auth')

@section('content')
<div class="w-full max-w-md bg-gray-900 border border-gray-800 p-8 rounded-2xl shadow-2xl">
    <h2 class="text-2xl font-bold text-center mb-2">Create Account</h2>
    <p class="text-gray-400 text-sm text-center mb-6">Join our student community</p>
    
    <form action="{{ route('student.register.submit') }}" method="POST" class="space-y-4">
        @csrf
        
        <div>
            <label class="block text-sm mb-1 text-gray-300">Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required 
                   class="w-full bg-gray-950 border border-gray-800 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-indigo-500 outline-none">
            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm mb-1 text-gray-300">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required 
                   class="w-full bg-gray-950 border border-gray-800 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-indigo-500 outline-none">
            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm mb-1 text-gray-300">Password</label>
            <input type="password" name="password" required 
                   class="w-full bg-gray-950 border border-gray-800 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-indigo-500 outline-none">
        </div>

        <div>
            <label class="block text-sm mb-1 text-gray-300">Confirm Password</label>
            <input type="password" name="password_confirmation" required 
                   class="w-full bg-gray-950 border border-gray-800 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-indigo-500 outline-none">
        </div>

        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 py-3 rounded-lg font-bold transition shadow-lg shadow-indigo-500/20">
            Sign Up
        </button>
    </form>
    
    <div class="mt-6 text-center border-t border-gray-800 pt-4">
        <p class="text-sm text-gray-400">
            Already have an account? 
            <a href="{{ route('student.login') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold transition">
                Login here
            </a>
        </p>
    </div>
</div>
@endsection