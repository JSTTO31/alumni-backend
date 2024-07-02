<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function store(Request $request, Comment $comment){
        $request->validate(['type' => ['required', 'in:like,heart,sad,wow,laugh']]);

        $reaction = $comment->reactions()->create([
            'user_id' => $request->user()->id,
            'type' => $request->type,
        ]);

        $comment->reactions_count++;
        $comment->save();

        return $reaction;
    }

    public function destroy(Request $request, Comment $comment, Reaction $reaction){
        $reaction->delete();

        $comment->reactions_count--;
        $comment->save();

        return response()->noContent();
    }
}
