<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
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

        foreach ($categories as $categoryName) {
            /** @var Category $category */
            $category = Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
            ]);

            // Create and associate tags with the category
            Tag::factory(5)->create()->each(function ($tag) use ($category) {
                $tag->update(['category_id' => $category->id]); // Update category_id for each tag
            });
        }
    }
}
