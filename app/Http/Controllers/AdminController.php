<?php

namespace App\Http\Controllers;

use App\Events\Salesman;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SalesmanConfirmation;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adminRegister(Request $request)
    {
        if(!User::hasRole(1))
        {
            return response(['message' => 'You dont have permission to access / on this server.'], 403);
        }
        $validatedUser = $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users,email|string',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);
        $user = User::create([
            'role_id' => 2,
            'name' => $validatedUser['name'],
            'email' => $validatedUser['email'],
            'password' => bcrypt($validatedUser['password'])
        ]);
        $token = $user->createToken('authToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token 
        ];

        return response($response, 201);

    }
    public function update(Request $request, $id)
    {    
        $product =  Product::find($id);
        if($product != null)
        {
            $product->update([
                'user_id' => auth()->user()->id,
                'category_id' => $request->category_id,
                'name' => $request->name,
                'price' => $request->price
            ]);
            
            return 'seccessfull';

        }else{
            return response('not found', 404);
        }
    }
    public function delete($id)
    {
        $product =  Product::find($id);
        if($product != null)
        {
            $product->delete();
            return 'seccessfull';
        }else{
            return response('not found', 404);
        }
    }
    public function salesmanRequest()
    {
        return SalesmanConfirmation::where('status_id', 1)->get();
    }
    public function proccess(SalesmanConfirmation $id, Request $request)
    {
        if((int)$request->status == 1)
        {
            $id->changeStatus(config('status.confirmed'));
            $id->owner()->changeRole(config('roles.salesman'));
            return $id->owner();
        }
        else if((int)$request->status == 0)
        {
            $id->changeStatus(config('status.rejected'));

        }
    }
}
