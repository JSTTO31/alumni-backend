<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeopleController extends Controller
{
    public function people_you_may_know(Request $request, User $user){
        $limit = $request->limit ?? 12;
        $users = User::whereHas('views', fn($query) => $query->where('viewable_id', $user->id)->where('user_id', '!=', $user->id))
                ->where('name', 'LIKE', '%'. $request->search . '%')->cursorPaginate($limit);

        $options = $users;
        $users = $request->user()->attachConnectionStatus($users->items());
        return [...collect($options), 'data' => $users];
    }

    public function batchmates(Request $request, User $user){
        $user->load('alumni_information');
        $department_id = $user->alumni_information->department_id;
        $limit = $request->limit ?? 12;
        $users = User::whereHas('alumni_information', fn($query) => $query->where('department_id', $department_id))
                ->withCount(['connections' => fn($query) => $query->where('connected_to', $user->id)])
                ->where('name', 'LIKE', '%'. $request->search . '%')->orderByDesc(DB::raw('connections_count'))->paginate($limit);

        return $users;
    }
}
