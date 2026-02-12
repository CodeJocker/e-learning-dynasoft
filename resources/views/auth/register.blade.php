@extends('layouts.auth')

@section('title', 'Create Account')

@section('form')
<form action="{{ route('student.register.submit') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}"
            class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-800 text-white placeholder-zinc-500 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        @error('name')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
            class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-800 text-white placeholder-zinc-500 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        @error('email')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <input type="password" name="password" placeholder="Password"
            class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-800 text-white placeholder-zinc-500 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        @error('password')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <input type="password" name="password_confirmation" placeholder="Confirm Password"
            class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-800 text-white placeholder-zinc-500 focus:ring-2 focus:ring-blue-500 focus:outline-none">
    </div>

    <button type="submit" class="w-full py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">
        Register
    </button>
</form>
@endsection

@section('footer')
Already have an account? 
<a href="{{ route('student.login') }}" class="text-blue-400 hover:underline">Login</a>
@endsection
