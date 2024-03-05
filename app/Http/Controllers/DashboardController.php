<?php

namespace App\Http\Controllers;

use App\Service\PostService;

class DashboardController extends Controller
{
    public function __construct(private readonly PostService $postService)
    {}

    public function index()
    {
        $posts = $this->postService->searchByUser();

        return view('dashboard', ['posts' => $posts]);
    }
}
