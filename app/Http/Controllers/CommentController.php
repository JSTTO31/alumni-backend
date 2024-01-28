<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post){
        $request->validate(['text' => ['required'], 'comment_id' => ['nullable', 'numeric']]);

        $comment = $post->comments()->create([
            'text' => $request->text,
            'user_id' => $request->user()->id,
            'comment_id' => $request->comment_id ?? null
        ]);

        $comment->load(['user']);

        $comment = collect($comment);
        $comment['replies'] = [];
        $comment['reactions'] = [];
        $comment['reacted'] = null;
        $comment['reactions_count'] = 0;
        $comment['replies_count'] = 0;

        return $comment;
    }
}
