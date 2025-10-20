<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProfileController;

// Wrap web routes so our SetLocale middleware runs
Route::middleware(['setlocale'])->group(function () {

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

// Settings page (controller-based)
Route::get('settings', [ProfileController::class, 'settings'])
    ->middleware(['auth'])->name('settings');

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

// Locale switcher
Route::get('lang/{locale}', function ($locale) {
    // basic allow-list: adjust as needed
    $available = ['en', 'es'];

    if (! in_array($locale, $available)) {
        abort(404);
    }

    session(['locale' => $locale]);

    // If user is authenticated, persist their preference
    if (Auth::check()) {
        try {
            $user = Auth::user();
            if (in_array('language', array_keys($user->getAttributes()))) {
                $user->language = $locale;
                $user->save();
            }
        } catch (\Exception $e) {
            // don't break switching on persistence errors; session still set
        }
    }

    return redirect()->back();
})->name('lang.switch');

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/recruits', App\Livewire\Recruits\Index::class)->name('recruits.index');
//     Route::get('/recruits/create', function() {
//         return view('recruits.create');
//     })->name('recruits.create');
//     Route::get('/recruits/{recruit}', function($recruit) {
//         return view('recruits.show', compact('recruit'));
//     })->name('recruits.show');
//     Route::get('/recruits/{recruit}/edit', function($recruit) {
//         return view('recruits.edit', compact('recruit'));
//     })->name('recruits.edit');
// });

// User management routes (make available globally)
Route::resource('users', App\Http\Controllers\UserController::class)->middleware(['auth', 'verified']);

// Logout route
Route::post('logout', LogoutController::class)->name('logout');


    require __DIR__.'/auth.php';

});
