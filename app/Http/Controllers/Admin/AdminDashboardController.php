<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        
        $newUsersToday = User::whereDate('created_at', Carbon::today())->count();
        
        $activeUsers = User::where('updated_at', '>=', now()->subMinutes(15))->count();

        $activities = collect(); 

        $chart = new class {
            public function container() { return '<div class="h-full flex items-center justify-center bg-gray-50 border-2 border-dashed rounded-lg text-gray-400">Chart will appear here</div>'; }
            public function script() { return ''; }
        };

        return view('admin.dashboard', compact(
            'totalUsers', 
            'newUsersToday', 
            'activeUsers', 
            'activities',
            'chart'
        ));
    }
}