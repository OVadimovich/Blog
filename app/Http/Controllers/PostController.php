<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\PostSearchRequest;
use App\Models\Category;
use App\Models\Post;
use App\Service\PostService;

class PostController extends Controller
{

    public function __construct(private readonly PostService $postService)
    {}

    public function index(PostSearchRequest $request)
    {
        $search = $request->query('search');
        $posts = $this->postService->search($search);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create', ['categories' => Category::all()]);
    }

    public function store(PostRequest $request)
    {
        $this->postService->createPost($request->only(['title', 'body']), $request->category_ids);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        $comments = $post->comments()->orderBy('created_at', 'desc')->paginate(7);

        return view('posts.show',
            [
                'post' => $post,
                'comments' => $comments
            ]
        );
    }

    public function edit(Post $post)
    {
        $this->authorize('edit', $post);

        $comments = $post->comments()->orderBy('created_at', 'desc')->get();
        $categories = Category::all();

        return view('posts.edit',
            [
                'post' => $post,
                'comments' => $comments,
                'categories' => $categories
            ]
        );
    }

    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $this->postService->updatePost($post->id, $request->title, $request->body, $request->category_ids);

        return redirect()->route('posts.show', $post->id)->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
