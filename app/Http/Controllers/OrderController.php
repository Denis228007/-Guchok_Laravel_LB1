<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function store()
    {
        $cart = session()->get('cart');

        if(!$cart) {
            return redirect()->back()->with('error', 'Кошик порожній!');
        }


        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }


        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'new',
        ]);


        foreach($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'product_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }


        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Дякуємо! Ваше замовлення прийнято.');
    }


    public function index()
    {

        $orders = Order::where('user_id', Auth::id())
                       ->with('items')
                       ->latest()
                       ->get();

        return view('orders.index', compact('orders'));
    }
public function adminIndex()
    {

        $orders = Order::with('user')->latest()->get();

        return view('admin.orders.index', compact('orders'));
    }


    public function confirmPayment($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'paid']);

        return redirect()->back()->with('success', 'Статус замовлення оновлено!');
    }
}
