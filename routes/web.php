<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminInstructorController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Root Redirect: Send users to the login page if they hit the home URL
Route::get('/', function () {
    return redirect()->route('admin.login');
});

// Guest Routes: Only accessible when NOT logged in
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login']);
});

// Authenticated Routes: User must be logged in
Route::middleware(['auth'])->group(function () {

    // Global Logout
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Profile Management (Shared for Admin/Instructors)
    // standardized to PUT for updates to match Laravel best practices
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    /*
    |--------------------------------------------------------------------------
    | Admin-Only Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // Instructor Management
        Route::get('/admin/instructors/create', [AdminInstructorController::class, 'create'])->name('admin.instructors.create');
        Route::post('/admin/instructors', [AdminInstructorController::class, 'store'])->name('admin.instructors.store');
    });

    /*
    |--------------------------------------------------------------------------
    | Instructor-Only Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:instructor'])->group(function () {
        Route::get('/instructor/dashboard', function () {
            return view('instructor.dashboard');
        })->name('instructor.dashboard');
    });

});