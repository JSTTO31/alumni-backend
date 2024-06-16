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
        $user->loadCount(['viewers']);

        $connection_count = $user->connectionsCount();

        $viewers = User::whereHas('views', function($query) use ($user){
            $query->where('viewable_id', $user->id);
        })->whereNotIn('id', [request()->user()->id, $user->id])->limit(5)->get();

        // $batchmates = User::whereHas('alumni_information', function($query) use ($user){
        //     $query->where('department_id', $user->alumni_information->department_id);
        // })->whereNotIn('id', [request()->user()->id, $user->id])->limit(5)->get();

        $batchmates = User::whereNotIn('id', [request()->user()->id, $user->id])->limit(5)->get();

        $attachedFollow = $request->user()->attachFollowStatus($user);
        $batchmates = $request->user()->attachConnectionStatus($batchmates);
        $attachConnection = $request->user()->attachConnectionStatus($user);

        $viewers = $request->user()->attachConnectionStatus($viewers);

        $user = collect($attachedFollow)->merge($attachConnection);
        $user['connections_count'] = $connection_count;
        $user['viewers'] = $viewers;
        $user['batchmates'] = $batchmates;

        return $user;
    }
}
