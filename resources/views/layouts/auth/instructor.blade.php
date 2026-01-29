@extends('layouts.auth._base-auth')

@section('page-title', 'Instructor Dashboard')

@section('sidebar')
    <x-ui.sidebar-link href="{{ route('instructor.dashboard') ?? '#' }}" active icon="chart-pie">Dashboard</x-ui.sidebar-link>
    <x-ui.sidebar-link href="{{ route('instructor.courses') ?? '#' }}" icon="book-open">My Courses</x-ui.sidebar-link>
    <x-ui.sidebar-link href="{{ route('instructor.students') ?? '#' }}" icon="users">My Students</x-ui.sidebar-link>
    <x-ui.sidebar-link href="{{ route('instructor.assignments') ?? '#' }}" icon="document-check">Assignments & Quizzes</x-ui.sidebar-link>
    <x-ui.sidebar-link href="{{ route('instructor.grades') ?? '#' }}" icon="star">Grades & Progress</x-ui.sidebar-link>
    <x-ui.sidebar-link href="{{ route('instructor.announcements') ?? '#' }}" icon="megaphone">Announcements</x-ui.sidebar-link>
    <x-ui.sidebar-link href="{{ route('instructor.resources') ?? '#' }}" icon="cloud-arrow-up">Resources</x-ui.sidebar-link>
    <x-ui.sidebar-link href="{{ route('instructor.profile') ?? '#' }}" icon="currency-dollar">Profile & Earnings</x-ui.sidebar-link>
@endsection
