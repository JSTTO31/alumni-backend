<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request, Comment $comment){
        $request->validate([
            'type' => ['required'],
            'description' => ['nullable']
        ]);
        $data = ['type' => $request->type, 'description' => $request->description];
        $hide = $comment->report()->create(['user_id' => $request->user()->id, 'data' => json_encode($data)]);

        return $hide;
    }
}
