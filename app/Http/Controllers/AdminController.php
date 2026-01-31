<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\UserRegistrationChart;
use App\Models\User;
use Carbon\Carbon;
use App\Models\ActivityLog;

class AdminController extends Controller
{
    public function dashboard()
    {
        $chart = new UserRegistrationChart;
        $days = [];
        $users_count = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $days[] = $date->format('j M');
            $users_count[] = User::whereDate('created_at', $date)->count(); 
        }
        $chart->labels($days);
        $chart->dataset('New Users', 'line', $users_count)
            ->color('#3b82f6')
            ->backgroundColor('#3b82f644');

        // Summary Data
        $totalUsers = User::count();
        $activeUsers = User::where('updated_at', '>=', Carbon::now()->subMinutes(5))->count(); // Mock active definition
        $newUsersToday = User::whereDate('created_at', Carbon::today())->count();
        
        // Activity Logs
        // Using Spatie Activitylog if available, otherwise empty array
        $activities = ActivityLog::latest()->take(5)->get();

        return view('admin.dashboard', [
            'chart' => $chart,
            'totalUsers' => $totalUsers,
            'activeUsers' => $activeUsers,
            'newUsersToday' => $newUsersToday,
            'activities' => $activities
        ]);
    }
}
