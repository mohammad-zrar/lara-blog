<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\File;

class UserController extends Controller
{
    public function follow(User $user)
    {
        /** @var \App\Models\User $currentUser */
        $currentUser = Auth::user();

        if (!$currentUser->following()->where('follower_id', $user->id)->exists()) {
            $currentUser->following()->attach($user->id);
        }

        return redirect()->back();
    }


    public function unfollow(User $user)
    {
        /** @var \App\Models\User $currentUser */
        $currentUser = Auth::user();

        if ($currentUser->following()->where('follower_id', $user->id)->exists()) {
            $currentUser->following()->detach($user->id);
        }

        return redirect()->back();
    }


}
