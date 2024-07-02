<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request, Post $post){
        $request->validate([
            'type' => ['required'],
            'description' => ['nullable']
        ]);
        $data = ['type' => $request->type, 'description' => $request->description];
        $hide = $post->report()->create(['user_id' => $request->user()->id, 'data' => json_encode($data)]);

        return $hide;
    }
}
