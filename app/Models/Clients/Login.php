<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Login extends Model
{
    protected $table = 'tbl_users';

    protected $primaryKey = 'userid';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'email',
        'password',
        'phoneNumber',
        'address',
        'IpAdress',
        'isActive',
        'status',
        'reset_token',
        'provider',
        'provider_id',
        'role'
    ];



    // ========================
    // Insert user
    // ========================

public function insertUser($data)
{
    return DB::table($this->table)->insert([
        'username' => $data['username'],
        'email' => $data['email'],
        'password' => $data['password'], // KHÔNG HASH LẠI
        'phoneNumber' => $data['phoneNumber'] ?? null,
        'address' => $data['address'] ?? null,
        'IpAdress' => request()->ip(),
        'isActive' => 1,
        'status' => 1,
        'role' => 0 // mặc định user
    ]);
}


    // ========================
    // Get user by email
    // ========================

public function getUserByEmail($email)
{
    return DB::table($this->table)
        ->where('email', $email)
        ->first();
}

    // ========================
    // Save reset token
    // ========================

    public function saveResetToken($email,$token)
    {
        return DB::table($this->table)
            ->where('email',$email)
            ->update([
                'reset_token'=>$token
            ]);
    }


    // ========================
    // Find user by reset token
    // ========================

    public function getUserByToken($token)
    {
        return DB::table($this->table)
            ->where('reset_token', $token)
            ->first();
    }



    // ========================
    // Update password
    // ========================

    public function updatePassword($token, $password)
    {
        return DB::table($this->table)
            ->where('reset_token', $token)
            ->update([
                'password' => Hash::make($password),
                'reset_token' => null
            ]);
    }



    // ========================
    // Update login IP
    // ========================

    public function updateLoginIp($userid)
    {
        return DB::table($this->table)
            ->where('userid', $userid)
            ->update([
                'IpAdress' => request()->ip()
            ]);
    }



// ========================
// Check role
// ========================

public function isAdmin($userid)
{
    return DB::table($this->table)
        ->where('userid', $userid)
        ->where('role', 1)
        ->exists();
}
}