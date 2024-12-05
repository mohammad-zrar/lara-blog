<?php

use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/signin', function() {
    return view('auth.signin');
});
Route::post('/signin', [SessionController::class, 'store']);

Route::get('/signup', function() {
    return view('auth.signup');
});
