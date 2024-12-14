<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/sign-in', fn() => view('auth.sign-in'))->name('sign-in');
    Route::post('/sign-in', [SessionController::class, 'store']);
    
    Route::get('/sign-up', fn() => view('auth.sign-up'))->name('sign-up');
    Route::post('/sign-up', [UserController::class, 'store']);
    
    Route::get('/forgot-password', fn() => view('auth.forgot-password'))->name('forgot-password');
});

Route::get('/{username}', [ProfileController::class, 'show'])->name('profile');

Route::middleware('auth')->group(function () {
    Route::delete('/sign-out', [SessionController::class, 'destroy'])->middleware('auth');

    Route::post('/users/{user}/follow', [UserController::class, 'follow']);
    Route::post('/users/{user}/unfollow', [UserController::class, 'unfollow']);

    Route::get('/{username}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/{username}', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/blogs/create', [PostController::class, 'create'])->name('blog.create');
    Route::post('/blogs', [PostController::class, 'store'])->name('blog.store');
});

Route::get('/api/categories/{category}/tags', [TagController::class, 'getTagsByCategory']);


