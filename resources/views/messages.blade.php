@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-primary">Messages</h1>
        <a href="/" class="text-sm text-secondary hover:text-primary">Back to Dashboard</a>
    </div>

    <!-- Reusing Empty State -->
    <div class="flex flex-col items-center justify-center p-12 text-center text-secondary opacity-70 border border-dashed border-subtle rounded-xl bg-surface-muted/30">
        <div class="w-16 h-16 bg-surface-muted rounded-full flex items-center justify-center mb-4">
            @svg('heroicon-o-chat-bubble-oval-left', 'w-8 h-8 text-secondary')
        </div>
        <h4 class="text-lg font-medium text-primary">No messages yet</h4>
        <p class="text-sm mt-1">Start a conversation with your students or instructors.</p>
    </div>
</div>
@endsection
