@extends('components.layout.sidebar')

@section('title', 'Dashboard')

@section('content')
<div class="p-6">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white">Welcome, {{ Auth::user()->name }}!</h1>
        <p class="text-gray-400 mt-2">Here's what's happening with your learning journey.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-zinc-900/80 border border-zinc-700 rounded-xl p-6">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-green-600/20 rounded-lg">
                    @svg('heroicon-o-book-open', 'w-6 h-6 text-green-400')
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Enrolled Courses</p>
                    <p class="text-2xl font-bold text-white">0</p>
                </div>
            </div>
        </div>

        <div class="bg-zinc-900/80 border border-zinc-700 rounded-xl p-6">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-blue-600/20 rounded-lg">
                    @svg('heroicon-o-clock', 'w-6 h-6 text-blue-400')
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Hours Learned</p>
                    <p class="text-2xl font-bold text-white">0</p>
                </div>
            </div>
        </div>

        <div class="bg-zinc-900/80 border border-zinc-700 rounded-xl p-6">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-purple-600/20 rounded-lg">
                    @svg('heroicon-o-trophy', 'w-6 h-6 text-purple-400')
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Certificates</p>
                    <p class="text-2xl font-bold text-white">0</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-zinc-900/80 border border-zinc-700 rounded-xl p-6">
        <h2 class="text-xl font-bold text-white mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <a href="#" class="flex items-center gap-3 p-4 bg-zinc-800 rounded-lg hover:bg-zinc-700 transition-colors">
                <div class="p-2 bg-green-600/20 rounded-lg">
                    @svg('heroicon-o-plus', 'w-5 h-5 text-green-400')
                </div>
                <span class="text-gray-200">Browse Courses</span>
            </a>

            <a href="#" class="flex items-center gap-3 p-4 bg-zinc-800 rounded-lg hover:bg-zinc-700 transition-colors">
                <div class="p-2 bg-blue-600/20 rounded-lg">
                    @svg('heroicon-o-play', 'w-5 h-5 text-blue-400')
                </div>
                <span class="text-gray-200">Continue Learning</span>
            </a>

            <a href="#" class="flex items-center gap-3 p-4 bg-zinc-800 rounded-lg hover:bg-zinc-700 transition-colors">
                <div class="p-2 bg-purple-600/20 rounded-lg">
                    @svg('heroicon-o-chart-bar', 'w-5 h-5 text-purple-400')
                </div>
                <span class="text-gray-200">View Progress</span>
            </a>
        </div>
    </div>
</div>
@endsection
