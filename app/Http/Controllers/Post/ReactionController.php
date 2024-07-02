<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function store(Request $request, Post $post){
        $request->validate(['type' => ['required', 'in:like,heart,sad,wow,laugh']]);

        $reaction = $post->reactions()->create([
            'user_id' => $request->user()->id,
            'type' => $request->type,
        ]);
        $request->user()->reactions_count++;
        $post->reactions_count++;
        $post->save();

        return $reaction;
    }

    public function destroy(Request $request, Post $post, Reaction $reaction){
        $reaction->delete();

        $post->reactions_count--;
        $post->save();

        return response()->noContent();
    }
}
