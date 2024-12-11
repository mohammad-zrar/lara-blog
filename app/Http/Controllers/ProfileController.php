<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show($username) 
    {
        $user = User::where('username', $username)->firstOrFail();

        $isMine = Auth::check() && Auth::user()->id === $user->id;
            

        return view('profile.profile', [
            'user' => $user,
            'isMine'=> $isMine,
        ]);
    }

    public function edit(string $username)
{
    $user = User::where('username', $username)->firstOrFail();

    // Ensure the logged-in user is the owner of the profile
    if (Auth::user()->id !== $user->id) {
        abort(403, 'You are not authorized to edit this profile.');
    }

    return view('profile.edit', compact('user'));
}

}
