<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'user_id',
        'category_id'
    ];
    public function salesman()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->hasOne(Category::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
    }

    public function user()
    {
       return $this->belongsToMany(User::class, 'wish_lists', 'product_id', 'user_id');
    }
    public function orders()
    {
        return $this->belongsToMany(User::class, 'orders', 'product_id', 'user_id');
    }
}
