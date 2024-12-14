<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create();
        Tag::factory(20)->create();

        $this->call([
            CategorySeeder::class, // Call the category seeder
        ]);

    }
}
