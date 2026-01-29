<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-primary">
<<<<<<< HEAD

=======
>>>>>>> a7bd5af8be71e6a4a5b96451e382acd55905636f
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

<<<<<<< HEAD
    <title>{{ config('app.name', 'Laravel') }}</title>
=======
    <title>{{ config('app.name', 'E-learn') }}</title>
>>>>>>> a7bd5af8be71e6a4a5b96451e382acd55905636f

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

<<<<<<< HEAD
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

=======
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body
    class="h-full font-sans antialiased text-primary bg-primary"
    x-data="{
        sidebarOpen: window.innerWidth >= 1024,
        notificationOpen: false,
        chatOpen: false,
        searchOpen: false,
        chatbotOpen: false,
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
                if (this.notificationOpen) {
                    this.chatOpen = false;
                    this.chatbotOpen = false;
                }
            }
        },

        toggleChat() {
            if (this.isMobile) {
                window.location.href = '/messages';
            } else {
                this.chatOpen = !this.chatOpen;
                if (this.chatOpen) {
                    this.notificationOpen = false;
                    this.chatbotOpen = false;
                }
            }
        },

        toggleChatbot() {
            if (this.isMobile) {
                window.location.href = '/chatbot';
            } else {
                this.chatbotOpen = !this.chatbotOpen;
                if (this.chatbotOpen) {
                    this.notificationOpen = false;
                    this.chatOpen = false;
                }
            }
        }
    }"
>

<div class="flex h-screen overflow-hidden">

    <!-- Mobile overlay -->
    <div
        x-show="sidebarOpen && isMobile"
        x-cloak
        class="fixed inset-0 z-40 bg-gray-900/50 backdrop-blur-sm"
        @click="sidebarOpen = false"
    ></div>

    <!-- Sidebar -->
    <x-layout.sidebar />

    <!-- Main content -->
    <div
        class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden transition-all duration-300"
        :class="{ 'mr-80': (notificationOpen || chatOpen || chatbotOpen) && !isMobile }"
    >
        <x-layout.header />

        <main class="w-full grow p-4 sm:p-6">
            @yield('content')

            <div 
                class="fixed bottom-6 z-50 transition-all duration-300"
                :class="(notificationOpen || chatOpen || chatbotOpen) && !isMobile ? 'right-[21.5rem]' : 'right-6'"
            >

                <button
                    @click="toggleChatbot()"
                    class="
                        relative
                        w-14 h-14
                        rounded-full
                        bg-accent
                        text-white
                        shadow-lg
                        flex items-center justify-center
                        transition
                        duration-300
                        hover:scale-110
                        focus:outline-none
                        animate-pulse
                    "
                    aria-label="Open chatbot"
                >
                    @svg('heroicon-o-chat-bubble-left-right', 'w-7 h-7')
                </button>

            </div>
        </main>
    </div>

    <!-- Right panels -->


    <div class="hidden lg:block">

        <x-layout.right-panel
            title="Notifications"
            trigger="notificationOpen"
            @close="notificationOpen = false"
        >
            <div class="h-full flex flex-col items-center justify-center p-6 text-center text-secondary opacity-70">
                <div class="w-16 h-16 bg-surface-muted rounded-full flex items-center justify-center mb-4">
                    @svg('heroicon-o-bell-slash', 'w-8 h-8 text-secondary')
                </div>
                <h4 class="text-base font-medium text-primary">No new notifications</h4>
                <p class="text-sm mt-1">We'll let you know when something arrives.</p>
            </div>
        </x-layout.right-panel>

        <x-layout.right-panel
            title="Messages"
            trigger="chatOpen"
            @close="chatOpen = false"
        >
            <div class="h-full flex flex-col items-center justify-center p-6 text-center text-secondary opacity-70">
                <div class="w-16 h-16 bg-surface-muted rounded-full flex items-center justify-center mb-4">
                    @svg('heroicon-o-chat-bubble-oval-left', 'w-8 h-8 text-secondary')
                </div>
                <h4 class="text-base font-medium text-primary">No messages yet</h4>
                <p class="text-sm mt-1">Start a conversation with your students or instructors.</p>
            </div>
        </x-layout.right-panel>

        <x-layout.right-panel
            title="AI Assistant"
            trigger="chatbotOpen"
            @close="chatbotOpen = false"
        >
            <div class="h-full flex flex-col items-center justify-center p-6 text-center text-secondary opacity-70">
                <div class="w-16 h-16 bg-surface-muted rounded-full flex items-center justify-center mb-4">
                    @svg('heroicon-o-chat-bubble-left-right', 'w-8 h-8 text-secondary')
                </div>
                <h4 class="text-base font-medium text-primary">How can I help?</h4>
                <p class="text-sm mt-1">Ask me anything about your courses or the platform.</p>
            </div>
        </x-layout.right-panel>

    </div>
</div>
</body>
>>>>>>> a7bd5af8be71e6a4a5b96451e382acd55905636f
</html>
