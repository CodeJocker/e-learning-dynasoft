<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-primary">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js']) <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="h-full font-sans antialiased text-primary bg-primary" x-data="{
    sidebarOpen: window.innerWidth >= 1024,
    notificationOpen: false,
    chatOpen: false,
    searchOpen: false,
    isMobile: window.innerWidth < 1024,
    init() {
        window.addEventListener('resize', () => {
            this.isMobile = window.innerWidth < 1024;
            if (!this.isMobile) {
                this.sidebarOpen = true;
                this.searchOpen = false;
            } else {
                this.sidebarOpen = false;
            }
        });
    },
    toggleSidebar() {
        this.sidebarOpen = !this.sidebarOpen;
    },
    toggleNotification() {
        if (this.isMobile) {
            window.location.href = '/notifications';
        } else {
            this.notificationOpen = !this.notificationOpen;
            if (this.notificationOpen) this.chatOpen = false;
        }
    },
    toggleChat() {
        if (this.isMobile) {
            window.location.href = '/messages';
        } else {
            this.chatOpen = !this.chatOpen;
            if (this.chatOpen) this.notificationOpen = false;
        }
    }
}">

    <div class="flex h-screen overflow-hidden">
        <div x-show="sidebarOpen && isMobile" x-cloak
            class="fixed inset-0 z-40 bg-gray-900/50 backdrop-blur-sm transition-opacity" @click="sidebarOpen = false">
        </div>

        <x-layout.sidebar />

        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden transition-all duration-300"
            :class="{ 'mr-80': (notificationOpen || chatOpen) && !isMobile }">

            <!-- Header -->
            <x-layout.header />

            <!-- Page Content -->
            <main class="w-full grow p-4 sm:p-6">
                @yield('content')
            </main>
        </div>

        <div class="hidden lg:block">
            <x-layout.right-panel title="Notifications" trigger="notificationOpen" @close="notificationOpen = false">
                <div class="h-full flex flex-col items-center justify-center p-6 text-center text-secondary opacity-70">
                    <div class="w-16 h-16 bg-surface-muted rounded-full flex items-center justify-center mb-4">
                        @svg('heroicon-o-bell-slash', 'w-8 h-8 text-secondary')
                    </div>
                    <h4 class="text-base font-medium text-primary">No new notifications</h4>
                    <p class="text-sm mt-1">We'll let you know when something arrives.</p>
                </div>
            </x-layout.right-panel>

            <x-layout.right-panel title="Messages" trigger="chatOpen" @close="chatOpen = false">
                <div class="h-full flex flex-col items-center justify-center p-6 text-center text-secondary opacity-70">
                    <div class="w-16 h-16 bg-surface-muted rounded-full flex items-center justify-center mb-4">
                        @svg('heroicon-o-chat-bubble-oval-left', 'w-8 h-8 text-secondary')
                    </div>
                    <h4 class="text-base font-medium text-primary">No messages yet</h4>
                    <p class="text-sm mt-1">Start a conversation with your students or instructors.</p>
                </div>
            </x-layout.right-panel>
        </div>

    </div>
</body>

</html>
