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

    public function productPrice()
    {
        return $this->belongsTo(ProductPrice::class, 'product_price_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
}
