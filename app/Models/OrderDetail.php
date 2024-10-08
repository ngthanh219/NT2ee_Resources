<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'store_id',
        'product_price_id',
        'product_name',
        'product_price',
        'quantity',
        'total',
    ];
}
