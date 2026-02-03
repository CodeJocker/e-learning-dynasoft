<?php

use App\Http\Controllers\LessonController;
use Illuminate\Support\Facades\Route;

Route::prefix('instructor')->name('instructor.')->group(function () {
    // No middleware for testing (you can add back later: auth, role:instructor)

    Route::get('courses/{course}/lessons', [LessonController::class, 'index'])
        ->name('lessons.index');

    Route::get('courses/{course}/lessons/create', [LessonController::class, 'create'])
        ->name('lessons.create');

    Route::post('courses/{course}/lessons', [LessonController::class, 'store'])
        ->name('lessons.store');

    Route::get('courses/{course}/lessons/{lesson}/edit', [LessonController::class, 'edit'])
        ->name('lessons.edit');

    Route::put('courses/{course}/lessons/{lesson}', [LessonController::class, 'update'])
        ->name('lessons.update');

    Route::delete('courses/{course}/lessons/{lesson}', [LessonController::class, 'destroy'])
        ->name('lessons.destroy');
});
use App\Http\Controllers\AdminController;

Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::view('/chatbot', 'chatbot')->name('chatbot');
