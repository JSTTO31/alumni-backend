<?php

namespace App\Observers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\User;

class ReactionObserver
{
    /**
     * Handle the Reaction "created" event.
     */
    public function created(Reaction $reaction): void
    {
        switch($reaction->reactionable_type){
            case Post::class :
                Post::where('id', $reaction->reactionable_id)->increment('reactions_count', 1);
                User::whereHas('posts', fn($query) => $query->where('id', $reaction->reactionable_id))->increment('reactions_count', 1);
                break;
            case Comment::class :
                Comment::where('id', $reaction->reactionable_id)->increment('reactions_count', 1);
                User::whereHas('comments', fn($query) => $query->where('user_id', $reaction->reactionable_id))->increment('reactions_count', 1);
        }
    }


    public function deleted(Reaction $reaction): void
    {
        switch($reaction->reactionable_type){
            case Post::class :
                Post::where('id', $reaction->reactionable_id)->decrement('reactions_count', 1);
                User::whereHas('posts', fn($query) => $query->where('id', $reaction->reactionable_id))->decrement('reactions_count', 1);
                break;
            case Comment::class :
                Comment::where('id', $reaction->reactionable_id)->decrement('reactions_count', 1);
                User::whereHas('comments', fn($query) => $query->where('id', $reaction->reactionable_id))->decrement('reactions_count', 1);
                break;
        }
    }
}
