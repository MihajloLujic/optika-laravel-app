<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Naocare za vid', 'slug' => 'naocare-za-vid']);
        Category::create(['name' => 'Suncane naocare', 'slug' => 'suncane-naocare']);
        Category::create(['name' => 'Kontaktna sociva', 'slug' => 'kontaktna-sociva']);
    }
}
