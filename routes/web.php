<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\InvoiceController;



// Public routes accessible to all users
Route::group(['middleware' => 'guest'], function () {
    Route::view('/', 'welcome');
    Route::view('register', 'auth.register')->name('register');
    Route::view('login', 'auth.login')->name('login');

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::get('auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);
});

    
    

// Routes accessible only to authenticated users
Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('admin-dashboard', 'admin.dashboard')->name('admin.dashboard');
});

