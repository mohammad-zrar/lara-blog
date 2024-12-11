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
    {
        Log::info('Test');
        $userAttributes = $request->validate([
            'full_name' => ['required', 'string', 'max:50',  'regex:/^[a-zA-Z\s]+$/'],
            'username' => ['required', 'string', 'alpha_dash', 'min:3', 'max:20', 'unique:users,username',  'not_regex:/[@#!$%^&*]/'],
            'email' => ['required', 'email', 'unique:users,email', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'profile_picture' => ['nullable', File::types(['png', 'jpg', 'webp'])],
            'bio' => ['nullable', 'string', 'max:500'],
        ]);

        if ($request->hasFile('profile_picture')) {
            $userAttributes['profile_picture'] = $request->file('profile_picture')->storeAs(
                'profile_images', 
                uniqid() . '.' . $request->file('profile_picture')->extension(), 
                'public' 
            );
        } else {
            $userAttributes['profile_picture'] = 'profile_images/default-avatar.png';
        }

        $userAttributes['password'] = Hash::make($userAttributes['password']);

        User::create($userAttributes);

        return redirect()->route('sign-in')->with('success', 'Account created');
    }
}
