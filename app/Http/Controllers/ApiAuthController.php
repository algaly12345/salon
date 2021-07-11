<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Firebase\Auth\Token\Exception\InvalidToken;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {

        try {
            $http = new \GuzzleHttp\Client;

            $response = $http->post('http://localhost/salon/public/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => '2',
                    'client_secret' => 'z8pW2NFS7b9KySNCB3xUBMCwo14JnQW0NAweCrh6',
                    'username' => $request->email,
                    'password' => $request->password,
                    'scope' => '*',
                ],
            ]);

            return  $response->getBody();
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() === 400) {

                return response()->json(['success' => 'notfount']);

               // return response()->json(['ok'=>'0', 'erro'=> 'Invalid Request. Please enter a username or a password.'], $e->getCode());
            } else if ($e->getCode() === 401) {
                return $e;
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }
return $e;
            return response()->json('Something went wrong on the server.', $e->getCode());
        }
    }
    function logout(){
        auth()->user()->tokens->each(function($token){
            $token->delete();
        });
        return response()->json('logout successfully',200);
    }



}
