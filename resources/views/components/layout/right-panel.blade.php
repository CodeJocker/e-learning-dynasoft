@props(['title', 'trigger'])

<div x-cloak 
     class="fixed inset-y-0 right-0 w-80 surface-card border-l border-subtle shadow-lg transform transition-transform duration-300 ease-in-out z-40"
     :class="{ 'translate-x-0': {{ $trigger }}, 'translate-x-full': !{{ $trigger }} }">
    
    <div class="flex items-center justify-between p-4 border-b border-subtle">
        <h3 class="font-semibold text-primary">{{ $title }}</h3>
        <button @click="$emit('close')" class="p-1 text-secondary hover:text-primary rounded-md hover:surface-muted transition-colors">
            @svg('heroicon-o-x-mark', 'w-5 h-5')
        </button>
    </div>

    <div class="h-full overflow-y-auto pb-20">
        {{ $slot }}
    </div>
</div>
