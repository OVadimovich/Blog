<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Service\CategoryService;

class CategoryController extends Controller
{
    public function __construct(private readonly CategoryService $categoryService)
    {}

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $this->categoryService->saveCategory($request->title);

        return redirect()->route('posts.create')->with('success', 'Category created successfully.');
    }
}
