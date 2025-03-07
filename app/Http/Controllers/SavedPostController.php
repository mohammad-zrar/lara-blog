<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedPost;
use Illuminate\Support\Facades\Auth;

class SavedPostController extends Controller
{
    public function save(Request $request, $postId)
    {
        $userId = Auth::id();

        // Check if the post is already saved by the user
        $savedPost = SavedPost::where('user_id', $userId)->where('post_id', $postId)->first();

        if ($savedPost) {
            return redirect()->back()->with('message', 'Post is already saved.');
        }

        // Save the post
        SavedPost::create([
            'user_id' => $userId,
            'post_id' => $postId,
        ]);

        return redirect()->back()->with('message', 'Post saved');
    }

    public function remove(Request $request, $postId)
    {
        $userId = Auth::id();

        // Check if the post is saved by the user
        $savedPost = SavedPost::where('user_id', $userId)->where('post_id', $postId)->first();

        if (!$savedPost) {
            return redirect()->back()->with('message', 'Post is not saved.');
        }

        // Remove the saved post
        $savedPost->delete();

        return redirect()->back()->with('message', 'Post removed from saved posts.');
    }
}
