@extends('layouts.app')

@section('content')
    @yield('content')
@endsection

@slot('sidebar')
    <x-layout.admin-sidebar />
@endslot
