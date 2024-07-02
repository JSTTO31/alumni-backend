<?php

namespace App\Observers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CommentObserver
{
    public function created(Comment $comment): void
    {
        User::whereHas('posts', fn($query) => $query->where('id', $comment->post_id))->increment('comments_count', 1);
        Post::where('id', $comment->post_id)->increment('comments_count', 1);

        if($comment->comment_id){
            Comment::where('id', $comment->comment_id)->increment('replies_count', 1);
        }
    }

    public function deleted(Comment $comment): void
    {
        $comment->replies()->delete();
        $comment->reactions()->delete();
        $comment->hide()->delete();
        $comment->report()->delete();

        $reactions_count = $comment->reactions_count;
        $replies_count = $comment->replies_count;

        User::whereHas('posts', fn($query) => $query->where('id', $comment->post_id))->update([
            'comments_count' => DB::raw('comments_count - ' . ($replies_count - 1)),
            'reactions_count' => DB::raw('reactions_count - ' . $reactions_count),
        ]);

        Post::where('id', $comment->post_id)->update([
            'comments_count' => DB::raw('comments_count - ' . ($replies_count - 1)),
            'reactions_count' => DB::raw('reactions_count - ' . $reactions_count),
        ]);


        if($comment->comment_id){
            Comment::where('id', $comment->comment_id)->update([
                'replies_count' => DB::raw('replies_count - 1'),
                'reactions_count' => DB::raw('reactions_count - ' . $reactions_count)
            ]);
        }
    }
}
