<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeopleController extends Controller
{
    public function people_you_may_know(Request $request){
        $user = $request->user();
        $user->load('contact_information');
        $limit = $request->limit ?? 12;
        $users = User::whereHas('views', fn($query) => $query->where('viewable_id', $user->id)->where('user_id', '<>', $user->id))
                ->whereDoesntHave('connections', fn($query) => $query->where('connected_to', $user->id))
                ->whereDoesntHave('request_connections', fn($query) => $query->where('request_to', $user->id))
                ->whereDoesntHave('has_removes', fn($query) => $query->where('user_id', $user->id))
                ->orWhereHas('contact_information', fn($query) => $query->where('city', $user->contact_information->city)->where('user_id', '<>', $user->id))
                ->whereDoesntHave('connections', fn($query) => $query->where('connected_to', $user->id))
                ->whereDoesntHave('request_connections', fn($query) => $query->where('request_to', $user->id))
                ->whereDoesntHave('has_removes', fn($query) => $query->where('user_id', $user->id))
                ->orWhereHas('general_information', fn($query) => $query->where('department_id', $user->general_information->deparment_id)->where('user_id', '<>', $user->id))
                ->whereDoesntHave('connections', fn($query) => $query->where('connected_to', $user->id))
                ->whereDoesntHave('request_connections', fn($query) => $query->where('request_to', $user->id))
                ->whereDoesntHave('has_removes', fn($query) => $query->where('user_id', $user->id))
                ->cursorPaginate($limit);
        $options = collect($users);
        $users = $request->user()->attachConnectionStatus($users->items());
        unset($options['data']);

        return ['options' => $options, 'users' => $users];
    }

    public function batchmates(Request $request, User $user){
        $limit = $request->limit ?? 12;
        $users = User::whereHas('general_information', fn($query) => $query->where('department_id', $user->general_information->department_id))
                ->where('id', '<>', $user->id)
                ->withCount(['connections' => fn($query) => $query->where('connected_to', $user->id)])
                ->where('name', 'LIKE', '%'. $request->search . '%')->orderByDesc(DB::raw('connections_count'))->cursorPaginate($limit);
        $options = collect($users);
        $users = $request->user()->attachConnectionStatus($users->items());
        unset($options['data']);

        return ['options' => $options, 'users' => $users];
    }
}
