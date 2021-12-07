<?php

use App\Http\Controllers\AuthController;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Mail\UserRegisted;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//GOD routes
Route::middleware(['auth:sanctum', 'God'])->group(callback: function () {
    Route::post('/admin-register', [App\Http\Controllers\AdminController::class, 'adminRegister']);  
});

//authenticated users routes
Route::middleware('auth:sanctum')->group(callback: function(){
    Route::post('/products/wishlist/{id}', [App\Http\Controllers\WishListController::class, 'register']);
    Route::delete('/products/wishlist/{product_id}', [App\Http\Controllers\WishListController::class, 'delete']);
    Route::get('/wishlist',[App\Http\Controllers\WishListController::class, 'index']);
    Route::post('/order/product/{product_id}', [App\Http\Controllers\OrderController::class, 'register']);
    Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'showCostumerOrders']);
    //salesman request
    Route::post('salesman-register',[App\Http\Controllers\SalesmanConfirmationController::class, 'confirm']);

});

//admin routes
Route::middleware(['auth:sanctum', 'admin'])->group(callback: function () {
    //product
    Route::put('product/{id}',[App\Http\Controllers\AdminController::class, 'update']);
    Route::delete('product/{id}', [App\Http\Controllers\AdminController::class, 'delete']);
    //category    
    Route::post('/category',[App\Http\Controllers\CategoryController::class, 'register']);
    Route::put('category/{id}',[App\Http\Controllers\CategoryController::class, 'update']);
    Route::delete('category/{id}', [App\Http\Controllers\CategoryController::class, 'delete']);
    //orders
    Route::get('/admin/orders', [\App\Http\Controllers\OrderController::class, 'showOrdersToAdmin']);
    //
    Route::post('/salesman-confirmation', [App\Http\Controllers\SalesmanController::class, 'salesmanRegister']);
    Route::get('/show/salesman-requests', [\App\Http\Controllers\AdminController::class, 'salesmanRequest']);
    Route::post('/salesman/{id}',[\App\Http\Controllers\AdminController::class, 'proccess']);
});


//salesman routes
Route::middleware(['auth:sanctum', 'salesman'])->group(callback: function () {
    //tags    
    Route::post('/tags', [App\Http\Controllers\TagController::class, 'register']);
    Route::put('/tags/{id}', [App\Http\Controllers\TagController::class, 'update']);
    Route::delete('/tags/{id}', [App\Http\Controllers\TagController::class, 'delete']);

    Route::put('salesman/product/{id}',[App\Http\Controllers\salesmanController::class, 'update']);
    Route::delete('salesman/product/{id}', [App\Http\Controllers\salesmanController::class, 'delete']);
    Route::post('/product', [App\Http\Controllers\SalesmanController::class, 'productRegister']);
});

//user authentication
Route::post('/register', [App\Http\Controllers\CostumerController::class, 'costumerRegister']);
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);
Route::post('/forget-password', [App\Http\Controllers\ForgetPasswordController::class, 'index']);
//salesman authentication

//public product route
Route::get('/show/products', [App\Http\Controllers\ProductController::class, 'index']);
Route::get('/show/product/{id}', [App\Http\Controllers\ProductController::class, 'showProduct']);

//to see specific category
Route::get('/category/{category}', [App\Http\Controllers\ProductController::class, 'showByCategory']);

//to see products by tags
Route::get('/tag/{tag}', [App\Http\Controllers\ProductController::class, 'showByTag']);


Route::post('/email-test/{user}', function (User $user) {
    Mail::to('hasanihamed360@gmail.com')->send(new UserRegisted($user));
});

