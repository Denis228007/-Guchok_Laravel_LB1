@extends('layouts.app')

@section('title', 'Створити нове місце')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Додавання нового туристичного місця</h1>

    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-lg shadow-md">
        @csrf
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Заголовок</label>
            <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>

        <div>
            <label for="cover_image" class="block text-sm font-medium text-gray-700">Зображення обкладинки</label>
            <input type="file" name="cover_image" id="cover_image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        </div>

        <div>
            <label for="excerpt" class="block text-sm font-medium text-gray-700">Короткий опис</label>
            <textarea name="excerpt" id="excerpt" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
        </div>

        <div>
            <label for="body" class="block text-sm font-medium text-gray-700">Повний опис (один блок)</label>
            <textarea name="body" id="body" rows="10" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required></textarea>
        </div>

        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700">Категорія</label>
            <select name="category_id" id="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="">— Оберіть категорію —</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="tags" class="block text-sm font-medium text-gray-700">Теги (можна обрати декілька, затиснувши Ctrl/Cmd)</label>
            <select name="tags[]" id="tags" multiple class="mt-1 block w-full rounded-md border-gray-300 shadow-sm h-32">
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Зберегти
        </button>
    </form>
@endsection

