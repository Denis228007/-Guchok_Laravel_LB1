<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Логіка оформлення замовлення.
     * Створює Order та OrderItems з кошика.
     */
    public function store(Request $request)
    {
        $cartItems = \Cart::getContent();
        if ($cartItems->isEmpty()) {
            return redirect()->route('home')->with('error', 'Ваш кошик порожній.');
        }

        // Використовуємо транзакцію, щоб гарантувати цілісність даних
        $order = DB::transaction(function () use ($cartItems) {
            // 1. Створюємо саме замовлення
            $order = Order::create([
                // 'user_id' => auth()->id(), // TODO: Додати, коли буде автентифікація
                'total' => \Cart::getTotal(),
                'status' => 'completed', // Або 'pending', якщо потрібна оплата
            ]);

            // 2. Створюємо елементи замовлення
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'post_id' => $item->id,
                    'name' => $item->name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
            }

            return $order;
        });

        // 3. Очищуємо кошик
        \Cart::clear();

        // 4. Перенаправляємо на сторінку "Квитанція"
        return redirect()->route('orders.show', $order)
            ->with('success', 'Дякуємо! Ваше замовлення успішно оформлено.');
    }

    /**
     * Показ сторінки "Квитанція" (деталі замовлення).
     */
    public function show(Order $order)
    {
        // TODO: Додати перевірку, що юзер може бачити це замовлення
        // if ($order->user_id !== auth()->id()) {
        //     abort(403);
        // }

        // Завантажуємо елементи разом із замовленням
        $order->load('items.post');

        return view('orders.show', compact('order'));
    }
}
