<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use App\Models\ActivityLog;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\Lesson;
use App\Models\CourseEnrollment;
use App\Models\CourseProgress;

class DashboardController extends Controller
{
    public function index() 
    {
        $user = Auth::user();

        return match($user->role) {
            'student'    => $this->studentDashboard($user),
            'instructor' => $this->instructorDashboard($user),
            'admin'      => $this->adminDashboard(),
            default      => redirect('/'),
        };
    }

    // Changed from private to public
    public function studentDashboard($user = null)
    {
        $user = $user ?? Auth::user();
        
        $enrolledCoursesCount = CourseEnrollment::where('user_id', $user->id)->count();
        $overallProgress = CourseProgress::where('user_id', $user->id)->avg('percent_completed') ?? 0;

        return view('dashboard.student', [
            'user' => $user,
            'enrolledCourses' => $enrolledCoursesCount,
            'progress' => $overallProgress,
        ]);
    }

    // Changed from private to public
    public function instructorDashboard($user = null)
    {
        $user = $user ?? Auth::user();
        $instructorId = $user->id;
        $courseIds = Course::where("instructor_id", $instructorId)->pluck("id");

        $stats = [
            'totalCourses'      => $courseIds->count(),
            'totalEnrollments'  => CourseEnrollment::whereIn("course_id", $courseIds)->count(),
            'averageCompletion' => CourseProgress::whereIn("course_id", $courseIds)->avg("percent_completed") ?? 0,
            'totalLessons'      => Lesson::whereIn("course_id", $courseIds)->count(),
            'totalQuizzes'      => Quiz::whereIn("course_id", $courseIds)->count(),
        ];

        $recentEnrollments = CourseEnrollment::whereIn("course_id", $courseIds)
            ->latest()->take(5)->with("user", "course")->get();

        $enrollmentData = CourseEnrollment::whereIn("course_id", $courseIds)
            ->selectRaw("DATE(enrolled_at) as date, COUNT(*) as count")
            ->groupBy("date")->orderBy("date")->get();

        return view("dashboard.instructor", array_merge($stats, [
            'recentEnrollments' => $recentEnrollments,
            'chartLabels'       => $enrollmentData->pluck("date"),
            'chartData'         => $enrollmentData->pluck("count"),
        ]));
    }

    // Changed from private to public
    public function adminDashboard()
    {
        $days = [];
        $users_count = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $days[] = $date->format('j M');
            $users_count[] = User::whereDate('created_at', $date)->count(); 
        }

        return view('dashboard.admin', [
            'chartLabels'   => $days,
            'chartData'     => $users_count,
            'totalUsers'    => User::count(),
            'activeUsers'   => User::where('updated_at', '>=', Carbon::now()->subMinutes(5))->count(),
            'newUsersToday' => User::whereDate('created_at', Carbon::today())->count(),
            'activities'    => ActivityLog::latest()->take(5)->get()
        ]);
    }
}