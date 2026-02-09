<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Show all quizzes for a course (card view)
     */
    public function index(Course $course)
    {
        $quizzes = $course->quizzes()->latest()->paginate(9); // 9 per page → perfect for 3-column grid

        return view("instructor.quizzes.index", compact("course", "quizzes"));
    }

    /**
     * Show form to create new quiz
     */
    public function create(Course $course)
    {
        return view("instructor.quizzes.create", compact("course"));
    }

    /**
     * Store new quiz
     */
    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            "title" => "required|string|max:255",
            "description" => "nullable|string",
            "time_limit_minutes" => "required|integer|min:1|max:180",
            "max_attempts" => "required|integer|min:1|max:10",
            "passing_score" => "required|integer|min:0|max:100",
        ]);

        $course->quizzes()->create($validated);

        return redirect()
            ->route("instructor.quizzes.index", $course)
            ->with("success", "Quiz created successfully.");
    }

    /**
     * Show form to edit quiz
     */
    public function edit(Course $course, Quiz $quiz)
    {
        return view("instructor.quizzes.edit", compact("course", "quiz"));
    }

    /**
     * Update quiz
     */
    public function update(Request $request, Course $course, Quiz $quiz)
    {
        $validated = $request->validate([
            "title" => "required|string|max:255",
            "description" => "nullable|string",
            "time_limit_minutes" => "required|integer|min:1|max:180",
            "max_attempts" => "required|integer|min:1|max:10",
            "passing_score" => "required|integer|min:0|max:100",
        ]);

        $quiz->update($validated);

        return redirect()
            ->route("instructor.quizzes.index", $course)
            ->with("success", "Quiz updated successfully.");
    }

    /**
     * Delete quiz
     */
    public function destroy(Course $course, Quiz $quiz)
    {
        $quiz->delete();

        return redirect()
            ->route("instructor.quizzes.index", $course)
            ->with("success", "Quiz deleted successfully.");
    }
}
