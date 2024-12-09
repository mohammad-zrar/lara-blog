<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\File;

class UserController extends Controller
{
    public function create() 
    {
        return view('auth.sign-up');
    }

    public function store(Request $request) 
    {     Log::info('Test');
         $userAttributes = $request->validate([
            'name' => ['required', 'string', 'max:50',  'regex:/^[a-zA-Z\s]+$/' ],
            'username' => ['required', 'string', 'alpha_dash', 'min:3', 'max:20', 'unique:users,username',  'not_regex:/[@#!$%^&*]/'],
            'email' => ['required', 'email', 'unique:users,email', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'profile_picture' => ['nullable', File::types(['png', 'jpg', 'webp'])],
        ]);

        if ($request->hasFile('profile_picture')) {
    $userAttributes['profile_picture'] = $request->file('profile_picture')->storeAs(
        'profile_images', // Directory inside 'public'
        uniqid() . '.' . $request->file('profile_picture')->extension(), // Unique file name
        'public' // Disk
    );
}
    // if($request->hasFile('profile_picture')) {
    //     $profilePicturePath = $request->profile_picture->store('profile_pictures');
    //     $userAttributes['profile_picture'] = $profilePicturePath;
    //     Log::info($userAttributes['profile_picture']);
    // }


        $userAttributes['password'] = Hash::make($userAttributes['password']);

        $user = User::create($userAttributes);

        return redirect()->route('sign-in')->with('success', 'Account created');
       
    }
}
