<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __invoke(Request $request)
    {
        $about = $request->user()->about()->updateOrCreate(
            ['user_id' => $request->user()->id],
            ['paragraph' => $request->paragraph]
        );

        return $about;
    }


    // public function store(Request $request){
    //     $request->validate([
    //         'paragraph' => ['required'],
    //     ]);

    //     $about = $request->user()->about()->create($request->only(['paragraph']));


    //     return $about;
        
    // }   

    // public function update(Request $request, About $about){
    //     $request->validate([
    //         'paragraph' => ['required'],
    //     ]);

    //     $about->update($request->only(['paragraph']));


    //     return $about;
        
    // }   
}
