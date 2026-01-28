@php
    $role = session('mock_role', 'instructor');
    $links = [];

    if ($role === 'admin') {
        $links = [
             ['label' => 'Overview', 'icon' => 'chart-bar', 'url' => '#'],
             ['label' => 'Users', 'icon' => 'users', 'url' => '#'],
             ['label' => 'Courses', 'icon' => 'book-open', 'url' => '#'],
             ['label' => 'System Logs', 'icon' => 'clipboard-document-list', 'url' => '#'],
        ];
    } elseif ($role === 'instructor') {
         $links = [
             ['label' => 'Dashboard', 'icon' => 'home', 'url' => '#'],
             ['label' => 'My Courses', 'icon' => 'book-open', 'url' => '#'],
             ['label' => 'Assignments', 'icon' => 'clipboard-document-check', 'url' => '#'],
             ['label' => 'Students', 'icon' => 'users', 'url' => '#'],
        ];
    } else {
         $links = [
             ['label' => 'Dashboard', 'icon' => 'home', 'url' => '#'],
             ['label' => 'My Learning', 'icon' => 'academic-cap', 'url' => '#'],
             ['label' => 'Catalog', 'icon' => 'squares-2x2', 'url' => '#'],
             ['label' => 'Achievements', 'icon' => 'trophy', 'url' => '#'],
        ];
    }
@endphp

<!--
  Mobile: Fixed, Overlay (z-50), Transform Translate.
  Desktop: Static, Flex Item (Pushes content), Negative Margin to hide (shrinks space).
-->
<aside class="fixed inset-y-0 left-0 z-50 w-64 h-full px-5 py-8 overflow-y-auto surface-card border-r border-subtle transition-all duration-300 transform -translate-x-full lg:static lg:transform-none lg:z-auto"
       :class="{
           'translate-x-0': sidebarOpen && isMobile,
           '-translate-x-full': !sidebarOpen && isMobile,
           'lg:-ml-64': !sidebarOpen && !isMobile,
           'lg:ml-0': sidebarOpen && !isMobile
       }">
    <div class="flex items-center justify-between mb-10 px-2">
        <a href="/" class="flex items-center gap-2 font-bold text-xl tracking-tight text-primary">
            <div class="w-8 h-8 bg-accent rounded-lg flex items-center justify-center text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <span>E-Learn</span>
        </a>
        <!-- Close button for mobile -->
        <button @click="sidebarOpen = false" class="lg:hidden text-secondary hover:text-primary">
            @svg('heroicon-o-x-mark', 'w-6 h-6')
        </button>
    </div>

    <div class="flex flex-col justify-between flex-1">
        <nav class="space-y-4">
            <div class="text-xs font-semibold text-secondary uppercase tracking-wider mb-4 px-2">Menu</div>
            @foreach($links as $link)
            <a href="{{ $link['url'] }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors duration-200 hover:surface-muted text-secondary hover:text-accent group">
                @if(isset($link['icon']))
                    @svg('heroicon-o-'.$link['icon'], 'w-5 h-5 text-secondary group-hover:text-accent transition-colors')
                @endif
                <span class="font-medium">{{ $link['label'] }}</span>
            </a>
            @endforeach

            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2.5 rounded-lg transition-colors duration-200 hover:surface-muted text-secondary hover:text-accent group">
                    <div class="flex items-center gap-3">
                        @svg('heroicon-o-folder', 'w-5 h-5 text-secondary group-hover:text-accent transition-colors')
                        <span class="font-medium">Resources</span>
                    </div>
                    <svg class="w-4 h-4 text-secondary transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-collapse class="pl-10 mt-1 space-y-1">
                    <a href="#" class="block px-3 py-2 text-sm text-secondary hover:text-accent rounded-md hover:surface-muted">Documents</a>
                    <a href="#" class="block px-3 py-2 text-sm text-secondary hover:text-accent rounded-md hover:surface-muted">Videos</a>
                </div>
            </div>
        </nav>

        <div class="border-t border-subtle pt-6">
             <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-secondary hover:text-error hover:bg-error/10 transition-colors">
                @svg('heroicon-o-arrow-left-on-rectangle', 'w-5 h-5')
                <span class="font-medium">Logout</span>
             </a>
        </div>
    </div>
</aside>
