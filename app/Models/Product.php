<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'is_new',
        'is_hot',
        'is_best_seller',
        'view'
    ];

    protected $appends = [
        'view_name',
        'is_new_name',
        'is_hot_name',
        'is_best_seller_name',
    ];

    public function getImageAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = json_encode($value);
    }

    public function getIsNewNameAttribute()
    {
        return config('base.is_new_name')[$this->is_new];
    }

    public function getIsHotNameAttribute()
    {
        return config('base.is_hot_name')[$this->is_hot];
    }

    public function getIsBestSellerNameAttribute()
    {
        return config('base.is_best_seller_name')[$this->is_best_seller];
    }

    public function getViewNameAttribute()
    {
        if ($this->view == config('base.view.show')) {
            return 'Đang hiển thị';
        }

        return 'Đang ẩn';
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    public function prices()
    {
        return $this->hasMany(ProductPrice::class, 'product_id', 'id');
    }
}
