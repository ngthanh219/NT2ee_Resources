<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'view',
        'parent_id',  
    ];

    protected $appends = [
        'view_name'
    ];

    public function getViewNameAttribute()
    {
        if ($this->view == config('base.view.show')) {
            return 'Đang hiển thị';
        }

        return 'Đang ẩn';
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product', 'product_id', 'category_id');
    }
}
