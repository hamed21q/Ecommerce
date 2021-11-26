<?php  namespace App\Http\Traits;

use App\Models\WishList;

trait WishListTrait
{
    public static function wishlistBelongsTo($product_id, $user_id)
    {
        $id = WishList::where([['product_id',$product_id],['user_id',$user_id]])->get()->first();
        return $id != null ? collect(['status'=>true, 'id' => $id->id]) : collect(['status'=>false]);
    }
    public static function deleteWishlist($id)
    {
        WishList::find($id)->delete();
        return 'seccessfull';
    }
}