@extends('layouts.student')

@section('content')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg p-8 text-white">
        <h1 class="text-4xl font-bold mb-2">Welcome, {{ auth()->user()->name }}!</h1>
        <p class="text-indigo-100">Your learning journey starts here</p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Enrolled Courses</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $enrolledCourses }}</p>
                </div>
                <div class="bg-indigo-100 p-4 rounded-full">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747S17.5 6.253 12 6.253z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Overall Progress</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $progress }}%</p>
                </div>
                <div class="bg-green-100 p-4 rounded-full">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Profile Completion</p>
                    <p class="text-3xl font-bold text-gray-900">85%</p>
                </div>
                <div class="bg-purple-100 p-4 rounded-full">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('student.profile.edit') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
            <h3 class="font-bold text-lg mb-2">Complete Your Profile</h3>
            <p class="text-gray-600 text-sm">Add a profile photo, bio, and skills to get started</p>
        </a>

        <a href="#" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
            <h3 class="font-bold text-lg mb-2">Browse Courses</h3>
            <p class="text-gray-600 text-sm">Explore and enroll in new courses</p>
        </a>
    </div>
</div>
@endsection