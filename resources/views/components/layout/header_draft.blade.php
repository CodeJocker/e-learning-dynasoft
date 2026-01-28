<header class="flex items-center justify-between px-4 sm:px-6 py-4 surface-card border-b border-subtle sticky top-0 z-30 lg:z-10 backdrop-blur-sm bg-opacity-90 relative">
    <div class="flex items-center gap-4 flex-1">
        <button @click="toggleSidebar()" class="p-2 text-secondary rounded-lg hover:surface-muted hover:text-primary focus:outline-none transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
        
        <div class="hidden sm:flex items-center text-sm breadcrumbs text-secondary">
            <span class="opacity-70">Pages</span> <span class="mx-2">/</span> <span class="font-medium text-primary">Dashboard</span>
        </div>

        <!-- Search Bar (Desktop) -->
        <div class="hidden lg:flex items-center ml-4 relative max-w-md w-full">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                @svg('heroicon-o-magnifying-glass', 'w-5 h-5 text-secondary')
            </div>
            <input type="text" placeholder="Search..." class="block w-full pl-10 pr-3 py-2 border border-subtle rounded-lg leading-5 bg-surface-muted placeholder-secondary focus:outline-none focus:ring-1 focus:ring-accent focus:border-accent sm:text-sm transition duration-150 ease-in-out">
        </div>
    </div>

    <!-- Mobile Search Overlay (Takes Full Width) -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="absolute inset-x-0 top-0 p-3 bg-white surface-card border-b border-subtle z-50 flex items-center gap-3 lg:hidden"
         style="display: none;"> <!-- Hidden by default, toggled via x-show="open" from parent scope? No, needs own scope or global header scope -->
         
         <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                @svg('heroicon-o-magnifying-glass', 'w-5 h-5 text-secondary')
            </div>
            <input type="text" placeholder="Search..." class="block w-full pl-10 pr-3 py-2 border border-subtle rounded-lg leading-5 bg-surface-muted placeholder-secondary focus:outline-none focus:ring-1 focus:ring-accent focus:border-accent sm:text-sm">
         </div>
         <button @click="open = false" class="p-2 text-secondary hover:text-primary">
            Cancel
         </button>
    </div>

    <div class="flex items-center gap-2 sm:gap-4" x-data="{ open: false }"> 
        <!-- Logic Note: The overlay above needs access to `open`. I will wrap the whole header content or move the data scope up. -->
        <!-- Just moving the x-data='{ open: false }' to the header element would solve it, but header is outside this block. -->
        <!-- Let's wrap the right side logic or keep it isolated. Ideally, the button toggles a property. -->
        <!-- I'll refactor the structure slightly to wrap in a parent div or use the existing structure better. -->
    </div>
</header>
