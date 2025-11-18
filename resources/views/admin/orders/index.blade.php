@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Панель керування замовленнями</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Клієнт</th>
                        <th>Дата</th>
                        <th>Сума</th>
                        <th>Статус</th>
                        <th>Дії</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>
                            <strong>{{ $order->user->name }}</strong><br>
                            <small class="text-muted">{{ $order->user->email }}</small>
                        </td>
                        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        <td>{{ $order->total_price }} ₴</td>
                        <td>
                            @if($order->status == 'new')
                                <span class="badge bg-warning text-dark">Очікує оплати</span>
                            @else
                                <span class="badge bg-success">Оплачено ✅</span>
                            @endif
                        </td>
                        <td>
                            @if($order->status == 'new')
                                <form action="{{ route('admin.orders.confirm', $order->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Підтвердити оплату</button>
                                </form>
                            @else
                                <button class="btn btn-secondary btn-sm" disabled>Виконано</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
