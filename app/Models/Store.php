<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'phone',
        'email',
        'iframe',
        'view'
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

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'store_id', 'id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'store_id', 'id');
    }
}
