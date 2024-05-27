<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        $user->addView($request->user());
        $user->load(['about', 'alumni_information', 'informations', 'personal_information', 'contact_information', 'works', 'work', 'skills', 'educations', 'certifications', 'images', 'links']);
        $user->loadCount(['viewers']);

        $connection_count = $user->connectionsCount();

        $viewers = User::with('alumni_information.department')->whereHas('views', function($query) use ($user){
            $query->where('viewable_id', $user->id);
        })->whereNotIn('id', [request()->user()->id, $user->id])->limit(5)->get();

        $batchmates = User::whereHas('alumni_information', function($query) use ($user){
            $query->where('department_id', $user->alumni_information->department_id);
        })->whereNotIn('id', [request()->user()->id, $user->id])->limit(5)->get();

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
