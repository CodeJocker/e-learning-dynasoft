@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-primary">Notifications</h1>
        <a href="/" class="text-sm text-secondary hover:text-primary">Back to Dashboard</a>
    </div>

    <div class="flex flex-col items-center justify-center p-12 text-center text-secondary opacity-70 border border-dashed border-subtle rounded-xl bg-surface-muted/30">
        <div class="w-16 h-16 bg-surface-muted rounded-full flex items-center justify-center mb-4">
            @svg('heroicon-o-bell-slash', 'w-8 h-8 text-secondary')
        </div>
        <h4 class="text-lg font-medium text-primary">No new notifications</h4>
        <p class="text-sm mt-1">We'll let you know when something arrives.</p>
    </div>
</div>
@endsection
