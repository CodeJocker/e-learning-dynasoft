<header class="flex items-center justify-between px-4 sm:px-6 py-4 surface-card border-b border-subtle sticky top-0 z-30 lg:z-10 backdrop-blur-sm bg-opacity-90 relative" x-data="{ searchMobileOpen: false }">

    <!-- Left Section: Sidebar Toggle + Breadcrumbs + Search -->
    <div class="flex items-center gap-4 flex-1">

        <!-- Hamburger Sidebar Toggle -->
        <button @click="toggleSidebar()" class="p-2 text-secondary rounded-lg hover:surface-muted hover:text-primary focus:outline-none transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Breadcrumbs -->
        <div class="hidden sm:flex items-center text-sm breadcrumbs text-secondary">
            <span class="opacity-70">Pages</span>
            <span class="mx-2">/</span>
            <span class="font-medium text-primary">Dashboard</span>
        </div>

        <!-- Desktop Search Bar -->
        <div class="hidden lg:flex items-center ml-4 relative max-w-md w-full">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"></path>
                </svg>
            </div>
            <input type="text" placeholder="Search..." class="block w-full pl-10 pr-3 py-2 border border-subtle rounded-lg leading-5 bg-surface-muted placeholder-secondary focus:outline-none focus:ring-1 focus:ring-accent focus:border-accent sm:text-sm transition duration-150 ease-in-out">
        </div>

    </div>

    <!-- Mobile Search Overlay -->
    <div x-show="searchMobileOpen" x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="absolute inset-x-0 top-0 bottom-0 px-4 bg-white surface-card border-b border-subtle z-50 flex items-center gap-3 lg:hidden h-full">

        <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"></path>
                </svg>
            </div>
            <input type="text" placeholder="Search..." class="block w-full pl-10 pr-3 py-2 border border-subtle rounded-lg leading-5 bg-surface-muted placeholder-secondary focus:outline-none focus:ring-1 focus:ring-accent focus:border-accent sm:text-sm" x-ref="searchInput">
        </div>
        <button @click="searchMobileOpen = false" class="p-2 text-sm font-medium text-secondary hover:text-primary whitespace-nowrap">
            Cancel
        </button>
    </div>

    <!-- Right Section: Search Trigger (Mobile) + Avatar + Username + Logout -->
    <div class="flex items-center gap-2 sm:gap-4" :class="{ 'opacity-0': searchMobileOpen }">

        <!-- Search Trigger (Mobile) -->
        <button @click="searchMobileOpen = true; $nextTick(() => $refs.searchInput.focus());" class="lg:hidden p-2 text-secondary rounded-lg hover:surface-muted hover:text-primary focus:outline-none transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"></path>
            </svg>
        </button>

        <!-- Avatar + Username -->
        @auth
        <div class="flex items-center gap-3">
            <!-- Avatar -->
            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-gradient-to-tr from-accent to-accent-secondary p-[2px] cursor-pointer">
                <div class="w-full h-full rounded-full surface-card p-[2px]">
                    <img
                        src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=0D8ABC&color=fff"
                        alt="Admin"
                        class="w-full h-full rounded-full object-cover"
                    >
                </div>
            </div>

            <!-- Username & Role (md+) -->
            <div class="hidden md:flex flex-col text-right leading-tight">
                <p class="text-sm font-semibold text-primary">{{ auth()->user()->name }}</p>
                <p class="text-xs text-secondary">Admin</p>
            </div>
        </div>
        @endauth

        <!-- Separator Line -->
        <div class="h-8 w-px bg-subtle border-r border-subtle"></div>

        <!-- Logout Button -->
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button
                type="submit"
                class="
                    px-3 py-1.5
                    text-xs font-medium
                    rounded-lg
                    bg-red-500/10
                    text-red-400
                    hover:bg-red-500/20
                    transition
                "
            >
                Logout
            </button>
        </form>
    </div>

</header>
