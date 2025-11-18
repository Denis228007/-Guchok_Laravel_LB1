@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-5 fw-bold">Туристичний Довідник: Покупка квитків</h1>

    <div class="row">
        @foreach($products as $product)
            {{-- Використовуємо наш компонент --}}
            <x-product-card
                :title="$product->name"
                :price="$product->price"
                :image="$product->image"
                :id="$product->id"
            >
                {{ $product->description }}
            </x-product-card>
        @endforeach
    </div>
<div class="mt-5 d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection
