<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create predefined categories
        $categories = [
            'Technology',
            'Health',
            'Travel',
            'Education',
            'Lifestyle',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }

        // Optionally add random categories
        Category::factory(10)->create(); // Generates 10 random categories
    }
}
