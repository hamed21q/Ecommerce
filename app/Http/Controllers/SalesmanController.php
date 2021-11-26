<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class SalesmanController extends Controller
{
    public function salesmanRegister(Request $request)
    {
        if(!User::hasRole(2))
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
            'role_id' => 3,
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
    public function productRegister(Request $request)
    {
        // return Category::find($request->category_id);
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'category_id' => 'required|numeric'
        ]);
        $product = Product::create( [
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
        ]);
        foreach($request->tags as $tag)
        {
            DB::table('product_tag')->insert([
                'product_id' => $product->id,
                'tag_id' => $tag
            ]);
        }

        return response($product, 201);
    }
    public function update(Request $request, $id)
    {
        if(!User::is_owner($id))
            return response(['message' => 'You dont have permission to access / on this server.'], 403);
        $product = Product::find($id);
        if($product != null)
        {
            $product->update([
                'user_id' => auth()->user()->id,
                'category_id' => $request->category_id,
                'name' => $request->name,
                'price' => $request->price
            ]);
            return 'seccessfull';
        }
        return response(['message' => 'not found'], 404);

    }
    public function delete($productId)
    {
        $product = Product::find($productId);
        if(!User::is_owner($productId) || $product == null)
            return response(['message' => 'You dont have permission to access / on this server.'], 403);
        $product->delete();
        return 'deleted';
    }

}
