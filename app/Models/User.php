<?php

namespace App\Models;

// Quan trọng nhất là dòng này
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_users';
    protected $primaryKey = 'userid';
    public $timestamps = false;

    protected $fillable = [
        'username', 'email', 'password', 'role', 'status', 'isActive', 'phoneNumber', 'address', 'IpAdress'
    ];

    // Để Laravel hiểu cột mật khẩu của bạn
    public function getAuthPassword()
    {
        return $this->password;
    }
}