<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{

    // public function configure()
    // {
    //     return $this->afterCreating(function(Comment $comment){
    //         Comment::factory()->count(25)->create([
    //             'comment_id' => $comment->id,
    //             'post_id' => $comment->post_id,
    //         ]) ;
    //     });
    // }

    public function definition(): array
    {

        $users = User::limit(100)->get();

        return [
            'text' => $this->faker->paragraph(),
            'user_id' => $this->faker->randomElement($users->map(fn($user) => $user->id)),
        ];
    }
}
