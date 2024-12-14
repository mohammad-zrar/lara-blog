<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    public function getTagsByCategory($categoryId)
    {
        $tags = Tag::where('category_id', $categoryId)->get();

        return response()->json($tags);
    }
}
