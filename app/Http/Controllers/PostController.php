<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->with('category', 'author')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'body' => ['required', 'string'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['exists:tags,id'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('post-images', 'public');
        }

        $validated['user_id'] = auth()->id() ?? 1;
        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(6);
        $validated['published_at'] = now();
        $validated['is_published'] = true;

        $validated['body'] = [
            ['type' => 'paragraph', 'data' => ['text' => $validated['body']]]
        ];

        $post = Post::create($validated);

        if (!empty($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        }

        return redirect()->route('posts.show', $post)->with('status', 'Туристичне місце успішно створено!');
    }

    public function show(Post $post)
    {
        $post->load('tags', 'comments');
        return view('posts.show', compact('post'));
    }
}

