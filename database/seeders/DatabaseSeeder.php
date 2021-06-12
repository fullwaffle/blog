<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->count(50)->create();
        \App\Models\Post::factory()->count(50)->create();
        \App\Models\Comment::factory()->count(50)->create();
        \App\Models\Category::factory()->count(5)->create();
    }
}
