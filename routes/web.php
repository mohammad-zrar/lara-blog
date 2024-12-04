<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signin', function() {
    return view('auth.signin');
});

Route::get('/signup', function() {
    return view('auth.signup');
});
