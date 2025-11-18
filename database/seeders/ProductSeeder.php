<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Тур в Карпати',
                'description' => 'Незабутні вихідні в горах. Включено трансфер та проживання.',
                'price' => 3500.00,
                'image' => 'https://placehold.co/600x400/orange/white?text=Karpaty',
            ],
            [
                'name' => 'Екскурсія Львовом',
                'description' => 'Прогулянка старим містом, кава та цікаві історії.',
                'price' => 500.00,
                'image' => 'https://placehold.co/600x400/brown/white?text=Lviv',
            ],
            [
                'name' => 'Вікенд в Одесі',
                'description' => 'Море, гумор та смачна їжа.',
                'price' => 2800.00,
                'image' => 'https://placehold.co/600x400/blue/white?text=Odesa',
            ]
        ]);
    }
}
