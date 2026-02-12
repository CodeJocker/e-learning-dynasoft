<header class="sticky top-0 z-40 border-b border-subtle bg-secondary">
    <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-screen-2xl">
        <div class="flex h-16 items-center justify-between">

            <!-- Left: mobile menu button + title -->
            <div class="flex items-center gap-4 lg:gap-6">
                <button type="button"
                        x-on:click="mobileMenuOpen = ! mobileMenuOpen"
                        class="lg:hidden -ml-2 inline-flex items-center justify-center rounded-md p-2 text-secondary hover:bg-surface-muted">
                    <span class="sr-only">Open main menu</span>
                    <x-heroicon-o-bars-3 x-show="!mobileMenuOpen" class="h-6 w-6" />
                    <x-heroicon-o-x-mark x-show="mobileMenuOpen" class="h-6 w-6" />
                </button>

                <h1 class="text-xl font-semibold text-primary">@yield('page-title', 'Dashboard')</h1>
            </div>

            <!-- Right: notifications + user -->
            <div class="flex items-center gap-4 sm:gap-6">

                <button type="button"
                        x-on:click="notificationsOpen = ! notificationsOpen"
                        class="relative rounded-full p-1 text-secondary hover:text-primary focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2">
                    <span class="sr-only">View notifications</span>
                    <x-heroicon-o-bell class="h-6 w-6" />
                    <!-- You can make this dynamic later -->
                    <span class="absolute -right-0.5 -top-0.5 flex h-4 w-4 items-center justify-center rounded-full bg-error text-[10px] font-medium text-white ring-2 ring-surface-card">
                        4
                    </span>
                </button>

                <div class="flex items-center gap-3">
                    <img class="h-9 w-9 rounded-full object-cover ring-1 ring-surface-muted"
                         src="https://ui-avatars.com/api/?name={{ auth()->user()?->name ?? 'User' }}&background=15803d&color=fff&size=128"
                         alt="{{ auth()->user()?->name ?? 'User' }}" />
                    <div class="hidden md:block">
                        <div class="text-sm font-medium leading-none">{{ auth()->user()?->name ?? 'User' }}</div>
                        <div class="text-xs text-secondary capitalize mt-0.5">{{ auth()->user()?->role ?? 'student' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
