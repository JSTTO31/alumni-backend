<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(Request $request, Post $post){
        $comments = Comment::where('post_id', $post->id)
                    ->where('user_id', '<>', $request->user()->id)
                    ->whereDoesntHave('hide')
                    ->select("comments.*", DB::raw("(comments.reactions_count + (comments.replies_count * 10)) as interaction"))
                    ->orderByDesc('interaction')
                    ->cursorPaginate(10);
        $options = collect($comments);
        $comments = $options['data'];
        unset($options['data']);

        return [
            'options' => $options,
            'comments' => $comments,
        ];
    }

    public function store(Request $request, Post $post){
        $request->validate(['text' => ['required'], 'comment_id' => ['nullable', 'numeric']]);

        $comment = $post->comments()->create([
            'text' => $request->text,
            'user_id' => $request->user()->id,
            'comment_id' => $request->comment_id ?? null,
            'replies_count' => $request->comment_id ? 1 : 0,
        ]);

        $post->comments_count++;
        $post->save();

        $comment = collect($comment);
        $comment['replies'] = [];
        $comment['reacted'] = null;
        $comment['hide'] = null;
        $comment['report'] = null;
        $comment['user'] = $request->user();


        return $comment;
    }

    public function destroy(Request $request, Post $post, Comment $comment){
        $comment->delete();

        return response()->noContent();
    }
}
