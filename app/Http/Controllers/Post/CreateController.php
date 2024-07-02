<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostText;
use Exception;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function text(Request $request, Post $post){
        $text = PostText::create($request->only(['content']));
        $post = $text->post()->create([
            'user_id' => $request->user()->id,
            'privacy' => $request->privacy,
            'title' => $request->title,
        ]);

        return [
            ...collect($post),
            'data' => $text,
        ];
    }

    public function share(Request $request, Post $post){
        $request->validate(['title' => ['required'], 'privacy' => 'in:public,private,batchmates,connected']);
        $shared = $post;

        if($post->postable_type == Post::class){
            throw new Exception("The can't be done!");
        }

        $post = $post->post()->create([
            'title' => $request->title,
            'privacy' => $request->privacy,
            'user_id' => $request->user()->id,
        ]);

        $shared->shares_count += 1;
        $shared->save();

        $post->load('user', 'reacted', 'post_saved', 'hide', 'report');

        return [
            ...collect($post),
            'data' => $shared,
        ];
    }
}
