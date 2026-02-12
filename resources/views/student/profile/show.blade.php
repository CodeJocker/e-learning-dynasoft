@extends('layouts.student')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 h-32"></div>

        <div class="px-8 pb-8">
            <!-- Profile Info -->
            <div class="flex flex-col items-center -mt-16 text-center">
                <div class="w-32 h-32 bg-white rounded-full border-4 border-white overflow-hidden">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    @endif
                </div>

                <h1 class="text-3xl font-bold text-gray-900 mt-4">{{ $user->name }}</h1>
                <p class="text-gray-600">{{ $user->email }}</p>

                @if(auth()->user()->id === $user->id)
                    <a href="{{ route('student.profile.edit') }}" class="mt-4 px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Edit Profile</a>
                @endif
            </div>

            <!-- Bio -->
            @if($user->profile && $user->profile->bio)
                <div class="mt-8 text-center">
                    <p class="text-gray-700">{{ $user->profile->bio }}</p>
                </div>
            @endif

            <!-- Skills -->
            @if($user->profile && $user->profile->skills && count($user->profile->skills) > 0)
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 text-center">Skills</h3>
                    <div class="flex flex-wrap justify-center gap-2">
                        @foreach($user->profile->skills as $skill)
                            <span class="px-4 py-2 bg-indigo-100 text-indigo-800 rounded-full">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
