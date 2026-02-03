@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-primary">AI Assistant</h1>
        <a href="/" class="text-sm text-secondary hover:text-primary">Back to Dashboard</a>
    </div>

    <div class="surface-card rounded-xl border border-subtle flex flex-col h-[600px] overflow-hidden">
        <!-- Chat Header -->
        <div class="p-4 border-b border-subtle bg-surface-muted/30 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-accent text-white flex items-center justify-center">
                    @svg('heroicon-o-chat-bubble-left-right', 'w-6 h-6')
                </div>
                <div>
                    <h3 class="font-semibold text-primary">Chatbot</h3>
                    <p class="text-xs text-secondary">Online</p>
                </div>
            </div>
            <button class="text-secondary hover:text-primary">
                @svg('heroicon-o-ellipsis-horizontal', 'w-6 h-6')
            </button>
        </div>

        <!-- Messages Area (Empty State) -->
        <div class="flex-1 p-6 overflow-y-auto flex flex-col items-center justify-center text-center space-y-4 bg-surface-card">
            <div class="w-16 h-16 rounded-full bg-surface-muted flex items-center justify-center">
                 @svg('heroicon-o-sparkles', 'w-8 h-8 text-secondary')
            </div>
            <div>
                <h3 class="text-lg font-medium text-primary">How can I help you today?</h3>
                <p class="text-sm text-secondary max-w-sm mx-auto mt-1">
                    Ask me about your courses, students, or system configurations. I'm here to assist.
                </p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 w-full max-w-lg mt-6">
                <button class="p-3 rounded-lg border border-subtle hover:bg-surface-muted text-sm text-left text-secondary hover:text-primary transition-colors">
                    "How do I create a new course?"
                </button>
                <button class="p-3 rounded-lg border border-subtle hover:bg-surface-muted text-sm text-left text-secondary hover:text-primary transition-colors">
                    "Show me recent user activity"
                </button>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-4 border-t border-subtle bg-surface-card">
            <div class="relative">
                <input 
                    type="text" 
                    placeholder="Type your message..." 
                    class="w-full pl-4 pr-12 py-3 rounded-xl bg-surface-muted border-none focus:ring-2 focus:ring-accent text-primary placeholder-secondary"
                >
                <button class="absolute right-2 top-1/2 -translate-y-1/2 p-2 rounded-lg bg-accent text-white hover:opacity-90 transition-opacity">
                    @svg('heroicon-m-paper-airplane', 'w-5 h-5')
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
