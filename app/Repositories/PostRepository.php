<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Support\Facades\DB;

class PostRepository
{
    public function getAll(){
        $request = request();
        return Post::with([
                'user',
                'comment' => function($query){
                    $query->with(['replies', 'user', 'reactions', 'reacted'])->withCount(['replies', 'reactions']);
                }, 'reactions', 'reacted'])
            ->whereDoesntHave('views', fn($query) => $query->where('user_id', $request->user()->id))
            ->withCount(['comments', 'reactions'])
            ->whereDate('created_at', '>=', now()->subDays(7))
            ->orderByDesc(DB::raw('comments_count + reactions_count + views'))
            ->take(5)
            ->get()
            ->map(function($data){
                $data = collect($data);
                $comment = $data['comment'];
                unset($data['comment']);
                return [...$data, 'comments' => !!$comment ? [$comment] : [], 'view' => false];
            });
    }
}
