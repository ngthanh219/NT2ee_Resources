<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'phone',
        'address'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'role_name'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRoleNameAttribute()
    {
        switch ($this->role_id) {
            case config('base.role_id.admin'):
                return 'Tài khoản admin';
                break;

            case config('base.role_id.manage'):
                return 'Tài khoản quản lý';
                break;

            case config('base.role_id.staff'):
                return 'Tài khoản nhân viên';
                break;

            case config('base.role_id.customer'): 
                return 'Tài khoản khách hàng';
                break;
        }

        return 'Tài khoản khách hàng';
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }
}
