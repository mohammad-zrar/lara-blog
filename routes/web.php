<?php

use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/sign-in', function() {
    return view('auth.sign-in');
});

Route::post('/sign-in', [SessionController::class, 'store']);

Route::get('/sign-up', function() {
    return view('auth.sign-up');
});

Route::get('/forgot-password', function() {
    return view("auth.forgot-password");
});


