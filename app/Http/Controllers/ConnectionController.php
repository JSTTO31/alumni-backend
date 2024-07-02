<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\User;
use Illuminate\Http\Request;

class ConnectionController extends Controller
{
    public function request(Request $request, User $user){
        $connection = $request->user()->requestConnection($user);
        $request->user()->follow($user);
        return $connection;
    }

    public function cancel(Request $request, User $user){
        $request->user()->cancelRequestConnection($user);
        $request->user()->unfollow($user);
        return response(null, 200);
    }

    public function disconnect(Request $request, User $user){
        $request->user()->disconnect($user);
        $request->user()->unfollow($user);
        return response(null, 200);
    }

    public function confirm(Request $request, User $user){
        $request->user()->acceptConnection($user);
        $request->user()->follow($user);
        return response(null, 200);
    }

    public function connections(Request $request, User $user){
        $limit = $request->limit ?? 6;
        $users = User::whereHas('connections', function($query) use ($user){
            $query->where('connected_to', $user->id);
        })->where('name', 'LIKE', '%'. $request->search . '%')->cursorPaginate($limit);
        $count = Connection::where('connected_to', $request->user()->id)->count();
        $options = collect($users);
        $users = $request->user()->attachConnectionStatus($users->items());
        unset($options['data']);
        return ['options' => [...$options, 'count' => $count], 'users' => $users];
    }

    public function connection_requests(Request $request){
        $user = $request->user();
        $limit = $request->limit ?? 6;
        $users = User::whereHas('request_connections', fn($query) => $query->where('request_to', $user->id)->whereNull('request_accepted_at'))
        ->whereDoesntHave('has_removes', fn($query) => $query->where('user_id', $user->id))
        ->cursorPaginate($limit);
        $count = User::whereHas('request_connections', fn($query) => $query->where('request_to', $user->id)->whereNull('request_accepted_at'))
        ->whereDoesntHave('has_removes', fn($query) => $query->where('user_id', $user->id))->count();
        $options = collect($users);
        $users = $request->user()->attachConnectionStatus($users->items());
        unset($options['data']);
        return ['options' => [...$options, 'count' => $count], 'users' => $users];
    }
}
