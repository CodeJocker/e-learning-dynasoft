<div class="space-y-4">
    @forelse($this->notifications as $notification)
        <div class="relative group flex items-start p-4 rounded-xl surface-card border border-subtle hover:surface-muted transition-colors {{ $notification->read_at ? 'opacity-75' : 'surface-card ring-1 ring-[var(--accent-primary)]/10' }}">
            
            <!-- Icon -->
            <div class="flex-shrink-0 mr-4">
                <div class="h-10 w-10 rounded-full flex items-center justify-center {{ $notification->read_at ? 'surface-muted text-secondary' : 'bg-[var(--accent-primary)]/10 text-accent' }}">
                    @if(isset($notification->data['type']) && $notification->data['type'] == 'alert')
                         @svg('heroicon-o-exclamation-triangle', 'w-5 h-5')
                    @elseif(isset($notification->data['type']) && $notification->data['type'] == 'success')
                        @svg('heroicon-o-check-circle', 'w-5 h-5')
                    @else
                        @svg('heroicon-o-bell', 'w-5 h-5')
                    @endif
                </div>
            </div>

            <!-- Content -->
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between mb-1">
                    <p class="text-sm font-semibold text-primary truncate">
                        {{ $notification->data['title'] ?? 'Notification' }}
                    </p>
                    <span class="text-xs text-secondary">
                        {{ $notification->created_at->diffForHumans() }}
                    </span>
                </div>
                <p class="text-sm text-secondary line-clamp-2">
                    {{ $notification->data['message'] ?? 'You have a new notification.' }}
                </p>
                
                <!-- Actions -->
                <div class="mt-2 flex space-x-3 opacity-0 group-hover:opacity-100 transition-opacity">
                    @unless($notification->read_at)
                        <button wire:click="markAsRead('{{ $notification->id }}')" class="text-xs font-medium text-accent hover:text-accent-secondary">
                            Mark as Read
                        </button>
                    @endunless
                    <button wire:click="deleteNotification('{{ $notification->id }}')" class="text-xs font-medium text-secondary hover:text-error">
                        Remove
                    </button>
                </div>
            </div>

            <!-- Unread Indicator -->
            @unless($notification->read_at)
                <div class="absolute top-4 right-4 h-2 w-2 rounded-full bg-accent"></div>
            @endunless
        </div>
    @empty
        <div class="flex flex-col items-center justify-center p-8 text-center text-secondary opacity-70">
            <div class="w-16 h-16 surface-muted rounded-full flex items-center justify-center mb-4">
                @svg('heroicon-o-bell-slash', 'w-8 h-8 text-secondary')
            </div>
            <h4 class="text-base font-medium text-primary">No new notifications</h4>
            <p class="text-sm mt-1">Waiting for system events...</p>
        </div>
    @endforelse
</div>
