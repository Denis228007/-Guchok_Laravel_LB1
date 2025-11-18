<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::latest()->paginate(6);
        return view('products.index', compact('products'));
    }


    public function create()
    {
        return view('products.create');
    }
public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);


        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => '/images/' . $imageName,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Тур успішно додано!');
    }
}
