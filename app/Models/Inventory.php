<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'product_price_id',
        'quantity',
        'view'
    ];

    public function productPrice()
    {
        return $this->belongsTo(productPrice::class, 'product_price_id', 'id');
    }
}
