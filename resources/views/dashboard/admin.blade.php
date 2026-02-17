@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-text-primary">Dashboard Overview</h1>
            <p class="text-sm text-text-secondary">Welcome back, here's what's happening today.</p>
        </div>
        <div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary/10 text-primary border border-primary/20">
                <span class="w-2 h-2 mr-2 bg-primary rounded-full animate-pulse"></span>
                Live Updates
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <x-admin.summary-card title="Total Users" value="{{ number_format($totalUsers) }}" icon="heroicon-o-users" color="accent-primary" trend="12% vs last month" :trendUp="true" />
        <x-admin.summary-card title="New Users Today" value="{{ number_format($newUsersToday) }}" icon="heroicon-o-user-plus" color="accent-secondary" trend="5% vs yesterday" :trendUp="true" />
        <x-admin.summary-card title="Active Now" value="{{ number_format($activeUsers) }}" icon="heroicon-o-signal" color="success" trend="Stable" :trendUp="true" />
        <x-admin.summary-card title="Revenue" value="$12,450" icon="heroicon-o-currency-dollar" color="warning" trend="2% vs last week" :trendUp="false" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-surface-card rounded-xl shadow-sm border border-subtle p-6">
            <div class="flex items-center justify-between mb-6">
                 <h3 class="text-lg font-semibold text-text-primary">User Registration Trends</h3>
                 <select class="text-xs bg-bg-primary border-subtle rounded-lg text-text-secondary">
                    <option>Last 7 Days</option>
                 </select>
            </div>
            <div class="relative" style="height: 300px;">
                <canvas id="userRegistrationChart"></canvas>
            </div>
        </div>

        <div class="lg:col-span-1">
             <x-admin.system-status />
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
         <div class="lg:col-span-2">
             <x-admin.recent-activity :activities="$activities" />
         </div>
         
          <div class="lg:col-span-1 bg-surface-card rounded-xl shadow-sm border border-subtle p-6">
            <h3 class="text-lg font-semibold text-text-primary mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <button class="w-full flex items-center justify-between p-3 rounded-lg bg-surface-muted hover:bg-accent-primary/10 transition-colors group">
                    <span class="text-sm font-medium">Create New Course</span>
                    @svg('heroicon-m-plus', 'w-5 h-5')
                </button>
                <button class="w-full flex items-center justify-between p-3 rounded-lg bg-surface-muted hover:bg-accent-primary/10 transition-colors group">
                    <span class="text-sm font-medium">Manage Users</span>
                    @svg('heroicon-m-users', 'w-5 h-5')
                </button>
            </div>
          </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('userRegistrationChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'New Users',
                    data: {!! json_encode($chartData) !!},
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { borderDash: [5, 5] } },
                    x: { grid: { display: false } }
                }
            }
        });
    });
</script>
@endsection