@extends('layouts.instructor')

@section('content')

<div class="py-6 max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-6">Edit Lesson: {{ $lesson->title }}</h1>

    <form action="{{ route('instructor.lessons.update', [$course, $lesson]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="bg-white shadow rounded-lg p-6 space-y-6">

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Lesson Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $lesson->title) }}" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('title') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="order" class="block text-sm font-medium text-gray-700">Order</label>
                <input type="number" name="order" id="order" min="1" value="{{ old('order', $lesson->order) }}" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('order') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Lesson Type</label>
                <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="text" {{ $lesson->type === 'text' ? 'selected' : '' }}>Text / Article</option>
                    <option value="video" {{ $lesson->type === 'video' ? 'selected' : '' }}>Video (URL)</option>
                    <option value="audio" {{ $lesson->type === 'audio' ? 'selected' : '' }}>Audio</option>
                    <option value="document" {{ $lesson->type === 'document' ? 'selected' : '' }}>Document / PDF</option>
                    <option value="external" {{ $lesson->type === 'external' ? 'selected' : '' }}>External Link</option>
                    <option value="quiz" {{ $lesson->type === 'quiz' ? 'selected' : '' }}>Quiz</option>
                </select>
                @error('type') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                <textarea name="content" id="content" rows="10" 
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('content', $lesson->content) }}</textarea>
                @error('content') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="video_url" class="block text-sm font-medium text-gray-700">Video URL</label>
                <input type="url" name="video_url" id="video_url" value="{{ old('video_url', $lesson->video_url) }}" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('video_url') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="duration_minutes" class="block text-sm font-medium text-gray-700">Duration (minutes)</label>
                <input type="number" name="duration_minutes" id="duration_minutes" min="1" 
                       value="{{ old('duration_minutes', $lesson->duration_minutes) }}" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('duration_minutes') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

        </div>

        <div class="mt-6 flex justify-between">
            <a href="{{ route('instructor.lessons.index', $course) }}" 
               class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Update Lesson
            </button>
        </div>
    </form>
</div>

@endsection