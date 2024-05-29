<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class ImageController extends Controller
{
    public function store(ImageRequest $request){
        $location = $request->file("image")->store("images/{$request->user()->email}", 'public');
        $image = $request->user()->images()->create([
            'location' => $location,
            'type' => 'portfolio',
            'data' => json_encode(['title' => $request->title]),
        ]);

        return $image;
    }

    public function update(Request $request, Image $image){
        $request->validate([
            'title' => ['required'],
        ]);

        $image->data = json_encode(['title' => $request->title]);
        $image->type = 'portfolio';

        if($request->hasFile('image')){
            $request->validate([
                'image' => [ File::image()->max(12 * 1024)]
            ]);

            $location = $request->file('image')->store("images/{$request->user()->email}", 'public');
            Storage::disk('public')->delete($image->location);
            $image->location = $location;
        }

        $image->save();

        return $image;
    }

    public function destroy(Request $request, Image $image){
        $image->delete();

        return response()->noContent();
    }
}
