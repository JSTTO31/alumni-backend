<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class PictureController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'styles.scale' => ['required', 'integer'],
            'selected_frame' => ['required', 'integer'],
        ]);

        $picture = Image::where('imageable_id', $request->user()->id)->where('imageable_type', User::class)->where('type', 'profile')->first();

        $new = false; // if first time of editing profile

        if(!$picture){ // Determine if exists
            $new = true;
            $picture = new Image();
            $picture->data = json_encode($request->only(['styles', 'selected_frame']));
            $picture->type = 'profile';
            $picture->imageable_type = 'App\Models\User';
            $picture->imageable_id = $request->user()->id;
        }

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

        return $picture;
    }
}
