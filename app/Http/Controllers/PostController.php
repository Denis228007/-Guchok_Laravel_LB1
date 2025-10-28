<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; // 1. Додаємо імпорт Storage

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->with('category', 'author')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'cover_image' => ['nullable', 'image', 'max:2048'], // max 2MB
            'excerpt' => ['nullable', 'string'],
            'body' => ['required', 'string'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['exists:tags,id'],
            // 👇 ОСЬ ВИРІШЕННЯ ВАШОЇ ПРОБЛЕМИ 👇
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        // Handle the file upload
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('post-images', 'public');
        }

        $validated['user_id'] = auth()->id() ?? 1;
        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(6);
        $validated['published_at'] = now(); // Automatically set publish date

        // Convert the body text into our block structure
        $validated['body'] = [
            ['type' => 'paragraph', 'data' => ['text' => $validated['body']]]
        ];

        $post = Post::create($validated);

        if (!empty($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        }

        return redirect()->route('posts.show', $post)->with('status', 'Туристичне місце успішно створено!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load('tags', 'comments');
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Logic for editing will be here
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Logic for updating will be here
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post) // 2. Реалізуємо метод
    {
        // Спочатку видаляємо зображення, якщо воно є
        if ($post->cover_image) {
            Storage::disk('public')->delete($post->cover_image);
        }

        // Потім видаляємо сам пост
        $post->delete();

        // Повертаємо користувача на головну сторінку з повідомленням
        return redirect()->route('home')->with('success', 'Туристичне місце успішно видалено!');
    }
}

