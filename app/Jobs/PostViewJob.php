<?php

namespace App\Jobs;

use App\Models\Post;
use App\Models\View;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PostViewJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $post;
    public $user;

    public function __construct(Post $post, $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $exists = View::where('post_id', $this->post->id)->where('user_id', $this->user->id)->first();

        if($exists){
            return ;
        }

        $this->post->views()->create([
            'user_id' => $this->user->id,
        ]);
    }
}
