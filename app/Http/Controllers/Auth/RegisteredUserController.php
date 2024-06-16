<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterUserRequest $request): Response
    {
        DB::beginTransaction();

        try {

            $user = User::create([
                'name' => $request->account['name'],
                'email' => $request->account['email'],
                'password' => Hash::make($request->account['password']),
            ]);

            $user->personal_information()->create($request->personal);
            $user->contact_information()->create($request->contact);

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        Auth::login($user);

        return response()->noContent();
    }
}
