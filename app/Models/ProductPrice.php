<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'attribute_ids',
        'quantity',
        'price',
        'sale_percent',
        'sale_price'
    ];

    protected $appends = [
        'attribute_names'
    ];

    public function getAttributeIdsAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setAttributeIdsAttribute($value)
    {
        $this->attributes['attribute_ids'] = json_encode($value);
    }

    public function getAttributeNamesAttribute()
    {
        $attributeIds = json_decode($this->attributes['attribute_ids'], true);
        $attributeNames = Attribute::whereIn('id', $attributeIds)->orderBy('type')->pluck('name')->toArray();
        $name = '';

        foreach ($attributeNames as $index => $attributeName) {
            $name .= $attributeName;

            if (isset($attributeNames[$index + 1])) {
                $name .= ' - ';
            }
        }

        return $name;
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
