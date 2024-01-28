<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function add_reaction(Request $request){
        $request->validate(['id' => ['required', 'numeric'], 'type' => ['in:comment,post']]);

        return $this->reactToggle($request->id, $request->type);
    }

    public function remove_reaction(Request $request){
        return $this->reactToggle($request->id, $request->type);
    }

    public function toggle(Request $request){
        return $this->reactToggle($request->id, $request->type);
    }

    public function reactToggle($id, $type){
        $request = request();
        $exists = Reaction::where('type', $type)->where('mark_id', $id)->where('user_id', $request->user()->id)->first();

        if($exists){
            $exists->delete();
            return response()->json(null, 204);
        }else{
            return Reaction::create([
                'user_id' => $request->user()->id,
                'type' => $type,
                'mark_id' => $id,
            ]);
        }

    }
}
