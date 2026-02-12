<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $courseCount = 0; // TODO: Implement course count
        $studentCount = 0; // TODO: Implement student count
        
        return view('instructor.dashboard', [
            'user' => $user,
            'courseCount' => $courseCount,
            'studentCount' => $studentCount,
        ]);
    }
}
