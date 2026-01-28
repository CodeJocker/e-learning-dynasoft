<div x-show="notificationsOpen"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 -translate-x-full"
     x-transition:enter-end="opacity-100 translate-x-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-x-0"
     x-transition:leave-end="opacity-0 -translate-x-full"
     class="fixed inset-y-0 left-0 z-50 w-full border-r border-subtle bg-surface-card shadow-2xl lg:w-96 lg:border-r lg:shadow-none"
     :class="{ 'lg:left-auto lg:right-0 lg:border-l lg:border-r-0': window.innerWidth >= 1024 }">

    <div class="flex h-16 items-center justify-between border-b border-subtle px-5 sticky top-0 bg-surface-card z-10">
        <h2 class="text-lg font-semibold text-primary">Notifications</h2>
        <button x-on:click="notificationsOpen = false"
                class="rounded-full p-1.5 text-secondary hover:bg-surface-muted focus:outline-none">
            <x-heroicon-o-x-mark class="h-5 w-5" />
        </button>
    </div>

    <div class="divide-y divide-surface-muted">
        <!-- Static examples – replace with @livewire('notifications') or loop later -->
        <a href="#" class="block p-4 hover:bg-surface-muted transition-colors">
            <div class="flex items-start gap-3">
                <div class="rounded-full bg-success/10 p-2">
                    <x-heroicon-o-check-circle class="h-5 w-5 text-success" />
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-medium text-primary truncate">Course completed</p>
                    <p class="mt-0.5 text-sm text-secondary">You have finished "Laravel for Beginners"</p>
                    <p class="mt-1 text-xs text-secondary">2 hours ago</p>
                </div>
            </div>
        </a>

        <a href="#" class="block p-4 hover:bg-surface-muted transition-colors">
            <div class="flex items-start gap-3">
                <div class="rounded-full bg-warning/10 p-2">
                    <x-heroicon-o-exclamation-triangle class="h-5 w-5 text-warning" />
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-medium text-primary truncate">Assignment due soon</p>
                    <p class="mt-0.5 text-sm text-secondary">Module 3 quiz due in 2 days</p>
                    <p class="mt-1 text-xs text-secondary">Yesterday</p>
                </div>
            </div>
        </a>

        <!-- Add more items or use @livewire here -->
    </div>
</div>
