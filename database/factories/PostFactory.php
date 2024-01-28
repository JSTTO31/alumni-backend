<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use Closure;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{

    public function configure()
    {
        return $this->afterCreating(function(Post $post){
            Comment::factory()->count(25)->create([
                'post_id' => $post->id
            ]);
        });
    }


    public function definition(): array
    {
        return [
            'text' => $this->faker->paragraph(),
            'privacy' => $this->faker->randomElement(['public', 'private', 'connected']),
        ];
    }
}
