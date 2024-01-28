<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function __invoke(Request $request, User $user)
    {

        $follow = $request->user()->toggleFollow($user);

        return $follow;
    }
}
