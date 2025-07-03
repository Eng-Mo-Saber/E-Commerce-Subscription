<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(Order_item::class);
    }

    public function favorites(){
        return $this->hasMany(Favorite::class);
    }
    public function carts(){
        return $this->belongsTo(Cart::class);
    }

    protected $fillable = [
        'name',
        'description',
        'price',
        'author',
        'stock_quantity',
        'publisher_year',
        'category_id',
        'image',
        'book_file',
        'audio_file',
    ];
}
