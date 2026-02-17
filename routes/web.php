<?php

use Illuminate\Support\Facades\Route;

// Auth Controllers
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\VerificationController;

// Dashboard & Profile
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\ProfileController;

// Admin Specific (Ensure these exist)
use App\Http\Controllers\Admin\AdminInstructorController; 
use App\Http\Controllers\LessonController;
use App\Http\Controllers\QuizController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
});

// Verification
Route::get('/verify/{email}', [VerificationController::class, 'showVerifyForm'])->name('student.showVerifyForm');
Route::post('/verify-otp', [VerificationController::class, 'verify'])->name('otp.submit');
Route::post('/resend-otp', [VerificationController::class, 'resendOtp'])->name('otp.resend');

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Shared)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // The "Universal" Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

    // Profile (Shared views)
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
});

/*
|--------------------------------------------------------------------------
| Role-Specific Routes
|--------------------------------------------------------------------------
*/

// STUDENT
Route::prefix('student')->name('student.')->middleware(['auth', 'role:student'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/my-learning', [DashboardController::class, 'studentDashboard'])->name('learning');
});

// INSTRUCTOR
Route::prefix('instructor')->name('instructor.')->middleware(['auth', 'role:instructor'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::prefix('courses/{course}')->group(function () {
        Route::resource('lessons', LessonController::class);
        Route::resource('quizzes', QuizController::class);
    });
    // Other Instructor Pages
    Route::view('/students', 'instructor.students')->name('students');
    Route::view('/assignments', 'instructor.assignments')->name('assignments');
    Route::view('/grades', 'instructor.grades')->name('grades');
});

// ADMIN
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/activity-logs', [DashboardController::class, 'adminDashboard'])->name('logs');
    
    // Instructor Management
    Route::get('/instructors/create', [AdminInstructorController::class, 'create'])->name('instructors.create');
    Route::post('/instructors', [AdminInstructorController::class, 'store'])->name('instructors.store');
});

Route::view("/chatbot", "chatbot")->name("chatbot");