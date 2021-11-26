<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class OrderController extends Controller
{
    public function register($product_id)
    {
        if(!Product::exists($product_id))
        {
            return response('not found', 404);
        }
        Order::create([
            'user_id' => auth()->user()->id,
            'product_id' => $product_id,
            'status' => 'proccess',
            'created_at' => now()
        ]);
        
    }
    public function showCostumerOrders()
    {
        $orders = User::find(auth()->user()->id)->orders;
        return count($orders) > 0 ? $orders : response("no orderes have been registered yet",404);
    }
    public function showOrdersToAdmin()
    {
        $orders = Order::join('users', 'orders.user_id', '=', 'users.id')
                ->join('products', 'orders.product_id', '=', 'products.id')
                ->select('users.name AS Uname', 'users.email', 'products.name AS Pname', 'products.price')
                ->get();
        return $orders;
    }
}
