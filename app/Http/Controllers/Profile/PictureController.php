<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\PictureRequest;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class PictureController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->merge([
            'styles' => json_decode($request->styles, true)
        ]);

        $request->validate([
            'styles.scale' => ['required'],
            'selected_frame' => ['required'],
        ]);

        $picture = $request->user()->profile_picture;
        $new = false; // if first time of editing profile

        if(!$picture){ // Determine if exists
            $new = true;
            $picture = new Image();
            $picture->type = 'profile';
            $picture->imageable_type = 'App\Models\User';
            $picture->imageable_id = $request->user()->id;
        }

        $picture->data = json_encode($request->only(['styles', 'selected_frame']));

        if($request->hasFile('image') || $new){
            $request->validate([
                'image' => ['required', File::image()->max(1024 * 12)],
            ]);

            if($picture->location ?? false){
                Storage::disk('public')->delete($picture->location);
            }

            $picture->location = $request->file('image')->store("profiles/{$request->user()->email}", 'public');
        }

        $picture->save();

        $picture = collect($picture);
        $picture['data'] = $request->only(['styles', 'selected_frame']);

        return  [
            'picture' => $request->getSchemeAndHttpHost() . "/storage/" . $picture['location'],
            'profile_picture' => $picture,
        ];
    }
}
