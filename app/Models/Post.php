<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'slug',
        'short_description',
        'content',
        'view',
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
