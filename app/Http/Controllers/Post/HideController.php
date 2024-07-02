<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Hide;
use App\Models\Post;
use Illuminate\Http\Request;

class HideController extends Controller
{
    public function store(Request $request, Post $post){
        $hide = $post->hide()->create(['user_id' => $request->user()->id]);

        return $hide;
    }


    public function destroy(Request $request, Post $post, Hide $hide){
        $hide->delete();

        return response()->noContent();
    }
}
