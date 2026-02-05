<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Student\Auth\LoginController;
use App\Http\Controllers\Student\Auth\RegisterController;
use App\Http\Controllers\Student\VerificationController;
use App\Http\Controllers\Student\Auth\LogoutController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\Profile\ProfileController;
use App\Http\Controllers\Instructor\Auth\LoginController as InstructorLoginController;
use App\Http\Controllers\Instructor\Auth\LogoutController as InstructorLogoutController;
use App\Http\Controllers\Instructor\DashboardController as InstructorDashboardController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;

/* Landing page → redirect to registration */
Route::get('/', fn() => redirect()->route('student.register'));

// Global login route for middleware redirects (resolves `route('login')`)
Route::get('/login', fn() => redirect()->route('student.login'))->name('login');

// Global verification notice used by the `verified` middleware
Route::get('/email/verify', function () {
    $user = auth()->user();
    if (!$user) return redirect()->route('login');
    return view('student.auth.verify_otp', ['email' => $user->email]);
})->middleware('auth')->name('verification.notice');

// ============== STUDENT ROUTES ==============
Route::prefix('student')->name('student.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class,'login'])->name('login.submit');

        Route::get('/register', [RegisterController::class,'showRegistrationForm'])->name('register');
        Route::post('/register', [RegisterController::class,'register'])->name('register.submit');
    });

    Route::get('/verify-otp/{email}', [VerificationController::class,'showVerifyForm'])->name('otp.verify');
    Route::post('/verify-otp', [VerificationController::class,'verify'])->name('otp.submit');
    Route::get('/resend-otp/{email}', [VerificationController::class,'resendOtp'])->name('otp.resend');

    Route::middleware(['auth', 'verified', 'student'])->group(function () {
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [LogoutController::class,'studentLogout'])->name('logout');
        
        // Profile routes
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/{user}', [ProfileController::class, 'show'])->name('show');
            Route::get('/', [ProfileController::class, 'edit'])->name('edit');
            Route::put('/', [ProfileController::class, 'update'])->name('update');
        });
    });
});

// ============== INSTRUCTOR ROUTES ==============
Route::prefix('instructor')->name('instructor.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/login', [InstructorLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [InstructorLoginController::class, 'login'])->name('login.submit');
    });

    Route::middleware(['auth', 'verified', 'instructor'])->group(function () {
        Route::get('/dashboard', [InstructorDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [InstructorLogoutController::class, 'logout'])->name('logout');
        
        // Placeholder routes for future implementation
        Route::get('/courses', fn() => view('instructor.courses'))->name('courses');
        Route::get('/students', fn() => view('instructor.students'))->name('students');
        Route::get('/assignments', fn() => view('instructor.assignments'))->name('assignments');
        Route::get('/grades', fn() => view('instructor.grades'))->name('grades');
        Route::get('/announcements', fn() => view('instructor.announcements'))->name('announcements');
        Route::get('/resources', fn() => view('instructor.resources'))->name('resources');
        Route::get('/profile', fn() => view('instructor.profile'))->name('profile');
    });
});

// ============== ADMIN ROUTES ==============
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    });

    Route::middleware(['auth', 'verified', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});


