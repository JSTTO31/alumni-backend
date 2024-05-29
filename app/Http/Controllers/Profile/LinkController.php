<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\LinkRequest;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function store(LinkRequest $request){
        $link = $request->user()->links()->create($request->only(['title', 'location']));

        return $link;
    }


    public function update(LinkRequest $request, Link $link){
        $link->update($request->only(['title', 'location']));

        return $link;
    }

    public function destroy(Request $request, Link $link){
        $link->delete();

        return response()->noContent();
    }
}
