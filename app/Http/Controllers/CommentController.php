<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post){
        $request->validate(['text' => ['required']]);

        $comment = $post->comments()->create(['text' => $request->text, 'user_id' => $request->user()->id]);

        return $comment->load('user');
    }
}
