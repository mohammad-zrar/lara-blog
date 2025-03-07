<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\SavedPost;
use App\Models\Tag; // Import the Tag model
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

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Check if the authenticated user is the owner of the post
        if (auth()->id() !== $post->user_id) {
            return redirect('/')->with('error', 'You are not authorized to update this post.');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s\-_]+$/',
            'content' => 'required|string',
            'category' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ], [
            'title.regex' => 'The title may only contain letters, numbers, spaces, dashes, and underscores.'
        ]);

        // Update the post
        $post->update([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'category_id' => $validatedData['category'] ?? null,
        ]);

        // Sync tags
        if (!empty($validatedData['tags'])) {
            $post->tags()->sync($validatedData['tags']);
        } else {
            $post->tags()->detach();
        }

        return redirect()
            ->route('showBlog', ['slug' => $post->slug])
            ->with('success', 'Blog post updated successfully!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Check if the authenticated user is the owner of the post
        if (auth()->id() !== $post->user_id) {
            return redirect('/')->with('error', 'You are not authorized to delete this post.');
        }

        $post->delete();

        return redirect('/')
            ->with('success', 'Blog post deleted successfully!');
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if (!$post) {
            abort(404);
        }
        $isSaved = false;

        if (auth()->check()) {
            $isSaved = SavedPost::where('user_id', auth()->id())->where('post_id', $post->id)->exists();
        }


        return view("blogs.show", ['blog' => $post, 'isSaved' => $isSaved]);
    }

    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if (!$post) {
            abort(404);
        }

        if (auth()->id() !== $post->user_id) {
            return redirect('/')->with('error', 'You are not authorized to edit this post.');
        }

        $categories = Category::all(); // Fetch categories
        $tags = Tag::all(); // Fetch tags

        return view("blogs.edit", ['blog' => $post, 'categories' => $categories, 'tags' => $tags]);
    }
}
