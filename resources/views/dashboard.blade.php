<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <a href="{{ route('posts.create') }}">
                {{ __('Add New Post') }}
            </a>
        </button>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    @section('content')
        <div class="container mx-auto px-4">
            <h1 class="text-xl font-bold mb-4">My Blog Posts</h1>
            <div class="flex flex-col gap-4">
                @forelse ($posts as $post)
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <h2 class="font-semibold text-lg">{{ $post->title }}</h2>
                        <p class="text-gray-600 text-sm">Author: {{ $post->user->name }}</p>
                        <p class="text-gray-500 text-xs">Date: {{ $post->created_at->format('d.m.Y H:i') }}</p>
                        @foreach ($post->categories as $category)
                            <p class="text-gray-500 text-xs">{{ $category->title }}</p>
                        @endforeach
                        <div class="mt-2">
                            <p>{{ Str::limit($post->body) }}</p>
                        </div>
                        <a href="{{ route('posts.show', $post->id) }}" class="inline-block mt-4 bg-blue-500 text-white rounded px-4 py-2">View More</a>
                    </div>
                @empty
                    <p>No posts</p>
                @endforelse
            </div>
        </div>
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    @endsection
</x-app-layout>
