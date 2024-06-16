<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class CoverController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->merge([
            'styles' => json_decode($request->styles, true)
        ]);

        $request->validate([
            'styles.translateY' => ['required'],
        ]);

        $cover = $request->user()->profile_cover;
        $new = false;

        if(!$cover){ // Determine if exists
            $new = true;
            $cover = new Image();
            $cover->type = 'cover';
            $cover->imageable_type = 'App\Models\User';
            $cover->imageable_id = $request->user()->id;
        }

        $cover->data = json_encode($request->only(['styles']));

        if($request->hasFile('image') || $new){
            $request->validate([
                'image' => ['required', File::image()->max(1024 * 12)],
            ]);

            if($cover->location ?? false){
                Storage::disk('public')->delete($cover->location);
            }

            $cover->location = $request->file('image')->store("profiles/{$request->user()->email}", 'public');
        }

        $cover->save();

        $cover = collect($cover);
        $cover['data'] = $request->only(['styles']);

        return  [
            'cover' => $request->getSchemeAndHttpHost() . "/storage/" . $cover['location'],
            'profile_cover' => $cover,
        ];
    }
}
