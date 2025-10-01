<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $categories = collect(['Новини', 'Статті', 'Огляди'])->map(function ($name) {
            return Category::create(['name' => $name, 'slug' => Str::slug($name)]);
        });

        $tags = collect(['Laravel', 'PHP', 'MySQL', 'Docker', 'Vue'])->map(function ($name) {
            return Tag::create(['name' => $name, 'slug' => Str::slug($name)]);
        });

        $user = User::factory()->create(['name' => 'Admin', 'email' => 'admin@example.com']);

        Post::factory(15)->create([
            'user_id' => $user->id,
            'category_id' => $categories->random()->id,
        ])->each(function (Post $post) use ($tags) {
            $post->tags()->attach($tags->random(rand(1, 3))->pluck('id'));
        });
    }
}
