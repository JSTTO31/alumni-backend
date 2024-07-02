<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReplyController extends Controller
{
    public function index(Request $request, Comment $comment)
    {
        $replies = Comment::with(['reacted', 'hide', 'report', 'user'])
                 ->whereDoesntHave('hide')
                 ->where('user_id', '<>', $request->user()->id)
                 ->select("comments.*", DB::raw("(comments.reactions_count) as interaction"))
                 ->where('comment_id', $comment->id)->cursorPaginate(8);

        $options = collect($replies);
        $replies = $options['data'];
        unset($options['data']);

        return [
            'options' => $options,
            'replies' => $replies,
        ];
    }

    public function store(Request $request, Comment $comment){
        $request->validate(['text' => ['required']]);

        $reply = $comment->replies()->create([
            'text' => $request->text,
            'user_id' => $request->user()->id,
            'comment_id' => $comment->id,
            'post_id' => $comment->post_id,
            'replies_count' => $request->comment_id ? 1 : 0,
        ]);

        $comment->replies_count += 1;
        $comment->save();

        $reply = collect($reply);
        $reply['replies'] = [];
        $reply['reacted'] = null;
        $reply['hide'] = null;
        $reply['report'] = null;
        $reply['user'] = $request->user();


        return $reply;
    }

    public function destroy(Request $request, Comment $comment, Comment $reply){
        $reply->delete();
        $comment->replies_count -= 1;
        $comment->save();
        return response()->noContent();
    }
}
