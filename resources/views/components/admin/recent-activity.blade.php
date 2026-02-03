@props(['activities' => []])

<div class="surface-card rounded-xl shadow-sm border border-subtle h-full">
    <div class="p-6 border-b border-subtle flex items-center justify-between">
        <h3 class="text-lg font-semibold text-primary">Recent Activity</h3>
        <a href="#" class="text-sm text-accent hover:text-accent-secondary font-medium">View All</a>
    </div>

    <div class="p-0 overflow-hidden">
        @if(count($activities) > 0)
            <ul class="divide-y divide-subtle">
                @foreach($activities as $activity)
                    <li class="p-4 hover:surface-muted/50 transition-colors">
                        <div class="flex space-x-3">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-full bg-[var(--accent-primary)]/10 flex items-center justify-center text-accent">
                                    @svg('heroicon-o-bolt', 'w-4 h-4')
                                </div>
                            </div>
                            <div class="flex-1 space-y-1">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-sm font-medium text-primary">
                                        {{ $activity->description }}
                                    </h3>
                                    <p class="text-xs text-secondary">
                                        {{ $activity->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <p class="text-xs text-secondary">
                                    by <span class="font-medium text-primary">{{ $activity->causer->name ?? 'System' }}</span>
                                </p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
             <div class="p-8 text-center text-secondary h-full flex flex-col items-center justify-center">
                @svg('heroicon-o-clipboard-document-list', 'w-12 h-12 mb-3 opacity-50')
                <p>Waiting for activity logs...</p>
            </div>
        @endif
    </div>
</div>
