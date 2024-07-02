<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Hide;
use Illuminate\Http\Request;

class HideController extends Controller
{
    public function store(Request $request, Comment $comment){
        $hide = $comment->hide()->create(['user_id' => $request->user()->id]);
        return $hide;
    }


    public function destroy(Request $request, Comment $comment, Hide $hide){
        $hide->delete();

        return response()->noContent();
    }
}
