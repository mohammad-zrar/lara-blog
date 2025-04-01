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
        // Create predefined categories with their related tags
        $categoriesWithTags = [
            'Technology' => ['Programming', 'AI', 'Web Development', 'Cybersecurity', 'Cloud Computing'],
            'Health' => ['Fitness', 'Nutrition', 'Mental Health', 'Wellness', 'Medical Research'],
            'Travel' => ['Adventure', 'Budget Travel', 'Luxury Travel', 'Destinations', 'Travel Tips'],
            'Education' => ['Online Learning', 'Higher Education', 'K-12', 'Teaching Methods', 'Educational Technology'],
            'Lifestyle' => ['Fashion', 'Home Decor', 'Self-Improvement', 'Food', 'Relationships'],
        ];

        foreach ($categoriesWithTags as $categoryName => $tags) {
            /** @var Category $category */
            $category = Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
            ]);

            // Create meaningful tags for the category
            foreach ($tags as $tagName) {
                Tag::create([
                    'name' => $tagName,
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}
