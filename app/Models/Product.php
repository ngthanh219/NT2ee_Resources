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
        'view'
    ];

    protected $appends = [
        'view_name'
    ];

    public function getImageAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getViewNameAttribute()
    {
        if ($this->view == config('base.view.show')) {
            return 'Đang hiển thị';
        }

        return 'Đang ẩn';
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = json_encode($value);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'category_id', 'product_id');
    }

    public function prices()
    {
        return $this->hasMany(ProductPrice::class, 'product_id', 'id');
    }
}
