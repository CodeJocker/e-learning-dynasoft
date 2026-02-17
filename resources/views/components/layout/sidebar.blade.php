@php
    $user = auth()->user();
    $role = $user->role;
    $links = [];

    // Define links based on actual Auth Role
    if ($role === 'admin') {
        $links = [
             ['label' => 'Overview', 'icon' => 'chart-bar', 'url' => route('admin.dashboard')],
             ['label' => 'Users', 'icon' => 'users', 'url' => '#'], // Add routes as you create them
             ['label' => 'Activity Logs', 'icon' => 'clipboard-document-list', 'url' => route('admin.logs')],
             ['label' => 'System Settings', 'icon' => 'cog-6-tooth', 'url' => '#'],
        ];
    } elseif ($role === 'instructor') {
         $links = [
             ['label' => 'Dashboard', 'icon' => 'chart-pie', 'url' => route('instructor.dashboard')],
             ['label' => 'My Courses', 'icon' => 'book-open', 'url' => '#'],
             ['label' => 'My Students', 'icon' => 'users', 'url' => route('instructor.students')],
             ['label' => 'Assignments', 'icon' => 'document-check', 'url' => route('instructor.assignments')],
        ];
    } else {
         // Default: Student
         $links = [
             ['label' => 'Dashboard', 'icon' => 'home', 'url' => route('student.dashboard')],
             ['label' => 'My Learning', 'icon' => 'academic-cap', 'url' => route('student.learning')],
             ['label' => 'Certificates', 'icon' => 'trophy', 'url' => '#'],
             ['label' => 'Profile', 'icon' => 'user-circle', 'url' => route('profile.edit')],
        ];
    }
@endphp

<aside class="fixed inset-y-0 left-0 z-50 w-64 h-full px-5 py-8 overflow-y-auto surface-card border-r border-subtle transition-all duration-300 transform -translate-x-full lg:static lg:transform-none lg:z-auto"
       x-data="{ sidebarOpen: true }"
       :class="{
           'translate-x-0': sidebarOpen,
           '-translate-x-full': !sidebarOpen
       }">
    
    <div class="flex items-center justify-between mb-10 px-2">
        <a href="/" class="flex items-center gap-2 font-bold text-xl tracking-tight text-primary">
            <div class="w-8 h-8 bg-accent rounded-lg flex items-center justify-center text-white">
                @svg('heroicon-o-academic-cap', 'w-5 h-5')
            </div>
            <span>E-Learn</span>
        </a>
    </div>

    <div class="mb-8 px-2 py-3 bg-surface-muted rounded-xl border border-subtle">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center text-primary font-bold">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-sm font-bold text-text-primary truncate">{{ $user->name }}</p>
                <p class="text-xs text-text-secondary capitalize">{{ $role }}</p>
            </div>
        </div>
    </div>

    <div class="flex flex-col justify-between h-[calc(100%-180px)]">
        <nav class="space-y-1">
            <div class="text-[10px] font-bold text-text-secondary uppercase tracking-widest mb-4 px-2 opacity-50">Main Menu</div>
            
            @foreach($links as $link)
            <a href="{{ $link['url'] }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->url() == $link['url'] ? 'bg-accent/10 text-accent' : 'text-text-secondary hover:bg-surface-muted hover:text-text-primary' }} group">
                @svg('heroicon-o-'.$link['icon'], 'w-5 h-5 transition-colors')
                <span class="font-medium text-sm">{{ $link['label'] }}</span>
            </a>
            @endforeach
        </nav>

        <div class="border-t border-subtle pt-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-text-secondary hover:text-error hover:bg-error/10 transition-colors w-full text-left">
                    @svg('heroicon-o-arrow-left-on-rectangle', 'w-5 h-5')
                    <span class="font-medium text-sm">Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>