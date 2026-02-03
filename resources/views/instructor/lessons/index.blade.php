@extends('layouts.instructor')

@section('content')

<div class="py-6 max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-primary">
                Lessons in: {{ $course->title }}
            </h1>
            <p class="text-text-secondary mt-1">
                {{ $lessons->total() }} lessons • Manage and organize your course content
            </p>
        </div>

        <a href="{{ route('instructor.lessons.create', $course) }}" 
           class="bg-accent text-white px-6 py-3 rounded-lg hover:bg-accent/90 transition font-medium flex items-center gap-2 shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add New Lesson
        </a>
    </div>

    <!-- Search & Controls -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center gap-4">
        <div class="relative flex-1">
            <input type="text" id="searchInput" placeholder="Search lessons by title..." 
                   class="w-full pl-10 pr-4 py-3 bg-surface-card border border-subtle rounded-lg focus:ring-2 focus:ring-accent focus:border-accent outline-none transition">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Lessons Grid / Table -->
    @if($lessons->isEmpty())
        <div class="bg-surface-muted rounded-xl p-12 text-center border border-subtle">
            <svg class="w-16 h-16 mx-auto text-text-secondary opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <p class="mt-4 text-text-secondary text-lg font-medium">No lessons found</p>
            <p class="mt-2 text-text-secondary">Create your first lesson to start building the course.</p>
        </div>
    @else
        <div class="bg-surface-card shadow-sm rounded-xl overflow-hidden border border-subtle">
            <table class="min-w-full divide-y divide-subtle">
                <thead class="bg-surface-muted">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-text-secondary uppercase tracking-wider cursor-pointer" 
                            onclick="sortTable(0)">Order <span class="sort-arrow"></span></th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-text-secondary uppercase tracking-wider cursor-pointer" 
                            onclick="sortTable(1)">Title <span class="sort-arrow"></span></th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-text-secondary uppercase tracking-wider cursor-pointer" 
                            onclick="sortTable(2)">Type <span class="sort-arrow"></span></th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-text-secondary uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-subtle" id="lessonsTableBody">
                    @foreach($lessons as $lesson)
                        <tr class="hover:bg-surface-muted/50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-primary font-medium">
                                {{ $lesson->order }}
                            </td>
                            <td class="px-6 py-4 text-sm text-primary">
                                {{ $lesson->title }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-accent/10 text-accent">
                                    {{ ucfirst($lesson->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-medium space-x-4">
                                <a href="{{ route('instructor.lessons.edit', [$course, $lesson]) }}" 
                                   class="text-indigo-600 hover:text-indigo-800 transition">
                                    Edit
                                </a>

                                <form action="{{ route('instructor.lessons.destroy', [$course, $lesson]) }}" 
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-error hover:text-red-800 transition"
                                            onclick="return confirm('Delete this lesson? This cannot be undone.')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $lessons->links('pagination::tailwind') }}
        </div>
    @endif
</div>

<!-- Simple client-side search & sort script -->
<script>
    // Search (filter rows by title)
    document.getElementById('searchInput').addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#lessonsTableBody tr');

        rows.forEach(row => {
            const title = row.cells[1].textContent.toLowerCase();
            row.style.display = title.includes(filter) ? '' : 'none';
        });
    });

    // Sorting (click headers)
    function sortTable(n) {
        const table = document.getElementById('lessonsTableBody').parentElement;
        let switching = true;
        let dir = "asc"; 
        let switchcount = 0;

        while (switching) {
            switching = false;
            const rows = table.rows;

            for (let i = 1; i < (rows.length - 1); i++) {
                let shouldSwitch = false;
                const x = rows[i].getElementsByTagName("TD")[n];
                const y = rows[i + 1].getElementsByTagName("TD")[n];

                let xVal = x.innerHTML.toLowerCase();
                let yVal = y.innerHTML.toLowerCase();

                // Numeric sort for order column
                if (n === 0) {
                    xVal = parseFloat(xVal) || 0;
                    yVal = parseFloat(yVal) || 0;
                }

                if (dir == "asc") {
                    if (xVal > yVal) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (xVal < yVal) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }

            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
            } else {
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>

@endsection