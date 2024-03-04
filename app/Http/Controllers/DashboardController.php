<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::where(
            [
                'user_id' => Auth::id()
            ]
        )
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('dashboard', ['posts' => $posts]);
    }
}
