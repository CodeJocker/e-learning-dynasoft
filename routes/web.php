<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;

// Public Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login']);
});

// Protected Admin Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    });

// Root fallback
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});
