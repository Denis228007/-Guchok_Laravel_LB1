@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Головна</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
        <div class="row g-0">
            {{-- Ліва частина: Велике фото --}}
            <div class="col-md-6">
                <div style="height: 500px; overflow: hidden;">
                    <img src="{{ $product->image }}" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="{{ $product->name }}">
                </div>
            </div>

            {{-- Права частина: Інформація --}}
            <div class="col-md-6 d-flex flex-column bg-white p-5">
                <h1 class="fw-bold text-dark mb-3">{{ $product->name }}</h1>

                <div class="mb-4">
                    <span class="badge bg-success fs-5 px-3 py-2">Ціна: {{ $product->price }} ₴</span>
                </div>

                <h4 class="text-muted mb-3">Про подорож:</h4>
                <p class="lead flex-grow-1 text-secondary" style="line-height: 1.8;">
                    {{ $product->description }}
                </p>

                <hr class="my-4">

                <div class="d-grid gap-2">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-primary btn-lg w-100 shadow-sm py-3 fw-bold text-uppercase">
                            🛒 Додати в кошик за {{ $product->price }} ₴
                        </button>
                    </form>

                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary mt-2">
                        ← Повернутись до каталогу
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
