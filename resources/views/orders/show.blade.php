@extends('layouts.app')

@section('title', 'Квитанція про замовлення №' . $order->id)

@section('content')
    <div class="bg-white p-4 p-md-5 rounded shadow-sm">
        <h1 class="text-2xl font-bold mb-2">Квитанція №{{ $order->id }}</h1>
        <p class="text-muted mb-4">Дата замовлення: {{ $order->created_at->format('d.m.Y H:i') }}</p>

        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded my-6">
            <table class="min-w-full leading-normal table">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Подорож</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Ціна</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Кількість</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Всього</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{-- $item->post->title може не існувати, якщо пост видалили, тому $item->name --}}
                                <p class="text-gray-900 whitespace-no-wrap">{{ $item->name }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $item->price }} грн</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                 <p class="text-gray-900 whitespace-no-wrap">{{ $item->quantity }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $item->price * $item->quantity }} грн</p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-right p-4 border-t-2 border-gray-200">
                <h3 class="text-lg font-semibold">Загальна сума: {{ $order->total }} грн</h3>
            </div>

            {{-- Сюди ми додамо кнопку завантаження PDF --}}
            <div class="text-center mt-4">
                 <a href="#" class="btn btn-primary" onclick="window.print(); return false;">
                    Роздрукувати / Зберегти як PDF
                </a>
            </div>
        </div>
    </div>
@endsection

