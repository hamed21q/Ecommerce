<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'user_id'];  
    public function product()
    {
        return $this->belongsToMany(Product::class);
    } 
}
