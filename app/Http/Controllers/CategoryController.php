<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display posts for a specific category.
     */
    public function show(Category $category)
    {
        $posts = $category->posts()
            ->with(['user', 'category'])
            ->published()
            ->latest('published_at')
            ->paginate(10);

        return view('categories.show', compact('category', 'posts'));
    }
}

