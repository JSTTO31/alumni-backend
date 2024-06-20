<?php

namespace App\Http\Controllers;

use App\Models\PersonRemove;
use App\Models\User;
use Illuminate\Http\Request;

class PersonRemoveController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        $request->user()->person_removes()->updateOrCreate(['remove_id' => $user->id]);
        return response(null, 204);
    }
}
