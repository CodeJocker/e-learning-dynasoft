<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorDashboardController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

Route::prefix("instructor")
    ->name("instructor.")
    ->group(function () {
        Route::get("courses/{course}/lessons", [
            LessonController::class,
            "index",
        ])->name("lessons.index");

        Route::get("courses/{course}/lessons/create", [
            LessonController::class,
            "create",
        ])->name("lessons.create");

        Route::post("courses/{course}/lessons", [
            LessonController::class,
            "store",
        ])->name("lessons.store");

        Route::get("courses/{course}/lessons/{lesson}/edit", [
            LessonController::class,
            "edit",
        ])->name("lessons.edit");

        Route::put("courses/{course}/lessons/{lesson}", [
            LessonController::class,
            "update",
        ])->name("lessons.update");

        Route::delete("courses/{course}/lessons/{lesson}", [
            LessonController::class,
            "destroy",
        ])->name("lessons.destroy");

        // This is a route for quizes based on the course
        Route::get("courses/{course}/quizzes", [
            QuizController::class,
            "index",
        ])->name("quizzes.index");

        Route::get("courses/{course}/quizzes/create", [
            QuizController::class,
            "create",
        ])->name("quizzes.create");

        Route::post("courses/{course}/quizzes", [
            QuizController::class,
            "store",
        ])->name("quizzes.store");

        Route::get("courses/{course}/quizzes/{quiz}/edit", [
            QuizController::class,
            "edit",
        ])->name("quizzes.edit");

        Route::put("courses/{course}/quizzes/{quiz}", [
            QuizController::class,
            "update",
        ])->name("quizzes.update");

        Route::delete("courses/{course}/quizzes/{quiz}", [
            QuizController::class,
            "destroy",
        ])->name("quizzes.destroy");

        Route::get("dashboard", [
            InstructorDashboardController::class,
            "index",
        ])->name("dashboard.index");
    });

Route::get("/", [AdminController::class, "dashboard"])->name("admin.dashboard");
Route::view("/chatbot", "chatbot")->name("chatbot");
