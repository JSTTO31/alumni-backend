<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(Request $request){
        $posts = Post::whereDoesntHave('hide')
                ->where('user_id', 1)
                ->select("posts.*", DB::raw("(posts.comments_count + posts.reactions_count) as interaction"))
                ->orderByDesc("interaction")
                ->cursorPaginate(5);
        $options = collect($posts);
        $posts = collect($options['data'])->map(fn($item) => [...$item]);
        unset($options['data']);
        return [
            'options' => [...$options],
            'posts' => $posts,
        ];
    }

    public function show(Request $request, Post $post){
        $post->load([
            'user' => fn($query) => $query->with([
                'general_information', 'contact_information', 'about',
                'posts' => fn($query) => $query->where('id', '<>', $post->id)->where('postable_type', PostText::class)->select('posts.*', DB::raw("(posts.comments_count + posts.reactions_count) as interaction"))->orderByDesc('interaction')->limit(3)
            ])]);
        $author = $post->user;
        $author = $request->user()->attachConnectionStatus($author);
        $post = collect($post);
        $post['user'] = $author;
        return $post;
    }

    public function destroy(Request $request, Post $post){
        $post->delete();

        return response()->noContent();
    }
}
