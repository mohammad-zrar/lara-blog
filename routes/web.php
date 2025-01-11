<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', fn() => view('home'))->name('home');


// Guest Routes
Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/sign-in', 'showLogin')->name('login');
        Route::post('/sign-in', 'login');
        Route::get('/sign-up', 'showRegister')->name('register');
        Route::post('/sign-up', 'register');
        Route::get('/forgot-password', 'showForgotPasswordForm')->name('password.request');
    });
});

// Authenticated Routes
Route::middleware('auth')->group(callback: function () {
    Route::controller(AuthController::class)->group(function () {
        Route::delete('/sign-out', 'logout')->name('logout');
    });

    Route::controller(UserController::class)->group(function () {
        Route::post('/users/{user}/follow', 'follow')->name('user.follow');
        Route::post('/users/{user}/unfollow', 'unfollow')->name('user.unfollow');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/{username}/edit', 'edit')->name('profile.edit');
        Route::patch('/{username}', 'update')->name('profile.update');
    });

    Route::controller(PostController::class)->group(function () {
        Route::get('/blogs/create', 'create')->name('blog.create');
        Route::post('/blogs', 'store')->name('blog.store');
    });
});
Route::get("/blogs/{slug}", [PostController::class, "show"])->name('showBlog');
Route::get('/{username}', [ProfileController::class, 'show'])->where('username', '[A-Za-z0-9_-]+')->name('showProfile');


// Public API Routes
Route::get('/api/categories/{category}/tags', [TagController::class, 'getTagsByCategory']);