<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Show all lessons for a course
     */
    public function index(Course $course)
    {
        $lessons = $course->lessons()->ordered()->paginate(5);

        return view('instructor.lessons.index', compact('course', 'lessons'));
    }

    /**
     * Show form to add new lesson
     */
    public function create(Course $course)
    {
        $nextOrder = $course->lessons()->max('order') + 1 ?? 1;

        return view('instructor.lessons.create', compact('course'));
    }

    /**
     * Store new lesson
     */
    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'order' => 'required|integer|min:1',
            'type' => 'required|in:text,video,audio,document,external,quiz',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'duration_minutes' => 'nullable|integer|min:1',
        ]);

        $course->lessons()->create($validated);

        return redirect()->route('instructor.lessons.index', $course)
            ->with('success', 'Lesson created successfully.');
    }

    /**
     * Show form to edit lesson
     */
    public function edit(Course $course, Lesson $lesson)
    {
        return view('instructor.lessons.edit', compact('course', 'lesson'));
    }

    /**
     * Update lesson
     */
    public function update(Request $request, Course $course, Lesson $lesson)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'order' => 'required|integer|min:1',
            'type' => 'required|in:text,video,audio,document,external,quiz',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'duration_minutes' => 'nullable|integer|min:1',
        ]);

        $lesson->update($validated);

        return redirect()->route('instructor.lessons.index', $course)
            ->with('success', 'Lesson updated successfully.');
    }

    /**
     * Delete lesson
     */
    public function destroy(Course $course, Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->route('instructor.lessons.index', $course)
            ->with('success', 'Lesson deleted successfully.');
    }
}
