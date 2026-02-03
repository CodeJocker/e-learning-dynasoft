@extends('layouts.instructor')

@section('content')

<div class="py-6 max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-6">Add New Lesson to: {{ $course->title }}</h1>

    <form action="{{ route('instructor.lessons.store', $course) }}" method="POST">
        @csrf

        <div class="bg-white shadow rounded-lg p-6 space-y-6">

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Lesson Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-accent focus:border-accent" required>
                @error('title') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Order (auto-filled with next number) -->
            <div>
                <label for="order" class="block text-sm font-medium text-gray-700">Order (sequence number)</label>
                <input type="number" name="order" id="order" min="1" value="{{ old('order', $nextOrder ?? 1) }}" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-accent focus:border-accent" required>
                @error('order') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Type -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Lesson Type</label>
                <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-accent focus:border-accent" required>
                    <option value="text">Text / Article</option>
                    <option value="video">Video (URL)</option>
                    <option value="audio">Audio</option>
                    <option value="document">Document / PDF</option>
                    <option value="external">External Link</option>
                    <option value="quiz">Quiz</option>
                </select>
                @error('type') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Content -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Content (for text types)</label>
                <textarea name="content" id="content" rows="10" 
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-accent focus:border-accent">{{ old('content') }}</textarea>
                @error('content') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Video URL -->
            <div>
                <label for="video_url" class="block text-sm font-medium text-gray-700">Video URL (if video type)</label>
                <input type="url" name="video_url" id="video_url" value="{{ old('video_url') }}" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-accent focus:border-accent">
                @error('video_url') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Duration -->
            <div>
                <label for="duration_minutes" class="block text-sm font-medium text-gray-700">Estimated Duration (minutes)</label>
                <input type="number" name="duration_minutes" id="duration_minutes" min="1" value="{{ old('duration_minutes') }}" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-accent focus:border-accent">
                @error('duration_minutes') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
            </div>

        </div>

        <div class="mt-8 flex justify-end space-x-4">
            <a href="{{ route('instructor.lessons.index', $course) }}" 
               class="px-6 py-3 border border-subtle rounded-lg text-text-primary hover:bg-surface-muted transition">
                Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-3 bg-accent text-white rounded-lg hover:bg-accent/90 transition shadow-sm">
                Save Lesson
            </button>
        </div>
    </form>
</div>

@endsection