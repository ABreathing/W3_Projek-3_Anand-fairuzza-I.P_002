<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Workshop', 'slug' => 'workshop']);
        Category::create(['name' => 'Seminar', 'slug' => 'seminar']);
    }
}