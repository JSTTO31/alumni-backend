<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {


        if($request->search){
            return User::where('name', 'LIKE', '%'. $request->search . '%')->get();
        }

        return [];
    }
}
