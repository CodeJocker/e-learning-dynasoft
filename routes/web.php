<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\Auth\LoginController;
use App\Http\Controllers\Student\Auth\RegisterController;
use App\Http\Controllers\Student\Auth\VerificationController;
use App\Http\Controllers\Student\Auth\LogoutController;

/* Landing page → redirect to registration */
Route::get('/', fn() => redirect()->route('student.register'));

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

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::post('/logout', [LogoutController::class,'studentLogout'])->name('logout');
        Route::get('/dashboard', fn() => view('student.dashboard'))->name('dashboard');
    });
});
