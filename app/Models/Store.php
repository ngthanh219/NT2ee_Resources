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

}
