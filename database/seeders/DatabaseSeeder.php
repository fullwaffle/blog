<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        \App\Models\Comment::factory()->count(100)->create();
        \App\Models\Category::factory()->count(5)->create();

        for ($i=0; $i < 50; $i++) {
            DB::table('category_post')->insert([
               'post_id' => random_int(1, 50),
               'category_id' => random_int(1, 5),
            ]);
        }
    }
}
