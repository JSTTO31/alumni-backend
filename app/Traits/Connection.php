<?php

namespace App\Traits;

use App\Models\Connection as ModelsConnection;
use App\Models\RequestConnection;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

Trait Connection
{
    public function requestConnection(User $user){
        if($user->id == $this->id){
            throw new InvalidArgumentException('Connection request invalid');
        }

        $connection = RequestConnection::updateOrCreate([
            'request_to' => $user->id,
            'user_id' => $this->id
        ], [
            'request_to' => $user->id,
            'requested_at' => Carbon::now()
        ], );

        return $connection;
    }

    public function acceptConnection(User $user){

        DB::table('connections')->insert([
            [
                'user_id' => $user->id,
                'connected_to' => $this->id,
            ],
            [
                'user_id' => $this->id,
                'connected_to' => $user->id,
            ]
        ]);

        return RequestConnection::where('user_id', $user->id)->where('request_to', $this->id)->update([
            'request_accepted_at' => now()
        ]);
    }

    public function cancelRequestConnection(User $user){
        return RequestConnection::where('user_id', $this->id)->where('request_to', $user->id)->delete();
    }

    public function disconnect(User $user){
        $in = [$user->id, $this->id];
        return RequestConnection::whereIn('user_id', $in)->whereIn('request_to', $in)->delete();
    }

    public function isConnected(User $user){
        $in = [$user->id, $this->id];
        return RequestConnection::whereIn('user_id', $in)->whereIn('request_to', $in)->whereNotNull('request_accepted_at')->exists();
    }

    public function hasRequestFrom(User $user){
        return RequestConnection::where('user_id', $user->id)->where('request_to', $this->id)->exists();
    }

    private function attachStatus($user){
        if($user->id == $this->id){
            $user['requested_at'] = null;
            $user['request_accepted_at'] = null;
            $user['has_request_from'] = null;
            $user['is_connected'] = null;
            return $user;
        }
        $in = [$this->id, $user->id];
        $connection = RequestConnection::whereIn('user_id', $in)->whereIn('request_to', $in)->select('requested_at', 'request_accepted_at', 'request_to')->first();
        $user['requested_at'] = $connection->requested_at ?? null;
        $user['request_accepted_at'] = $connection->request_accepted_at ?? null;
        $user['is_connected'] = !!$user['request_accepted_at'];
        $user['has_request_from'] = !!$user['requested_at'] && $connection->request_to == $this->id && !$user['is_connected'];

        return $user;
    }


    public function attachConnectionStatus($users){

        if($users instanceof User){

            return $this->attachStatus($users);
        }

        foreach($users as $user){
            $user = $this->attachStatus($user);
        }

        return $users;
    }

    public function connections(){
        return $this->hasMany(ModelsConnection::class);
    }

    public function connectionsCount(){
        return RequestConnection::where(function($query){
            $query->where('user_id', $this->id)
                  ->orWhere('request_to', $this->id);
        })->whereNotNull('request_accepted_at')->count();
    }

    public function connection_requests(){
        return $this->hasMany(RequestConnection::class, 'request_to');
    }

    public function request_connections(){
        return $this->hasMany(RequestConnection::class);
    }
}
