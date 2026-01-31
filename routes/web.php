<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::view('/chatbot', 'chatbot')->name('chatbot');
