<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $enrolledCourses = 0; // TODO: Implement enrolled courses
        $progress = 0; // TODO: Implement progress
        
        return view('student.dashboard', [
            'user' => $user,
            'enrolledCourses' => $enrolledCourses,
            'progress' => $progress,
        ]);
    }
}
