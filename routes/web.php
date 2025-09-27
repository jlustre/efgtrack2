<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ThemeController;

// Public landing page
Route::view('/', 'landing')->name('landing');

// Role-based dashboard
Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Cross-role dashboard viewing (admin, manager, mentor accessing other user dashboards)
Route::get('dashboard/user/{userId}', [DashboardController::class, 'viewUserDashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.user');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Theme settings API routes
Route::middleware(['auth'])->group(function () {
    Route::get('api/theme', [ThemeController::class, 'get'])->name('theme.get');
    Route::post('api/theme', [ThemeController::class, 'update'])->name('theme.update');
});

// Legal pages
Route::view('privacy-policy', 'legal.privacy-policy')->name('privacy-policy');
Route::view('terms-of-service', 'legal.terms-of-service')->name('terms-of-service');
Route::view('cookie-policy', 'legal.cookie-policy')->name('cookie-policy');
Route::view('contact', 'legal.contact')->name('contact');

require __DIR__.'/auth.php';
