<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Reaction;
use App\Observers\CommentObserver;
use App\Observers\PostObserver;
use App\Observers\ReactionObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Post::observe(PostObserver::class);
        Comment::observe(CommentObserver::class);
        Reaction::observe(ReactionObserver::class);
    }
}
