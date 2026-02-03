@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-primary">Notifications</h1>
        <a href="/" class="text-sm text-secondary hover:text-primary">Back to Dashboard</a>
    </div>

    <div class="space-y-4">
         @livewire('notifications')
    </div>
</div>
@endsection
