@extends('layouts.instructor')

@section('content')

{{-- Container: Reduced from py-6 to py-4 and space-y-10 to space-y-6 --}}
<div class="py-4 max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
        <div>
            {{-- Header: Reduced from text-3xl/4xl to text-2xl/3xl --}}
            <h1 class="text-2xl sm:text-3xl font-bold text-primary">
                Dashboard
            </h1>
            {{-- Subtext: Reduced from text-lg to text-sm --}}
            <p class="mt-1 text-sm text-text-secondary">
                Welcome back, Eric. Here's what's happening with your courses.
            </p>
        </div>

        <div class="flex flex-wrap gap-4">
            {{-- Buttons: Reduced from px-5 py-3 to px-4 py-2 and font size to text-sm --}}
            <a href="#" class="inline-flex items-center gap-2 px-4 py-2 bg-accent text-white rounded-lg hover:bg-accent/90 transition text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                New Course
            </a>

            <a href="#" class="inline-flex items-center gap-2 px-4 py-2 bg-surface-card border border-subtle text-primary rounded-lg hover:bg-surface-muted transition text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Create Quiz
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
        <div class="bg-surface-card border border-subtle rounded-xl p-4 transition-colors hover:bg-surface-muted/50">
            <p class="text-xs font-medium text-text-secondary uppercase tracking-wider">Active Courses</p>
            <p class="mt-1 text-2xl font-bold text-primary">{{ $totalCourses }}</p>
        </div>

        <div class="bg-surface-card border border-subtle rounded-xl p-4 transition-colors hover:bg-surface-muted/50">
            <p class="text-xs font-medium text-text-secondary uppercase tracking-wider">Total Students</p>
            <p class="mt-1 text-2xl font-bold text-primary">{{ number_format($totalEnrollments) }}</p>
        </div>

        <div class="bg-surface-card border border-subtle rounded-xl p-4 transition-colors hover:bg-surface-muted/50">
            <p class="text-xs font-medium text-text-secondary uppercase tracking-wider">Published Lessons</p>
            <p class="mt-1 text-2xl font-bold text-primary">{{ $totalLessons }}</p>
        </div>

        <div class="bg-surface-card border border-subtle rounded-xl p-4 transition-colors hover:bg-surface-muted/50">
            <p class="text-xs font-medium text-text-secondary uppercase tracking-wider">Total Quizzes</p>
            <p class="mt-1 text-2xl font-bold text-primary">{{ $totalQuizzes }}</p>
        </div>

        <div class="bg-surface-card border border-subtle rounded-xl p-4 transition-colors hover:bg-surface-muted/50">
            <p class="text-xs font-medium text-text-secondary uppercase tracking-wider">Avg. Completion</p>
            <p class="mt-1 text-2xl font-bold text-accent">{{ number_format($averageCompletion, 1) }}%</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-surface-card border border-subtle rounded-xl p-5">
            <h2 class="text-sm font-bold text-primary mb-4">Enrollment Trends (Last 30 Days)</h2>

            @if($chartData->isEmpty())
                <div class="h-64 flex items-center justify-center text-text-secondary italic text-xs">
                    No enrollment data available yet
                </div>
            @else
                <div class="h-64">
                    <canvas id="enrollmentChart"></canvas>
                </div>
            @endif
        </div>

        <div class="bg-surface-card border border-subtle rounded-xl p-5">
            <h2 class="text-sm font-bold text-primary mb-4">Course Completion Distribution</h2>
            <div class="h-64 flex items-center justify-center text-xs text-text-default">
                Coming soon — detailed completion breakdown
            </div>
        </div>
    </div>

    <div class="mt-6 bg-surface-card border border-subtle rounded-xl p-5">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-primary">Recent Enrollments</h2>
            <a href="#" class="text-xs font-medium text-accent hover:underline">View All Enrollments</a>
        </div>

        @if($recentEnrollments->isEmpty())
            <p class="text-center py-8 text-sm text-text-secondary">No recent enrollments yet</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-subtle">
                    <thead>
                        <tr class="text-left">
                            <th class="pb-3 text-[10px] font-semibold text-text-secondary uppercase tracking-wider">Student</th>
                            <th class="pb-3 text-[10px] font-semibold text-text-secondary uppercase tracking-wider">Course</th>
                            <th class="pb-3 text-[10px] font-semibold text-text-secondary uppercase tracking-wider text-right">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-subtle">
                        @foreach($recentEnrollments as $enrollment)
                            <tr class="hover:bg-surface-muted/50 transition">
                                <td class="py-3 text-sm font-medium text-primary">
                                    {{ $enrollment->user->name ?? 'Unknown' }}
                                </td>
                                <td class="py-3 text-sm text-text-secondary">
                                    {{ $enrollment->course->title ?? 'Deleted Course' }}
                                </td>
                                <td class="py-3 text-sm text-text-secondary text-right">
                                    <span class="font-medium">{{ optional($enrollment->enrolled_at)->diffForHumans() ?? 'N/A' }}</span>
                                    <br>
                                    <span class="text-[10px] opacity-75">
                                        {{ optional($enrollment->enrolled_at)->format('M d, Y H:i') }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const canvas = document.getElementById('enrollmentChart');
            if (!canvas) return;

            const ctx = canvas.getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartLabels) !!},
                    datasets: [{
                        label: 'Enrollments',
                        data: {!! json_encode($chartData) !!},
                        borderColor: 'rgb(22, 163, 74)',
                        backgroundColor: 'rgba(22, 163, 74, 0.15)',
                        borderWidth: 1.5, // Reduced from 2
                        tension: 0.35,
                        pointBackgroundColor: 'rgb(22, 163, 74)',
                        pointBorderColor: '#fff',
                        pointHoverRadius: 5, // Reduced from 6
                        pointRadius: 3 // Reduced from 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.8)',
                            titleFont: { size: 12 }, // Reduced from 14
                            bodyFont: { size: 11 }, // Reduced from 13
                            padding: 10 // Reduced from 12
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: {
                                color: 'var(--text-secondary)',
                                font: { size: 10 } // Smaller axis text
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(0,0,0,0.05)' },
                            ticks: {
                                color: 'var(--text-secondary)',
                                font: { size: 10 } // Smaller axis text
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
