<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_number',
        'user_id',
        'product_id',
        'address',
        'quantity',
        'price',
        'payment_method',
        'shipping_method',
        'total_price',
        'status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }
}
