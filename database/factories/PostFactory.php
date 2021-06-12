<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->sentence();
        $slug = Str::slug($title, '-');

        return [
            'user_id' => $this->faker->numberBetween(1, 50),
            'title' => $title,
            'slug' => $slug,
            'description' => $this->faker->paragraph(),
            'body' => $this->faker->text(),
        ];
    }
}
