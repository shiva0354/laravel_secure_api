<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerUser(Request $request)
    {
        $validateData = $request->validate([
            "name" => "string|required|max:255",
            "email" => "required|unique:users",
            "password" => "required|confirmed",
        ]);

        $validateData['password'] = Hash::make($request->password);

        $user = User::create($validateData);
        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'user' => $user,
            'access_token' => $accessToken,
        ]);
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Invalid credential',
            ]);
        }
        $accessToken = $user->createToken('authToken')->accessToken;
        return response([
            'message' => 'success',
            'user' => $user,
            'access_token' => $accessToken,
        ]);
    }
}
