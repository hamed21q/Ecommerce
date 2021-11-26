<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validatedUser = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('email', $validatedUser['email'])->first();
        if(!$user || !Hash::check($validatedUser['password'], $user->password))
        {
            return response(['message' => 'bad creds'], 401);
        }
        
        $token = $user->createToken('authToken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token 
        ];

        return response($response, 201);
    }
}
