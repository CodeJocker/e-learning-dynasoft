@extends('layouts.instructor')

@section('content')

<div class="py-6 max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{
    showCreateModal: false,
    showEditModal: false,
    currentQuiz: { id: null, title: '', description: '', time_limit_minutes: '', max_attempts: '', passing_score: '' },
    search: ''
}">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-primary">
                Quizzes in: {{ $course->title }}
            </h1>
            <p class="text-text-secondary mt-1">
                {{ $quizzes->total() }} quizzes • Create and manage assessments
            </p>
        </div>

        <button @click="showCreateModal = true"
                class="bg-accent text-white px-6 py-3 rounded-lg hover:bg-accent/90 transition font-medium flex items-center gap-2 shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Create New Quiz
        </button>
    </div>

    <!-- Search -->
    <div class="mb-6">
        <div class="relative max-w-md">
            <input type="text" x-model="search" placeholder="Search quizzes by title..."
                   class="w-full pl-10 pr-4 py-3 bg-surface-card border border-subtle rounded-lg focus:ring-2 focus:ring-accent focus:border-accent outline-none transition">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Quizzes Cards -->
    @if($quizzes->isEmpty())
        <div class="bg-surface-muted rounded-xl p-12 text-center border border-subtle">
            <svg class="w-16 h-16 mx-auto text-text-secondary opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <p class="mt-4 text-text-secondary text-lg font-medium">No quizzes found</p>
            <p class="mt-2 text-text-secondary">Create your first quiz above.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($quizzes as $quiz)
                <div class="bg-surface-card border border-subtle rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-200 group"
                     x-show="search === '' || $quiz->title.toLowerCase().includes(search.toLowerCase())"
                     x-transition>
                    <!-- Header -->
                    <div class="p-6 border-b border-subtle bg-gradient-to-r from-surface-muted/50 to-surface-card">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-xl font-semibold text-primary group-hover:text-accent transition">
                                    {{ $quiz->title }}
                                </h3>
                                @if($quiz->description)
                                    <p class="text-sm text-text-secondary mt-2 line-clamp-2">
                                        {{ $quiz->description }}
                                    </p>
                                @endif
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-accent/10 text-accent">
                                {{ $quiz->passing_score }}% to pass
                            </span>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="p-6 space-y-4 text-sm text-text-secondary">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Time limit: <span class="font-medium ml-1">{{ $quiz->time_limit_minutes }} min</span>
                        </div>

                        <div>
                            Max attempts: <span class="font-medium">{{ $quiz->max_attempts }}</span>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="px-6 py-4 bg-surface-muted border-t border-subtle flex justify-end gap-4">
                        <button @click="
                            currentQuiz = {
                                id: {{ $quiz->id }},
                                title: '{{ addslashes($quiz->title) }}',
                                description: '{{ addslashes($quiz->description ?? '') }}',
                                time_limit_minutes: {{ $quiz->time_limit_minutes ?? '' }},
                                max_attempts: {{ $quiz->max_attempts ?? '' }},
                                passing_score: {{ $quiz->passing_score ?? '' }}
                            };
                            showEditModal = true;
                        "
                            class="text-accent hover:text-accent/80 font-medium transition">
                            Edit
                        </button>

                        <form action="{{ route('instructor.quizzes.destroy', [$course, $quiz]) }}"
                              method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-error hover:text-red-800 font-medium transition"
                                    onclick="return confirm('Delete this quiz? All questions and attempts will be lost.')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-10 flex justify-center">
            {{ $quizzes->links('pagination::tailwind') }}
        </div>
    @endif

    <!-- Create Quiz Modal -->
    <div x-show="showCreateModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4">
            <!-- Overlay -->
            <div class="fixed inset-0 bg-black opacity-50" @click="showCreateModal = false"></div>

            <!-- Modal Content -->
            <div class="bg-surface-card rounded-xl shadow-2xl max-w-lg w-full p-8 relative">
                <h2 class="text-2xl font-bold text-primary mb-6">Create New Quiz</h2>

                <form action="{{ route('instructor.quizzes.store', $course) }}" method="POST">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Quiz Title</label>
                            <input type="text" name="title" required
                                   class="mt-1 block w-full border border-subtle rounded-lg p-3 focus:ring-accent focus:border-accent">
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" rows="3"
                                      class="mt-1 block w-full border border-subtle rounded-lg p-3 focus:ring-accent focus:border-accent"></textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label for="time_limit_minutes" class="block text-sm font-medium text-gray-700">Time Limit (min)</label>
                                <input type="number" name="time_limit_minutes" min="1" max="180" required
                                       class="mt-1 block w-full border border-subtle rounded-lg p-3 focus:ring-accent focus:border-accent">
                            </div>

                            <div>
                                <label for="max_attempts" class="block text-sm font-medium text-gray-700">Max Attempts</label>
                                <input type="number" name="max_attempts" min="1" max="10" required
                                       class="mt-1 block w-full border border-subtle rounded-lg p-3 focus:ring-accent focus:border-accent">
                            </div>

                            <div>
                                <label for="passing_score" class="block text-sm font-medium text-gray-700">Passing Score (%)</label>
                                <input type="number" name="passing_score" min="0" max="100" required
                                       class="mt-1 block w-full border border-subtle rounded-lg p-3 focus:ring-accent focus:border-accent">
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-4">
                        <button type="button" @click="showCreateModal = false"
                                class="px-6 py-3 border border-subtle rounded-lg text-text-primary hover:bg-surface-muted">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-6 py-3 bg-accent text-white rounded-lg hover:bg-accent/90">
                            Create Quiz
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Quiz Modal -->
    <div x-show="showEditModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4">
            <!-- Overlay -->
            <div class="fixed inset-0 bg-black opacity-50" @click="showEditModal = false"></div>

            <!-- Modal Content -->
            <div class="bg-surface-card rounded-xl shadow-2xl max-w-lg w-full p-8 relative">
                <h2 class="text-2xl font-bold text-primary mb-6">Edit Quiz</h2>

                <form :action="`/instructor/courses/{{ $course->id }}/quizzes/${currentQuiz.id}`" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Quiz Title</label>
                            <input type="text" name="title" x-model="currentQuiz.title" required
                                   class="mt-1 block w-full border border-subtle rounded-lg p-3 focus:ring-accent focus:border-accent">
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" x-model="currentQuiz.description" rows="3"
                                      class="mt-1 block w-full border border-subtle rounded-lg p-3 focus:ring-accent focus:border-accent"></textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label for="time_limit_minutes" class="block text-sm font-medium text-gray-700">Time Limit (min)</label>
                                <input type="number" name="time_limit_minutes" x-model="currentQuiz.time_limit_minutes" min="1" max="180" required
                                       class="mt-1 block w-full border border-subtle rounded-lg p-3 focus:ring-accent focus:border-accent">
                            </div>

                            <div>
                                <label for="max_attempts" class="block text-sm font-medium text-gray-700">Max Attempts</label>
                                <input type="number" name="max_attempts" x-model="currentQuiz.max_attempts" min="1" max="10" required
                                       class="mt-1 block w-full border border-subtle rounded-lg p-3 focus:ring-accent focus:border-accent">
                            </div>

                            <div>
                                <label for="passing_score" class="block text-sm font-medium text-gray-700">Passing Score (%)</label>
                                <input type="number" name="passing_score" x-model="currentQuiz.passing_score" min="0" max="100" required
                                       class="mt-1 block w-full border border-subtle rounded-lg p-3 focus:ring-accent focus:border-accent">
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-4">
                        <button type="button" @click="showEditModal = false"
                                class="px-6 py-3 border border-subtle rounded-lg text-text-primary hover:bg-surface-muted">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-6 py-3 bg-accent text-white rounded-lg hover:bg-accent/90">
                            Update Quiz
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
