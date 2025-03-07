<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        $blogs = Post::where('user_id', $user->id)->latest()->get();

        $savedBlogs = $user->savedBlogs()->latest()->get();

        $isMine = Auth::check() && Auth::user()->id === $user->id;

        return view('profile.profile', [
            'user' => $user,
            'blogs' => $blogs,
            'savedBlogs' => $savedBlogs,
            'isMine' => $isMine,
        ]);
    }

    public function edit(string $username)
    {
        $user = User::where('username', $username)->firstOrFail();

        if (Auth::user()->id !== $user->id) {
            abort(403, 'You are not authorized to edit this profile.');
        }

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request, string $username)
    {
        $user = User::where('username', $username)->firstOrFail();

        if (Auth::user()->id !== $user->id) {
            abort(403, 'You are not authorized to update this proifle.');
        }
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:50',
            'bio' => 'nullable|string|max:500',
            'profile_picture' => ['nullable', File::types(['png', 'jpg', 'webp'])],
        ]);

        if ($request->hasFile('profile_picture')) {
            $validatedData['profile_picture'] = $request->file('profile_picture')->storeAs(
                'profile_images',
                uniqid() . '.' . $request->file('profile_picture')->extension(),
                'public'
            );

        }


        $user->update($validatedData);

        return redirect('/' . $user->username)->with('success', 'Profile updated successfully.');
    }
}
