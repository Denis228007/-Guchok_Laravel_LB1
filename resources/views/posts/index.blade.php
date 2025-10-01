@extends('layouts.app')

@section('title', 'Список туристичних місць')

@section('content')
    <div class="mb-4">
        <a href="{{ route('posts.create') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Додати нове місце
        </a>
    </div>

    <div class="space-y-6">
        @forelse($posts as $post)
            <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md">
                <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                </h2>
                <div class="mb-4 text-sm text-gray-500">
                    <span>Категорія: {{ optional($post->category)->name ?? 'Без категорії' }}</span>
                    <span class="mx-2">•</span>
                    <span>Автор: {{ $post->author->name }}</span>
                </div>
                <p class="mb-5 font-light text-gray-500">{{ $post->excerpt }}</p>
                <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center font-medium text-blue-600 hover:underline">
                    Читати далі →
                </a>
            </article>
        @empty
            <p>Ще немає жодного туристичного місця.</p>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $posts->links() }}
    </div>
@endsection

