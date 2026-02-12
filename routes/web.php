<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\Auth\RegisterController;
use App\Http\Controllers\Student\Auth\LoginController;
use App\Http\Controllers\Student\Auth\VerificationController;
use App\Http\Controllers\Student\Auth\LogoutController;

Route::get('/', fn() => redirect()->route('student.register'));

Route::prefix('student')->name('student.')->group(function () {

    // Guest routes (student guard)
    Route::middleware('guest:student')->group(function () {
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    });

    // OTP Verification (accessible without auth - user just registered)
    Route::get('/verify/{email}', [VerificationController::class, 'showVerifyForm'])->name('showVerifyForm');
    Route::post('/verify-otp', [VerificationController::class, 'verify'])->name('otp.submit');
    Route::post('/resend-otp', [VerificationController::class, 'resendOtp'])->name('otp.resend');

    // Authenticated & verified student routes
    Route::middleware(['auth:student', 'verified'])->group(function () {
        Route::post('/logout', [LogoutController::class, 'studentLogout'])->name('logout');
        Route::get('/dashboard', fn() => view('student.dashboard'))->name('dashboard');
    });
});
