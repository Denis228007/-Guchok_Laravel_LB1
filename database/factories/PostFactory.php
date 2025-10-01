<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(4);
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'excerpt' => fake()->paragraph(),
            'body' => [
                [
                    'type' => 'paragraph',
                    'data' => [
                        'text' => fake()->paragraphs(3, true),
                    ],
                ],
                [
                    'type' => 'paragraph',
                    'data' => [
                        'text' => fake()->paragraphs(2, true),
                    ],
                ],
            ],
            'published_at' => now(),
            'is_published' => true,
        ];
    }
}

