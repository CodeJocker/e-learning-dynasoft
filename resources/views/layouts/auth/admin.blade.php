@extends('layouts.auth._base-auth')

@section('page-title', 'Admin Dashboard')

@section('sidebar')
    <x-ui.sidebar-link href="#" active icon="chart-bar">Overview</x-ui.sidebar-link>
    <x-ui.sidebar-link href="#" icon="users">Users</x-ui.sidebar-link>
    <x-ui.sidebar-link href="#" icon="book-open">Courses</x-ui.sidebar-link>
    <x-ui.sidebar-link href="#" icon="folder-open">Categories</x-ui.sidebar-link>
    <x-ui.sidebar-link href="#" icon="academic-cap">Certificates</x-ui.sidebar-link>
    <x-ui.sidebar-link href="#" icon="folder">Portfolios</x-ui.sidebar-link>
    <x-ui.sidebar-link href="#" icon="clipboard-document-list">System Logs</x-ui.sidebar-link>
    <x-ui.sidebar-link href="#" icon="cog-6-tooth">Settings</x-ui.sidebar-link>
@endsection
