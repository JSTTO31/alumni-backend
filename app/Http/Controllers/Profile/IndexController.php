<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        $user->addView($request->user());
        $user->load(['about', 'personal_information', 'contact_information', 'works', 'work', 'skills', 'educations', 'certifications', 'images', 'links']);
        $user->loadCount('connections');

        $viewers = User::whereHas('views', function($query) use ($user){
            $query->where('viewable_id', $user->id)->where('viewable_type', User::class);
        })->whereNotIn('id', [$request->user()->id, $user->id])->limit(5)->get();

        $batchmates = [];

        if($user->general_information){
            $batchmates = User::whereHas('general_information', function($query) use ($user){
                $query->where('department_id', $user->general_information->department_id);
            })->whereNotIn('id', [request()->user()->id, $user->id])->limit(5)->get();
        }


        // Follow status attachments
        $attachedFollow = $request->user()->attachFollowStatus($user);
        // Connection status attachments
        $batchmates = $request->user()->attachConnectionStatus($batchmates);
        $attachConnection = $request->user()->attachConnectionStatus($user);
        $viewers = $request->user()->attachConnectionStatus($viewers);

        $user = collect($attachedFollow)->merge($attachConnection);
        $user['viewers'] = $viewers;
        $user['batchmates'] = $batchmates;

        return $user;
    }
}
