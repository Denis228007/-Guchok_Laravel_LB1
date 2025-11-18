@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Ваш Кошик</h1>

    {{-- Повідомлення про успішне додавання --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('cart') && count(session('cart')) > 0)
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Фото</th>
                            <th>Назва</th>
                            <th>Ціна</th>
                            <th>Кількість</th>
                            <th>Сума</th>
                            <th>Дії</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(session('cart') as $id => $details)
                            <tr>
                                <td style="width: 100px;">
                                    <img src="{{ $details['image'] }}" class="img-fluid rounded" alt="">
                                </td>
                                <td>{{ $details['name'] }}</td>
                                <td>{{ $details['price'] }} ₴</td>
                                <td>
                                    <span class="badge bg-secondary">{{ $details['quantity'] }}</span>
                                </td>
                                <td class="fw-bold">{{ $details['price'] * $details['quantity'] }} ₴</td>
                                <td>
                                    <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger btn-sm">
                                        Видалити
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white d-flex justify-content-between align-items-center py-3">
                <h3 class="mb-0">Разом: <span class="text-success">{{ $total }} ₴</span></h3>
                <div>
                    <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-outline-danger me-2">Очистити кошик</button>
                    </form>
                    <form action="{{ route('orders.store') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-lg shadow">Оформити замовлення</button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info text-center py-5">
            <h3>Кошик порожній 🛒</h3>
            <p>Оберіть цікаву подорож у нашому каталозі!</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Перейти до турів</a>
        </div>
    @endif
</div>
@endsection
