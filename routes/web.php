<?php

/**
 * Web Routes Configuration
 * 
 * This file defines the main web routes for the blog application.
 * The Firefly Blog plugin automatically registers its own routes under /blog.
 */

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

/**
 * Root Route Redirect
 * 
 * Redirects the root URL (/) to /blog for better SEO and user experience.
 * This ensures visitors land directly on the blog content.
 */
Route::redirect('/', '/blog');

// Alternative approach (commented out):
// Route::get('/', function () {
//     return view('welcome');
// });

/**
 * Dashboard Route
 * 
 * Protected dashboard route for authenticated users.
 * Requires 'auth' and 'verified' middleware for security.
 */
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/**
 * User Settings Routes (Currently Disabled)
 * 
 * These routes would handle user profile settings, password changes,
 * and appearance preferences. Currently commented out but can be
 * enabled when needed for user self-service functionality.
 */
// Route::middleware(['auth'])->group(function () {
//     Route::redirect('settings', 'settings/profile');
//
//     Route::get('settings/profile', Profile::class)->name('settings.profile');
//     Route::get('settings/password', Password::class)->name('settings.password');
//     Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
// });

/**
 * Authentication Routes
 * 
 * Include Laravel's default authentication routes (login, register, etc.)
 * These are defined in routes/auth.php
 */
require __DIR__.'/auth.php';
