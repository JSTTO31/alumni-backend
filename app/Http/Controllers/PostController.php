<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use App\Models\Reaction;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{

    private $postRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
    }

    public function index(Request $request){
    return $this->postRepository->getAll();
    }

    public function show(Request $request, Post $post){

        $post->load([
            'user',
            'comment' => function($query){
                $query->with(['replies', 'user', 'reactions', 'reacted'])->withCount(['replies', 'reactions']);
            }, 'reactions', 'reacted', 'comments' => fn($query) => $query->with(['user', 'replies.user'])]
        );

        return $post;
    }

    public function store(PostStoreRequest $request){
        $post = Post::create([...$request->only(['text', 'privacy']), 'user_id' => $request->user()->id]);
        $post->load(['user', 'reactions', 'reacted']);
        $post = collect($post);
        $post['comments'] = [];
        $post['comments_count'] = 0;
        $post['reactions_count'] = 0;

        return $post;
    }

}
