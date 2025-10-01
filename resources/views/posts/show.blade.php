@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md">
        @if($post->cover_image)
            <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="mb-6 w-full h-auto rounded-lg object-cover" style="max-height: 400px;">
        @endif

        <h1 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900">{{ $post->title }}</h1>

        <div class="mb-6 text-sm text-gray-500">
            <span>Категорія: {{ optional($post->category)->name ?? 'Без категорії' }}</span>
            <span class="mx-2">•</span>
            <span>Автор: {{ $post->author->name }}</span>
            <span class="mx-2">•</span>
            <span>Опубліковано: {{ $post->published_at->format('d.m.Y') }}</span>
        </div>

        <div class="prose max-w-none">
            @foreach ($post->body as $block)
                @if ($block['type'] === 'paragraph')
                    <p>{{ $block['data']['text'] }}</p>
                @endif
            @endforeach
        </div>

        @if($post->tags->isNotEmpty())
            <div class="mt-6">
                <p class="text-sm font-semibold">Теги:
                    @foreach($post->tags as $tag)
                        <span class="ml-2 inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#{{ $tag->name }}</span>
                    @endforeach
                </p>
            </div>
        @endif
    </article>
@endsection

