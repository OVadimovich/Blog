<?php

namespace App\Service;

use App\Models\Post;
use Auth;
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

    public function searchByUser(): array|LengthAwarePaginator
    {
        return Post::where(
            [
                'user_id' => Auth::id()
            ]
        )
            ->orderBy('created_at', 'desc')
            ->paginate(12);
    }

    public function createPost(array $params, array $categoryIds): void
    {
        $post = new Post($params);
        $post->user_id = auth()->id();
        $post->save();

        $post->categories()->sync($categoryIds);
    }

    public function updatePost(int $id, string $title, string $body, array $categoryIds): void
    {
        $post = Post::find($id);

        $post->update([
            'title' => $title,
            'body' => $body,
        ]);

        if ($categoryIds) {
            $post->categories()->sync($categoryIds);
        }
    }
}
