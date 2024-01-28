<?php

namespace App\Http\Controllers;

use App\Models\TitleParagraph;
use Illuminate\Http\Request;

class TitleParagraphController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'title' => ['required', 'string'],
            'paragraph' => ['required', 'string'],
            'type' => ['required', 'string'],
        ]);


        $title_paragraph = TitleParagraph::updateOrCreate(['user_id' => $request->user()->id, 'type' => $request->type], [
            ...$request->only(['title', 'paragraph', 'type']), 'user_id' => $request->user()->id
        ]);


        return $title_paragraph;
    }
}
