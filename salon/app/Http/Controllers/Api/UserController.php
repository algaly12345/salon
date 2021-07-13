<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{

    public function current()  {
        return new UserResource(auth()->user());
    }


    public function update(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.auth()->id()
        ]);
        $user = User::find(auth()->id());
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();
        return new UserResource($user);

    }


    public function requestTokenGoogle(Request $request) {
        // Getting the user from socialite using token from google
        $user = Socialite::driver('google')->stateless()->userFromToken($request->token);

        // Getting or creating user from db
        $userFromDb = User::firstOrCreate(
            ['email' => $user->getEmail()],
            [
                'email_verified_at' => now(),
                'first_name' => $user->offsetGet('given_name'),
                'last_name' => $user->offsetGet('family_name'),
                'avatar' => $user->getAvatar(),
            ]
        );

        // Returning response
        $token = $userFromDb->createToken('Laravel Sanctum Client')->plainTextToken;
        $response = ['token' => $token, 'message' => 'Google Login/Signup Successful'];
        return response($response, 200);
    }






}
