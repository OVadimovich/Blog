<?php

namespace App\Service;

use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

class PostService
{
    public function search(?string $search): array|LengthAwarePaginator
    {
        if ($search) {
            $result = Post::where('title', 'like', '%'.$search.'%')
                ->orWhere('body', 'like', '%'.$search.'%')
                ->paginate(12);
        } else {
            $result = Post::orderBy('created_at', 'desc')->paginate(12);
        }

        return $result;
    }
}
