@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Історія моїх подорожей</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @foreach($orders as $order)
        <div class="card mb-4 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center bg-light">
                <div>
                    <strong>Замовлення #{{ $order->id }}</strong>
                    <span class="text-muted ms-2">{{ $order->created_at->format('d.m.Y H:i') }}</span>
                </div>
                <div>
                    Статус:
                    <span class="badge rounded-pill bg-{{ $order->status == 'new' ? 'warning text-dark' : 'success' }}">
                        {{ $order->status == 'new' ? 'Очікує оплати' : 'Оплачено' }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush mb-3">
                    @foreach($order->items as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $item->product_name }} (x{{ $item->quantity }})
                            <span>{{ $item->price * $item->quantity }} ₴</span>
                        </li>
                    @endforeach
                </ul>
                <h4 class="text-end text-primary">До сплати: {{ $order->total_price }} ₴</h4>
            </div>
        </div>
    @endforeach
</div>
@endsection
