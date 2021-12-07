<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\UserRegistered;
use App\Mail\UserRegisted;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class CostumerController extends Controller
{
    public function costumerRegister(Request $request)
    {
        $validatedUser = $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users,email|string',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);
        $user = User::create([
            'role_id' => 4,
            'name' => $validatedUser['name'],
            'email' => $validatedUser['email'],
            'password' => bcrypt($validatedUser['password'])
        ]);
        $token = $user->createToken('authToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token 
        ];

        event(new UserRegistered($user));

        return response($response, 201);
    }
}
