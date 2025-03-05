<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Show the login form
    public function showLogin()
    {
        return view('auth.sign-in');
    }

    // Handle login logic
    public function login(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match.',
            ]);
        }

        $request->session()->regenerate();

        return redirect('/');
    }

    // Show the registration form
    public function showRegister()
    {
        return view('auth.sign-up');
    }

    // Handle registration logic
    public function register(Request $request)
    {
        $userAttributes = $request->validate([
            'full_name' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'username' => ['required', 'string', 'alpha_dash', 'min:3', 'max:20', 'unique:users,username', 'not_regex:/[@#!$%^&*]/'],
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
        }

        $userAttributes['password'] = Hash::make($userAttributes['password']);

        User::create($userAttributes);

        return redirect()->route('sign-in')->with('success', 'Account created');
    }

    // Show forgot password form
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {

        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $email = $request->input('email');

        Mail::to($email)->send(new ResetPasswordMail());

        return redirect('/reset-password')->with('message', 'A password reset link has been sent to your email address.');
    }

    public function showResetPasswordForm()
    {
        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $token = $request->input('token');
        $password = $request->input('password');

        dd($token, $password);

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken();

        return redirect()->back();
    }
}
