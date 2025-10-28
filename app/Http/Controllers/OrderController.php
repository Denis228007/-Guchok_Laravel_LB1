<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function store(Request $request)
    {
        $cartItems = \Cart::getContent();
        if ($cartItems->isEmpty()) {
            return redirect()->route('home')->with('error', 'Ваш кошик порожній.');
        }


        $order = DB::transaction(function () use ($cartItems) {

            $order = Order::create([

                'total' => \Cart::getTotal(),
                'status' => 'completed',
            ]);


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


        \Cart::clear();


        return redirect()->route('orders.show', $order)
            ->with('success', 'Дякуємо! Ваше замовлення успішно оформлено.');
    }


    public function show(Order $order)
    {

        $order->load('items.post');

        return view('orders.show', compact('order'));
    }
}
