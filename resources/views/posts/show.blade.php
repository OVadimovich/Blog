@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="font-semibold text-lg">{{ $post->title }}</h2>
            <p class="text-gray-600 text-sm">Author: {{ $post->user->name }}</p>
            <p class="text-gray-500 text-xs">Date: {{ $post->created_at->format('d.m.Y H:i') }}</p>
            <p class="text-gray-500 text-xs">Categories:</p>
            @foreach ($post->categories as $category)
                <p class="text-gray-500 text-xs">{{ $category->title }}</p>
            @endforeach
            <div class="mt-2">
                <p>{{ Str::limit($post->body) }}</p>
            </div>
            @can('edit', $post)
                <a href="{{ route('posts.edit', $post->id) }}"
                   class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">
                    Edit Post
                </a>
            @endcan
            @can('delete', $post)
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this post?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Delete Post
                    </button>
                </form>
            @endcan
        </div>
        <div class="bg-white shadow-md rounded-lg p-4 mb-4 mt-6">
            <form action="{{ route('posts.comments.store', $post) }}" method="POST">
                @csrf
                <h2 class="font-semibold text-lg">Add comments</h2>
                @if(Auth::check())
                    <div class="form-group">
                        <div class="form-group">
                            <textarea id="comment-body" name="body" rows="4"
                                      class="mt-1 block w-full p-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Enter your comment"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add Comment
                    </button>
                @else
                    <p class="text-gray-600 text-sm">Need to log ing for leaving comments</p>
                @endif
            </form>
        </div>
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="font-semibold text-lg">Comments</h2>
            @foreach ($comments as $comment)
                <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                    <p class="text-gray-600 text-sm">{{ $comment->user->name }}</p>
                    <p class="text-gray-600 text-sm">Comment: {{ $comment->body }}</p>
                    <p class="text-gray-600 text-sm">{{ $comment->created_at }}</p>
                    @can('delete', $comment)
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Delete
                            </button>
                        </form>
                    @endcan
                </div>
            @endforeach
            <div class="mt-4">
                {{ $comments->links() }}
            </div>
        </div>
    </div>
    <hr>
@endsection
