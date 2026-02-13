<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Quiz;
use App\Models\Lesson;
use App\Models\CourseEnrollment;
use App\Models\CourseProgress;

class InstructorDashboardController extends Controller
{
    public function index()
    {
        $instructorId = 1;

        // Courses stats
        $courses = Course::where("instructor_id", $instructorId)->get();
        $totalCourses = $courses->count();
        $totalEnrollments = CourseEnrollment::whereIn(
            "course_id",
            $courses->pluck("id"),
        )->count();
        $averageCompletion =
            CourseProgress::whereIn("course_id", $courses->pluck("id"))->avg(
                "percent_completed",
            ) ?? 0;

        // Lessons stats
        $totalLessons = Lesson::whereIn(
            "course_id",
            $courses->pluck("id"),
        )->count();

        // Quizzes stats
        $totalQuizzes = Quiz::whereIn(
            "course_id",
            $courses->pluck("id"),
        )->count();

        // Recent activity (e.g., recent enrollments)
        $recentEnrollments = CourseEnrollment::whereIn(
            "course_id",
            $courses->pluck("id"),
        )
            ->latest()
            ->take(5)
            ->with("user", "course")
            ->get();

        // Chart data (enrollments over time)
        $enrollmentData = CourseEnrollment::whereIn(
            "course_id",
            $courses->pluck("id"),
        )
            ->selectRaw("DATE(enrolled_at) as date, COUNT(*) as count")
            ->groupBy("date")
            ->orderBy("date")
            ->get();

        $chartLabels = $enrollmentData->pluck("date");
        $chartData = $enrollmentData->pluck("count");

        return view(
            "instructor.dashboard",
            compact(
                "totalCourses",
                "totalEnrollments",
                "averageCompletion",
                "totalLessons",
                "totalQuizzes",
                "recentEnrollments",
                "chartLabels",
                "chartData",
            ),
        );
    }
}
