<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SavedPostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');


// Guest Routes
Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/sign-in', 'showLogin')->name('login');
        Route::post('/sign-in', 'login');
        Route::get('/sign-up', 'showRegister')->name('register');
        Route::post('/sign-up', 'register');
        Route::get('/forgot-password', 'showForgotPasswordForm')->name('password.request');
        Route::post('/forgot-password', 'sendResetLinkEmail')->name('password.email');
        Route::get('/reset-password/{token}', 'showResetPasswordForm')->name('password.reset');
        Route::post('/reset-password', 'passwordUpdate')->name('password.update');
    });
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
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
        Route::get('/blogs/{slug}/edit', 'edit')->name('blog.edit');
        Route::patch('/blogs/{slug}', 'update')->name('blog.update');
        Route::delete('/blogs/{slug}', 'destroy')->name('blog.destroy');
    });

    Route::controller(SavedPostController::class)->group(function () {
        Route::post('/saved-posts/{post}', 'save')->name('saved-posts.save');
        Route::delete('/saved-posts/{post}', 'remove')->name('saved-posts.remove');
    });

    Route::controller(CommentController::class)->group(function () {
        Route::post('/comments', 'store')->name('comments.store');
        Route::patch('/comments/{comment}', 'update')->name('comments.update');
        Route::delete('/comments/{comment}', 'destroy')->name('comments.destroy');
    });
});

Route::get("/blogs/{slug}", [PostController::class, "show"])->name('showBlog');
Route::get('/{username}', [ProfileController::class, 'show'])->where('username', '[A-Za-z0-9_-]+')->name('showProfile');

// Public API Routes
Route::get('/api/categories/{category}/tags', [TagController::class, 'getTagsByCategory']);
