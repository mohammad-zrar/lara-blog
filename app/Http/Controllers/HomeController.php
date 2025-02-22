<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve the category parameter from the query string
        $categoryName = $request->query('category');

        // Filter blogs based on the category name parameter
        $query = Post::query();

        if ($categoryName) {
            $query->whereHas('category', function ($q) use ($categoryName) {
                $q->where('name', $categoryName);
            });
        }

        // Paginate the filtered blogs
        $blogs = $query->paginate(10);

        return view('home', compact('blogs'));
    }
}
