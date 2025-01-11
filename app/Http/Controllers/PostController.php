<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

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
            'category' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
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

        // Calculate the estimated reading time
        $wordCount = str_word_count($validatedData['content']);
        $readingTime = ceil($wordCount / 200); // Adjust divisor for reading speed (e.g., 200 words per minute)

        // Create the post
        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $validatedData['title'],
            'slug' => $slug,
            'content' => $validatedData['content'],
            'category_id' => $validatedData['category'] ?? null,
            'reading_time' => $readingTime, // Save reading time to the database
        ]);

        if (!empty($validatedData['tags'])) {
            $post->tags()->attach($validatedData['tags']);
        }

        return redirect()
            ->route('showProfile', ['username' => Auth::user()->username])
            ->with('success', 'Blog post created successfully!');

    }


    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view("blogs.show", ['blog' => $post]);
    }
}
