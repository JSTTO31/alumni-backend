<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Save;
use Illuminate\Http\Request;

class SaveController extends Controller
{
    public function store(Request $request, Post $post){
        $save = $request->user()->post_saves()->create([
            'saveable_id' => $post->id,
            'saveable_type' => Post::class,
        ]);


        return $save;
    }


    public function destroy(Request $request, Post $post, Save $save){
        $save->delete();


        return response()->noContent();
    }
}
