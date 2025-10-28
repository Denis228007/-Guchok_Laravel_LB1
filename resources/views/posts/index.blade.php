@extends('layouts.app')

@section('title', 'Список туристичних місць')

@section('content')
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($posts as $post)
            <div class="col">
                <div class="card h-100 shadow-sm d-flex flex-column">
                    <a href="{{ route('posts.show', $post) }}">
                        @if($post->cover_image)
                            <img src="{{ asset('storage/' . $post->cover_image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center card-img-top bg-secondary text-white" style="height: 200px;">
                                <span>Немає фото</span>
                            </div>
                        @endif
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <a href="{{ route('posts.show', $post) }}" class="text-dark text-decoration-none">{{ $post->title }}</a>
                        </h5>
                        <p class="card-text text-muted small">
                            {{ optional($post->category)->name ?? 'Без категорії' }} • {{ $post->author->name }}
                        </p>
                        <p class="card-text flex-grow-1">{{ $post->excerpt }}</p>
                        <div class="mt-auto">
                            <form action="{{ route('cart.add', $post) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success w-100">
                                    Купити квиток ({{ (int)$post->price }} грн)
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-muted">Ще немає жодного туристичного місця.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
@endsection
