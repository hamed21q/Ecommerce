<?php

namespace App\Models;

use App\http\traits\AuthUserTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, AuthUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function Role()
    {
        return $this->hasOne(Role::class);
    }
    public function product()
    {
       return $this->hasMany(Product::class);
    }
    public static function is_owner($productId)
    {
        $products = auth()->user()->product;
        foreach($products as $product)
        {
            if($product->id == $productId)
            {
                return true;
            }
        }
        return false;
    }
    public function wishlist()
    {
        return $this->belongsToMany(Product::class, 'wish_lists', 'user_id', 'product_id');
    }
    public function orders()
    {
        return $this->belongsToMany(Product::class, 'orders', 'user_id', 'product_id');
    }
    public function changeRole($value)
    {
        $this->role_id = $value;
        $this->save();
    }
}
