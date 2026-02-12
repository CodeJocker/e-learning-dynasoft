@extends('layouts.auth')

@section('title', 'Student Login')

@section('form')
<form action="{{ route('student.login.submit') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
            class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-800 text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
        @error('email')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <input type="password" name="password" placeholder="Password"
            class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-800 text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
        @error('password')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="w-full py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">
        Sign In
    </button>
</form>
@endsection

@section('footer')
Don't have an account? 
<a href="{{ route('student.register') }}" class="text-blue-400 hover:underline">Register</a>
@endsection
