<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request){
        return Post::with(['user', 'comment.user'])->get();
    }

    public function store(PostStoreRequest $request){
        $post = Post::create([...$request->only(['text', 'privacy']), 'user_id' => $request->user()->id]);

        return $post->load(['user']);
    }
}
