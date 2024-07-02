<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostTextRequest;
use App\Models\PostText;
use Illuminate\Http\Request;

class TextController extends Controller
{
    public function store(PostTextRequest $request){
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
}
