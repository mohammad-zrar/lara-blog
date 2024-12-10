<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
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

Route::delete('/sign-out', [SessionController::class, 'destroy'])->middleware('auth');
