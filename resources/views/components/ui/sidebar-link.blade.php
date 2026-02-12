<a href="{{ $attributes['href'] ?? '#' }}"
   {{ $attributes->class([
       'group flex items-center gap-x-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors',
       'bg-accent/10 text-accent' => $attributes->boolean('active'),
       'text-secondary hover:bg-surface-muted hover:text-primary' => !$attributes->boolean('active'),
   ]) }}
   aria-current="{{ $attributes->boolean('active') ? 'page' : 'false' }}"
>
    <x-heroicon-o-{{ $icon ?? 'circle-stack' }} class="h-5 w-5 shrink-0" aria-hidden="true" />
    <span>{{ $slot }}</span>
</a>
