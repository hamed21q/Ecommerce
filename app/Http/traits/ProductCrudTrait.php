<?php 
namespace App\Http\Traits;

use Illuminate\Http\Request;
use App\Models\Product;

trait ProductCrudTrait
{
    public function update(Request $request, $id)
    {    
        $product =  Product::where('id', $id)->first();
        if($product != null)
        {
            $product->update([
                'user_id' => auth()->user()->id,
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
        $product =  Product::where('id', $id)->first();
        if($product != null)
        {
            $product->delete();
            return 'seccessfull';
        }else{
            return response('not found', 404);
        }
    }
    public static function exists($id)
    {
        $product = Product::find($id);
        if($product == null)
                return false;
        return true;
    }
}