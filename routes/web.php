<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('student.register');
});

// Authentication Routes
Route::get('/login', [App\Http\Controllers\Student\Auth\AuthController::class, 'showLoginForm'])->name('student.login');
Route::post('/login', [App\Http\Controllers\Student\Auth\AuthController::class, 'login'])->name('student.login.submit');

Route::get('/register', [App\Http\Controllers\Student\Auth\RegisterController::class, 'showRegistrationForm'])->name('student.register');
Route::post('/register', [App\Http\Controllers\Student\Auth\RegisterController::class, 'register'])->name('student.register.submit');

// OTP Verification Routes
Route::get('/verify-otp', [App\Http\Controllers\Student\Auth\VerificationController::class, 'showVerifyForm'])->name('student.verify.otp');
Route::post('/verify-otp', [App\Http\Controllers\Student\Auth\VerificationController::class, 'verify'])->name('student.verify.otp.submit');
Route::post('/resend-otp', [App\Http\Controllers\Student\Auth\VerificationController::class, 'resend'])->name('student.resend.otp');

// Student Routes (protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Student\Auth\AuthController::class, 'dashboard'])->name('student.dashboard');
    Route::post('/logout', [App\Http\Controllers\Student\Auth\AuthController::class, 'logout'])->name('student.logout');
});
