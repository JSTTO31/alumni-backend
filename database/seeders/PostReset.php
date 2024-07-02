<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostReset extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::truncate();
        Comment::truncate();
        Reaction::truncate();

        User::where('id', 1)->update([
            'reactions_count' => 0,
            'posts_count' => 0,
            'comments_count' => 0,
            'shares_count' => 0,
        ]);
    }
}
