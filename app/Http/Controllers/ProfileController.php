<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show($username) 
    {
        $user = User::where('username', $username)->firstOrFail();

        $isMine = Auth::check() && Auth::user()->id === $user->id;
            

        return view('profile', [
            'user' => $user,
            'isMine'=> $isMine,
        ]);
    }
}
