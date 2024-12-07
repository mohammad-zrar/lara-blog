<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/sign-in', function () {
    return view('auth.sign-in');
})->name('sign-in');

Route::post('/sign-in', [SessionController::class, 'store']);

Route::get('/sign-up', function () {
    return view('auth.sign-up');
})->name('sign-up');

Route::post('/sign-up', [UserController::class, 'store']);

Route::get('/forgot-password', function () {
    return view("auth.forgot-password");
})->name('forgot-password');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::delete('/sign-out', [SessionController::class, 'destroy'])->middleware('auth');

