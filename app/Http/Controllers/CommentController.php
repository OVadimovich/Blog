<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Service\CommentService;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function __construct(private readonly CommentService $commentService)
    {}

    public function store(CommentRequest $request): RedirectResponse
    {
        $body = $request->get('body');
        $postId = $request->get('post_id');

        $this->commentService->addComment($body, $postId);

        return redirect()->route('posts.show', $postId)->with('success', 'Comment added successfully!');
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('success', 'Deleted successfully.');
    }
}
