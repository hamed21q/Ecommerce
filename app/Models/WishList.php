<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\WishListTrait;

class WishList extends Model
{
    use HasFactory, WishListTrait;
    protected $fillable = [
        'user_id',
        'product_id'
    ];
}
