@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-xl font-bold mb-4">Create new post</h1>
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('title') }}" required autofocus>
                @error('title')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Category:</label>
                <select name="category_ids[]" id="category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" multiple required autofocus>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
                @error('category_id')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <a href="{{ route('categories.create') }}" id="save-and-redirect" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Create New Category
            </a>
            <div class="mb-4">
                <label for="body" class="block text-gray-700 text-sm font-bold mb-2">Body:</label>
                <textarea name="body" id="body" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ old('body') }}</textarea>
                @error('body')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">Create</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const titleInput = document.getElementById('title');
            const bodyTextarea = document.getElementById('body');
            const saveAndRedirect = document.getElementById('save-and-redirect');

            const savedData = localStorage.getItem('postFormData');
            if (savedData) {
                const postData = JSON.parse(savedData);
                titleInput.value = postData.title;
                bodyTextarea.value = postData.body;
                localStorage.removeItem('postFormData');
            }

            saveAndRedirect.addEventListener('click', function(e) {
                e.preventDefault();
                const postData = {
                    title: titleInput.value,
                    body: bodyTextarea.value,
                };

                localStorage.setItem('postFormData', JSON.stringify(postData));
                window.location.href = saveAndRedirect.href;
            });
        });
    </script>
@endsection
