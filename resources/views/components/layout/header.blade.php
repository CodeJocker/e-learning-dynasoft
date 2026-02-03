<header class="flex items-center justify-between px-4 sm:px-6 py-4 surface-card border-b border-subtle sticky top-0 z-30 lg:z-10 backdrop-blur-sm bg-opacity-90 relative" x-data="{ searchMobileOpen: false }">
    <div class="flex items-center gap-4 flex-1">
        <button @click="toggleSidebar()" class="p-2 text-secondary rounded-lg hover:surface-muted hover:text-primary focus:outline-none transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>

        <div class="hidden sm:flex items-center text-sm breadcrumbs text-secondary">
            <span class="opacity-70">Pages</span> <span class="mx-2">/</span> <span class="font-medium text-primary">Dashboard</span>
        </div>

        <div class="hidden lg:flex items-center ml-4 relative max-w-md w-full">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                @svg('heroicon-o-magnifying-glass', 'w-5 h-5 text-secondary')
            </div>
            <input type="text" placeholder="Search..." class="block w-full pl-10 pr-3 py-2 border border-subtle rounded-lg leading-5 bg-surface-muted placeholder-secondary focus:outline-none focus:ring-1 focus:ring-accent focus:border-accent sm:text-sm transition duration-150 ease-in-out">
        </div>
    </div>

    <!-- Mobile Search Overlay (Takes Full Width) -->
    <div x-show="searchMobileOpen"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="absolute inset-x-0 top-0 bottom-0 px-4 bg-white surface-card border-b border-subtle z-50 flex items-center gap-3 lg:hidden h-full">

         <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                @svg('heroicon-o-magnifying-glass', 'w-5 h-5 text-secondary')
            </div>
            <input type="text" placeholder="Search..." class="block w-full pl-10 pr-3 py-2 border border-subtle rounded-lg leading-5 bg-surface-muted placeholder-secondary focus:outline-none focus:ring-1 focus:ring-accent focus:border-accent sm:text-sm" x-ref="searchInput">
         </div>
         <button @click="searchMobileOpen = false" class="p-2 text-sm font-medium text-secondary hover:text-primary whitespace-nowrap">
            Cancel
         </button>
    </div>

    <div class="flex items-center gap-2 sm:gap-4" :class="{ 'opacity-0': searchMobileOpen }">
        <!-- Search Trigger (Mobile) -->
        <button @click="searchMobileOpen = true; $nextTick(() => $refs.searchInput.focus());" class="lg:hidden p-2 text-secondary rounded-lg hover:surface-muted hover:text-primary focus:outline-none transition-colors">
            @svg('heroicon-o-magnifying-glass', 'w-6 h-6')
        </button>

        <!-- Chat Trigger -->
        <button @click="toggleChat()" class="relative p-2 text-secondary rounded-lg hover:surface-muted hover:text-accent transition-colors focus:outline-none" :class="{ 'bg-accent/10 text-accent': chatOpen }">
            @svg('heroicon-o-chat-bubble-left-right', 'w-6 h-6')
        </button>

        <!-- Notification Trigger -->
        <button @click="toggleNotification()" class="relative p-2 text-secondary rounded-lg hover:surface-muted hover:text-accent transition-colors focus:outline-none" :class="{ 'bg-accent/10 text-accent': notificationOpen }">
            @svg('heroicon-o-bell', 'w-6 h-6')
        </button>

        <div class="h-8 w-px bg-subtle mx-1 sm:mx-2 border-r border-subtle"></div>

        <!-- Profile Dropdown -->
        <!-- Profile Dropdown -->
        <div class="relative" x-data="{ profileOpen: false }" @click.outside="profileOpen = false">
            <button @click="profileOpen = !profileOpen" class="flex items-center gap-3 focus:outline-none group">
                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-gradient-to-tr from-accent to-accent-secondary p-[2px] transition-transform group-hover:scale-105">
                    <div class="w-full h-full rounded-full surface-card p-[2px]">
                         <img src="https://ui-avatars.com/api/?name={{ session('mock_role', 'Admin+User') }}&background=0D8ABC&color=fff" alt="User" class="w-full h-full rounded-full object-cover">
                    </div>
                </div>
                <div class="hidden md:block text-left">
                    <p class="text-sm font-semibold text-primary group-hover:text-accent transition-colors">{{ ucfirst(session('mock_role', 'Admin User')) }}</p>
                    <p class="text-xs text-secondary">Administrator</p>
                </div>
                <div class="hidden md:block text-secondary group-hover:text-primary transition-colors">
                    @svg('heroicon-m-chevron-down', 'w-4 h-4')
                </div>
            </button>

            <!-- Dropdown Menu -->
            <div 
                x-show="profileOpen"
                x-cloak
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                @click.stop
                class="absolute right-0 mt-2 w-64 surface-card rounded-xl shadow-lg border border-subtle py-2 ring-1 ring-black ring-opacity-5 focus:outline-none z-50 origin-top-right"
            >
                <!-- Quick Info -->
                <div class="px-4 py-3 border-b border-subtle mb-2">
                    <p class="text-sm font-semibold text-primary">Admin User</p>
                    <p class="text-xs text-secondary truncate">admin@dynasoft.rw</p>
                    <div class="mt-2 flex items-center">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-success/10 text-success">
                            Online
                        </span>
                    </div>
                </div>

                <!-- Links -->
                <a href="#" class="block px-4 py-2 text-sm text-secondary hover:surface-muted hover:text-primary transition-colors">
                    @svg('heroicon-o-user-circle', 'w-4 h-4 inline mr-2')
                    Profile Settings
                </a>
                
                <!-- Dark Mode Toggle -->
                <button @click="toggleTheme()" class="w-full text-left px-4 py-2 text-sm text-secondary hover:surface-muted hover:text-primary transition-colors flex items-center justify-between">
                    <span class="flex items-center">
                        @svg('heroicon-o-moon', 'w-4 h-4 inline mr-2')
                        Dark Mode
                    </span>
                    <!-- Toggle Switch -->
                    <div class="relative inline-flex h-5 w-9 items-center rounded-full transition-colors duration-200 focus:outline-none" :class="darkMode ? 'bg-accent' : 'bg-surface-muted border border-subtle'">
                        <span class="inline-block h-3 w-3 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out" :class="darkMode ? 'translate-x-5' : 'translate-x-1'"></span>
                    </div>
                </button>

                <!-- Divder -->
                <div class="border-t border-subtle my-2"></div>

                <!-- Logout -->
                 <form method="POST" action="">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-error hover:bg-error/10 transition-colors flex items-center">
                        @svg('heroicon-o-arrow-left-on-rectangle', 'w-4 h-4 inline mr-2')
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
