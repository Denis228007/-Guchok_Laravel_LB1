@props(['title', 'price', 'image', 'id'])

<div class="col-md-4 mb-4">
    <div class="card h-100 shadow-sm border-0 transition-hover">
        {{-- Клікабельна картинка --}}
        <a href="{{ route('products.show', $id) }}">
            <img src="{{ $image }}" class="card-img-top" alt="{{ $title }}" style="height: 250px; object-fit: cover;">
        </a>

        <div class="card-body d-flex flex-column p-4">
            {{-- Клікабельний заголовок --}}
            <h5 class="card-title fw-bold">
                <a href="{{ route('products.show', $id) }}" class="text-decoration-none text-dark">
                    {{ $title }}
                </a>
            </h5>

            <p class="card-text text-muted flex-grow-1">{{ Str::limit($slot, 80) }}</p>

            <h4 class="text-primary my-3 fw-bold">{{ $price }} ₴</h4>

            <div class="mt-auto d-grid gap-2">
                {{-- Кнопка купити --}}
                <form action="{{ route('cart.add', $id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success w-100 fw-bold">Купити</button>
                </form>

                {{-- Кнопка детальніше --}}
                <a href="{{ route('products.show', $id) }}" class="btn btn-outline-primary w-100">
                    Детальніше
                </a>
            </div>
        </div>
    </div>
</div>
