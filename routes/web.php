<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\QuizController;

// Student Auth & Dashboard
use App\Http\Controllers\Student\Auth\LoginController;
use App\Http\Controllers\Student\Auth\RegisterController;
use App\Http\Controllers\Student\Auth\LogoutController;
use App\Http\Controllers\Student\VerificationController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\Profile\ProfileController as StudentProfileController;

// Instructor Auth & Dashboard
use App\Http\Controllers\Instructor\Auth\LoginController as InstructorLoginController;
use App\Http\Controllers\Instructor\Auth\LogoutController as InstructorLogoutController;
use App\Http\Controllers\InstructorDashboardController;

// Admin Auth & Dashboard
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminInstructorController;

// Shared/General Profile (for Admin/Instructors)
use App\Http\Controllers\ProfileController as SharedProfileController;

/*
|--------------------------------------------------------------------------
| Public & Global Routes
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect()->route('student.login'));

// Global login route for middleware redirects
Route::get('/login', fn() => redirect()->route('student.login'))->name('login');

// Chatbot
Route::view("/chatbot", "chatbot")->name("chatbot");

// Global verification notice
Route::get('/email/verify', function () {
    $user = auth()->user();
    if (!$user) return redirect()->route('login');
    return view('auth.verify_otp', ['email' => $user->email]);
})->middleware('auth')->name('verification.notice');

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/

Route::prefix('student')->name('student.')->group(function () {

    // Guest routes
    Route::middleware('guest:student')->group(function () {
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    });

    // Verification
    Route::get('/verify/{email}', [VerificationController::class, 'showVerifyForm'])->name('showVerifyForm');
    Route::post('/verify-otp', [VerificationController::class, 'verify'])->name('otp.submit');
    Route::post('/resend-otp', [VerificationController::class, 'resendOtp'])->name('otp.resend');

    // Authenticated Student Routes
    Route::middleware(['auth:student', 'verified'])->group(function () {
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [LogoutController::class, 'studentLogout'])->name('logout');
        
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/{user}', [StudentProfileController::class, 'show'])->name('show');
            Route::get('/', [StudentProfileController::class, 'edit'])->name('edit');
            Route::put('/', [StudentProfileController::class, 'update'])->name('update');
        });
    });
});

/*
|--------------------------------------------------------------------------
| Instructor Routes
|--------------------------------------------------------------------------
*/

Route::prefix('instructor')->name('instructor.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/login', [InstructorLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [InstructorLoginController::class, 'login'])->name('login.submit');
    });

    Route::middleware(['auth', 'verified', 'role:instructor'])->group(function () {
        Route::get('/dashboard', [InstructorDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [InstructorLogoutController::class, 'logout'])->name('logout');
        
        // Course Management (Lessons & Quizzes)
        Route::prefix('courses/{course}')->group(function () {
            Route::resource('lessons', LessonController::class);
            Route::resource('quizzes', QuizController::class);
        });

        // Other Instructor Pages
        Route::view('/students', 'instructor.students')->name('students');
        Route::view('/assignments', 'instructor.assignments')->name('assignments');
        Route::view('/grades', 'instructor.grades')->name('grades');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    });

    Route::middleware(['auth', 'verified', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        // Instructor Management
        Route::get('/instructors/create', [AdminInstructorController::class, 'create'])->name('instructors.create');
        Route::post('/instructors', [AdminInstructorController::class, 'store'])->name('instructors.store');
    });
});

/*
|--------------------------------------------------------------------------
| Shared Authenticated Routes (Admin/Instructor)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [SharedProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [SharedProfileController::class, 'update'])->name('profile.update');
});