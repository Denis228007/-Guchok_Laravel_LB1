@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="bg-white p-4 p-md-5 rounded shadow-sm">
        @if($post->cover_image)
            <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="img-fluid rounded mb-4" style="max-height: 400px; width: 100%; object-fit: cover;">
        @endif

        <h1 class="mb-3 display-5 fw-bold">{{ $post->title }}</h1>

        <div class="mb-4 text-muted">
            <span>Категорія: {{ optional($post->category)->name ?? 'Без категорії' }}</span>
            <span class="mx-2">•</span>
            <span>Автор: {{ $post->author->name }}</span>
            <span class="mx-2">•</span>
            <span>Опубліковано: {{ $post->published_at->format('d.m.Y') }}</span>
        </div>

        {{-- 👇 Я об'єднав кнопки в один блок d-flex для кращого вигляду 👇 --}}
        <div class="mb-4 d-flex align-items-center gap-2">
            {{-- Кнопка "Купити" --}}
            <form action="{{ route('cart.add', $post) }}" method="POST" class="mb-0">
                @csrf
                <button type="submit" class="btn btn-success btn-lg">
                    Купити квиток ({{ (int)$post->price }} грн)
                </button>
            </form>

            {{-- 👇 НОВА КНОПКА "ВИДАЛИТИ" 👇 --}}
            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="mb-0">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-lg">
                    Видалити
                </button>
            </form>
        </div>
        <hr class="my-4">

        <div class="lead">
            @foreach ($post->body as $block)
                @if ($block['type'] === 'paragraph')
                    <p>{{ $block['data']['text'] }}</p>
                @endif
                {{-- У майбутньому сюди можна додати @elseif для інших типів блоків (header, image, etc.) --}}
            @endforeach
        </div>

        @if($post->tags->isNotEmpty())
            <div class="mt-4">
                <p class="small">Теги:
                    @foreach($post->tags as $tag)
                        <span class="badge bg-secondary ms-1">#{{ $tag->name }}</span>
                    @endforeach
                </p>
            </div>
        @endif
    </div>
@endsection

