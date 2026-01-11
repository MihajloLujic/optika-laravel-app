<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'category_id' => 1,
            'name' => 'Ray-Ban Classic',
            'slug' => 'ray-ban-classic',
            'description' => 'Klasične naočare za vid.',
            'price' => 12000,
            'stock' => 10,
        ]);

        Product::create([
            'category_id' => 2,
            'name' => 'Polaroid Sun',
            'slug' => 'polaroid-sun',
            'description' => 'Sunčane naočare sa UV zaštitom.',
            'price' => 9000,
            'stock' => 15,
        ]);

        Product::create([
            'category_id' => 3,
            'name' => 'Acuvue Oasys',
            'slug' => 'acuvue-oasys',
            'description' => 'Kontaktna sočiva za svakodnevnu upotrebu.',
            'price' => 3500,
            'stock' => 30,
        ]);
    }
}
