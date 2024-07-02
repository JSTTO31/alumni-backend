<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        User::where('id', $post->user_id)->increment('posts_count', 1);
    }


    public function deleted(Post $post): void
    {
        User::where('id', $post->user_id)->update([
            'post_counts' => DB::raw('post_counts - 1'),
            'comments_counts' => DB::raw('comments_count - ' . $post->comments_count),
            'reactions_count' => DB::raw('reactions_count - ' . $post->reactions_count),
        ]);


        $post->comments()->delete();
        $post->reactions()->delete();
        $post->hide()->delete();
        $post->report()->delete();


    }

}
