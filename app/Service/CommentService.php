<?php

namespace App\Service;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function addComment(string $body, string $postId): void
    {
        Comment::create([
            'body' => $body,
            'post_id' => $postId,
            'user_id' => Auth::id()
        ]);
    }
}
