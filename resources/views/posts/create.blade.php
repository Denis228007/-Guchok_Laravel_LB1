@extends('layouts.app')

@section('title', 'Створити нове місце')

@section('content')
    <div class="bg-white p-4 p-md-5 rounded shadow-sm">
        <h1 class="display-6 fw-bold mb-4">Додавання нового туристичного місця</h1>

        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Заголовок</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Ціна (грн)</label>
                <input type="number" name="price" id="price" step="0.01" min="0" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">Зображення обкладинки</label>
                <input type="file" name="cover_image" id="cover_image" class="form-control">
            </div>

            <div class="mb-3">
                <label for="excerpt" class="form-label">Короткий опис</label>
                <textarea name="excerpt" id="excerpt" rows="3" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label for="body" class="form-label">Повний опис (один блок)</label>
                <textarea name="body" id="body" rows="10" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Категорія</label>
                <select name="category_id" id="category_id" class="form-select">
                    <option value="">— Оберіть категорію —</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="tags" class="form-label">Теги (можна обрати декілька, затиснувши Ctrl/Cmd)</label>
                <select name="tags[]" id="tags" multiple class="form-select" style="height: 150px;">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-lg">
                Зберегти
            </button>
        </form>
    </div>
@endsection

