<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\WishList;

class WishListController extends Controller
{
    public function index()
    {
       $wishList = WishList::where(['user_id', auth()->user()->id])->get();
       return count($wishList) > 0 ? $wishList : response('wishlist is empty', 404);
    }
    public function register($id)
    {
        
        if(Product::exists($id))
            return response('not found', 404);
        $whislist = WishList::create([
            'user_id' => auth()->user()->id,
            'product_id' => $id,
            'created_at' => now()
        ]); 
    }
    public function delete($product_id)
    {
        $data = WishList::wishlistBelongsTo($product_id, auth()->user()->id);
        return $data['status'] ? 
            WishList::deleteWishlist($data['id']) : response('you dont have permission to access this page', 404);
    }
}
