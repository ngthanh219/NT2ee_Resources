<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'note',
        'total',
        'payment_method',
        'status',
        'is_paid'
    ];

    protected $appends = [
        'payment_method_name',
        'status_name',
        'is_paid_name'
    ];

    public function getPaymentMethodNameAttribute()
    {
        return config('base.payment_method_name')[$this->payment_method];
    }

    public function getStatusNameAttribute()
    {
        return config('base.order_status_name')[$this->status];
    }

    public function getIsPaidNameAttribute()
    {
        return config('base.is_paid_name')[$this->is_paid];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
