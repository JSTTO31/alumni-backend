<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function profile(Request $request, User $user){
        // $user->addView($request->user());
        return response()->noContent();

    }

    public function post(Request $request, Post $post){
        // $post->addView($request->user() ?? $request->ip());

        return response()->noContent();
    }
}
