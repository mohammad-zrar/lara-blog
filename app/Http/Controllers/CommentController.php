<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string|max:500',
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $validatedData['post_id'],
            'content' => $validatedData['content'],
        ]);

        return redirect()->back()->with('message', 'Comment added.');
    }

    public function update(Request $request, $commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if ($comment->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to update this comment.');
        }

        $validatedData = $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment->update($validatedData);

        return redirect()->back()->with('message', 'Comment updated.');
    }

    public function destroy(Request $request, $commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if ($comment->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to delete this comment.');
        }

        $comment->delete();

        return redirect()->back()->with('message', 'Comment deleted.');
    }
}
