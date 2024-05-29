<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
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
}
