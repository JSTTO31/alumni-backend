<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request){
        if($request->search){
            $searched = [];
            $user = $request->user();

            switch($request->filter){
                case 'basic-people':
                    $users =  User::where('name', 'LIKE', '%'. $request->search . '%')->limit(6)->get();
                    $searched = $user->attachFollowStatus($users);
                    break;
                case 'people':
                    $users = User::with(['about', 'alumni_information'])->where('name', 'LIKE', '%'. $request->search . '%')->paginate(10);
                    $searched = [...collect($users), 'data' => $user->attachFollowStatus($users)];
                    break;
                case 'people':
                    $users = User::with(['about', 'alumni_information'])->where('name', 'LIKE', '%'. $request->search . '%')->paginate(10);
                    $searched = [...collect($users), 'data' => $user->attachFollowStatus($users)];
                    break;
                default:
                    $searched =  [
                        'people' => User::with(['about', 'alumni_information'])->where('name', 'LIKE', '%'. $request->search . '%')->limit(3)->get(),
                        'posts' => Post::where('text', 'LIKE', '%'. $request->search . '%')->limit(4)->get(),
                    ];
            }

            return $searched;
        }

        return [];
    }
}
