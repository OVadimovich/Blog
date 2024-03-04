<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $category = new Category();
        $category->title = $request->title;
        $category->save();

        return redirect()->route('posts.create')->with('success', 'Category created successfully.');
    }
}
