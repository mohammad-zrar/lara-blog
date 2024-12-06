<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\File;

class UserController extends Controller
{
    public function create() 
    {
        return view('auth.sign-up');
    }

    public function store(Request $request) 
    {   
         $userAttributes = $request->validate([
            'name' => ['required', 'string', 'max:50',  'regex:/^[a-zA-Z\s]+$/' ],
            'username' => ['required', 'string', 'alpha_dash', 'min:3', 'max:20', 'unique:users,username',  'not_regex:/[@#!$%^&*]/'],
            'email' => ['required', 'email', 'unique:users,email', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'profile_picture' => [File::types(['png', 'jpg', 'webp'])],
        ]);

        dd($userAttributes);
    }
}
