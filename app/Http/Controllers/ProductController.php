<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use App\Models\WishList;

use function PHPUnit\Framework\isEmpty;

class ProductController extends Controller
{
    /*
    | anyone can see all products
    | anyone can see a single product
    | costumer order a product
    | costumer has crud permission on his orders
    | admin have crud permission on product
    | admin have crud permission on orders
    */ 
    public function index()
    {
        //to see all products
        $products = Product::all();
        return $products;
    }
    public function showProduct($id)
    {
        //to see a single product with the id
        $product = Product::findorfail($id);
        $tags = $product->tags;
        
        return $product ? [$product, $tags] : response('not found', 404);
    }
    public function showByCategory($category)
    {
        //show all prodect which has a specific category
        $catId = Category::where('name', $category)->select('id')->first();
        if($catId == null)
            return response('not found', 404);
        $products = Product::where('category_id', $catId->id)->get();
        return $products;
    }

    public function showByTag($tag)
    {
        //show all products which has a specific Tag
        $tagId = Tag::where('name', $tag)->select('id')->first();
        if($tagId == null)
            return response('not found', 404);
        $tag = Tag::find($tagId->id);
        $products = Tag::find($tagId->id)->products;
        
        return count($products) > 0 ? $products :  response('not found', 404);
    }

    
}
