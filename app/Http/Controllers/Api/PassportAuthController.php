<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Register;
use App\Models\User;
use Illuminate\Http\Request;

class PassportAuthController extends Controller
{
    public function register(Register $request){

        $user = User::create([

            'name' => $request -> name,
            'email' => $request -> email,
            'password' => bcrypt($request->password)

        ]);
        $token = $user -> createToken('AuthApp')->accessToken;
        return response()->json(['token' => $token],200);



    }

    public function login(Request $request){

        $data = [
            'name' => $request->name,
            'password' => $request->password
        ];
        if (auth()->attempt($data)){
            $token = auth()->user()->createToken('AuthApp')->accessToken;
            return response()->json(['token' => $token],200);

        }
        else {
            return response()->json(['error' => 'Unauthorised'],401);
        }



    }


    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
