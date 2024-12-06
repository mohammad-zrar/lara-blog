<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\File;

class UserController extends Controller
{
    public function create(Request $request) 
    {
        return view('auth.sign-up');
    }

    public function store(Request $request) 
    {
         $userAttributes = $request->validate([
            'name' => ['required'],
            'username' => ['required', 'unique:users,username'],
            'email' => ['required', 'email','confirmed', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'profile_picture' => [File::types(['png', 'jpg', 'webp'])],
        ]);
    }
}
