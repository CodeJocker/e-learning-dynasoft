@props(['title', 'value', 'icon', 'color' => 'accent-primary', 'trend' => null, 'trendUp' => true])

<div class="surface-card rounded-xl p-6 shadow-sm border border-subtle hover:shadow-md transition-shadow duration-300">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-sm font-medium text-secondary">{{ $title }}</h3>
        <div class="p-2 rounded-lg bg-[var(--{{ $color }})]/10 text-{{ $color == 'accent-primary' ? 'accent' : ($color == 'accent-secondary' ? 'accent-secondary' : $color) }}">
            @svg($icon, 'w-6 h-6')
        </div>
    </div>
    
    <div class="flex items-end justify-between">
        <div class="text-2xl font-bold text-primary">
            {{ $value }}
        </div>
        
        @if($trend)
            <div class="flex items-center text-sm font-medium {{ $trendUp ? 'text-success' : 'text-error' }}">
                @if($trendUp)
                    @svg('heroicon-m-arrow-trending-up', 'w-4 h-4 mr-1')
                @else
                    @svg('heroicon-m-arrow-trending-down', 'w-4 h-4 mr-1')
                @endif
                {{ $trend }}
            </div>
        @endif
    </div>
</div>
