<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = \Cart::getContent();
        return view('cart.index', compact('cartItems'));
    }

    public function add(Post $post)
    {
        \Cart::add([
            'id' => $post->id,
            'name' => $post->title,
            'price' => $post->price,
            'quantity' => 1,
            'attributes' => [
                'image' => $post->cover_image,
                'slug' => $post->slug
            ]
        ]);

        return redirect()->route('cart.index')->with('success', 'Квиток успішно додано до кошика!');
    }

    public function remove($itemId)
    {
        \Cart::remove($itemId);
        return redirect()->route('cart.index')->with('success', 'Квиток видалено з кошика.');
    }

    public function update(Request $request, $itemId)
    {
        \Cart::update($itemId, [
            'quantity' => [
                'relative' => false,
                'value' => $request->quantity
            ],
        ]);

        return redirect()->route('cart.index')->with('success', 'Кількість квитків оновлено.');
    }
}

