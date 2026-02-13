<div
    x-show="sidebarOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    class="fixed inset-y-0 left-0 z-50 w-64 surface-card border-r border-subtle shadow-lg lg:static lg:block"
>
    <!-- Logo -->
    <div class="flex items-center justify-center h-16 border-b border-subtle bg-secondary">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
            <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-[var(--accent-primary)] to-[var(--accent-secondary)]">
                Dynasoft
            </span>
            <span class="text-xs px-2 py-0.5 rounded-full bg-[var(--accent-primary)]/10 text-accent border border-[var(--accent-primary)]/20">
                Admin
            </span>
        </a>
    </div>

    <!-- Scrollable Content -->
    <div class="h-[calc(100vh-4rem)] overflow-y-auto custom-scrollbar p-4 flex flex-col justify-between">
        
        <!-- Navigation -->
        <nav class="space-y-1">
            <p class="px-3 text-xs font-semibold text-secondary uppercase tracking-wider mb-2">
                Overview
            </p>
            
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors group
                      {{ request()->routeIs('admin.dashboard') ? 'bg-[var(--accent-primary)]/10 text-accent' : 'text-secondary hover:surface-muted hover:text-primary' }}">
                @svg('heroicon-o-squares-2x2', 'w-5 h-5 mr-3 flex-shrink-0')
                Dashboard
            </a>

            <a href="#" 
               class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors group text-secondary hover:surface-muted hover:text-primary">
                @svg('heroicon-o-users', 'w-5 h-5 mr-3 flex-shrink-0')
                Users Management
            </a>

            <a href="#" 
               class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors group text-secondary hover:surface-muted hover:text-primary">
                @svg('heroicon-o-academic-cap', 'w-5 h-5 mr-3 flex-shrink-0')
                Courses
            </a>
            
            <p class="px-3 text-xs font-semibold text-secondary uppercase tracking-wider mt-6 mb-2">
                Monitoring
            </p>

            <a href="#" 
               class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors group text-secondary hover:surface-muted hover:text-primary">
                @svg('heroicon-o-chart-bar', 'w-5 h-5 mr-3 flex-shrink-0')
                Analytics
            </a>

            <a href="#" 
               class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors group text-secondary hover:surface-muted hover:text-primary">
                @svg('heroicon-o-clock', 'w-5 h-5 mr-3 flex-shrink-0')
                Activity Logs
            </a>

             <a href="#" 
               class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors group text-secondary hover:surface-muted hover:text-primary">
                @svg('heroicon-o-server', 'w-5 h-5 mr-3 flex-shrink-0')
                System Status
            </a>

            <p class="px-3 text-xs font-semibold text-secondary uppercase tracking-wider mt-6 mb-2">
                Configuration
            </p>

             <a href="#" 
               class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors group text-secondary hover:surface-muted hover:text-primary">
                @svg('heroicon-o-cog-6-tooth', 'w-5 h-5 mr-3 flex-shrink-0')
                Settings
            </a>
        </nav>

        <!-- User Profile & Logout -->
        <div class="mt-auto border-t border-subtle pt-4">
             <div class="flex items-center px-3 mb-3">
                <div class="flex-shrink-0">
                    <img class="h-9 w-9 rounded-full object-cover border border-subtle" 
                         src="https://ui-avatars.com/api/?name=Admin+User&background=random" 
                         alt="Admin">
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-primary">Admin User</p>
                    <p class="text-xs text-secondary">admin@dynasoft.rw</p>
                </div>
            </div>
            
            <form method="POST" action="">
                @csrf
                <button type="submit" class="w-full flex items-center px-3 py-2 text-sm font-medium text-error rounded-lg hover:bg-error/10 transition-colors">
                    @svg('heroicon-o-arrow-left-on-rectangle', 'w-5 h-5 mr-3')
                    Sign Out
                </button>
            </form>
        </div>
    </div>
</div>
