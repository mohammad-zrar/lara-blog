<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password as FacadesPassword;
use Illuminate\Support\Str;

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

        return redirect()->route('login')->with('success', 'Account created');
    }

    // Show forgot password form
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        // We don't check if the email exists in the database becuase FacadesPassword contract does that for us
        $status = FacadesPassword::sendResetLink(
            $request->only('email')
        );

        return $status === FacadesPassword::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPasswordForm(string $token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = FacadesPassword::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === FacadesPassword::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken();

        return redirect()->back();
    }
}
