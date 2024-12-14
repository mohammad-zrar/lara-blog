<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('blogs.create', compact('categories'));
    }

   public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s\-_]+$/',
        'content' => 'required|string',
        'category' => 'required|exists:categories,id',
    ], [
        'title.regex' => 'The title may only contain letters, numbers, spaces, dashes, and underscores.'
    ]);

    // Generate a base slug from the title
    $slug = Str::slug($validatedData['title']);

    // Ensure the slug is unique by appending a counter if needed
    $originalSlug = $slug;
    $counter = 1;
    while (Post::where('slug', $slug)->exists()) {
        $slug = "{$originalSlug}-{$counter}";
        $counter++;
    }

    // Create the post
    Post::create([
        'user_id' => Auth::id(),
        'title' => $validatedData['title'],
        'slug' => $slug,
        'content' => $validatedData['content'],
        'category_id' => $validatedData['category'],
    ]);

    // Redirect to the user's profile with a success message
    return redirect()
        ->route('profile', Auth::user()->username)
        ->with('success', 'Blog post created successfully!');
}

}
