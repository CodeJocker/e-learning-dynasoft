@extends('layouts.auth._base-auth')

@section('page-title', 'My Learning')

@section('sidebar')
    <x-ui.sidebar-link href="{{ route('student.dashboard') ?? '#' }}" active icon="chart-bar">Dashboard</x-ui.sidebar-link>
    <x-ui.sidebar-link href="{{ route('student.courses') ?? '#' }}" icon="book-open">My Courses</x-ui.sidebar-link>
    <x-ui.sidebar-link href="{{ route('student.in-progress') ?? '#' }}" icon="clock">In Progress</x-ui.sidebar-link>
    <x-ui.sidebar-link href="{{ route('student.completed') ?? '#' }}" icon="check-circle">Completed</x-ui.sidebar-link>
    <x-ui.sidebar-link href="{{ route('student.certificates') ?? '#' }}" icon="academic-cap">Certificates</x-ui.sidebar-link>
    <x-ui.sidebar-link href="{{ route('student.wishlist') ?? '#' }}" icon="heart">Wishlist</x-ui.sidebar-link>
    <x-ui.sidebar-link href="{{ route('student.calendar') ?? '#' }}" icon="calendar-days">Calendar</x-ui.sidebar-link>
    <x-ui.sidebar-link href="{{ route('student.profile') ?? '#' }}" icon="user-circle">Profile & Settings</x-ui.sidebar-link>
@endsection
