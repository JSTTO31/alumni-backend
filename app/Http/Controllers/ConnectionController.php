<?php

namespace App\Http\Controllers;

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
        $limit = $request->limit ?? 5;
        $users = User::whereHas('connections', function($query) use ($user){
            $query->where('connected_to', $user->id);
        })->where('name', 'LIKE', '%'. $request->search . '%')->cursorPaginate($limit);

        return $users;
    }

    public function connection_requests(Request $request, User $user){
        $limit = $request->limit ?? 5;
        $users = User::whereHas('request_connections', fn($query) => $query->where('request_to', $user->id)->whereNull('request_accepted_at'))->where('name', 'LIKE', '%'. $request->search . '%')->cursorPaginate($limit);
        $options = $users;
        $users = $request->user()->attachConnectionStatus($users->items());
        return [...collect($options), 'data' => $users];
    }
}
