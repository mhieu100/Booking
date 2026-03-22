<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    // Khai báo các cột được phép thêm dữ liệu
    protected $fillable = [
        'category_name', 
        'title', 
        'slug', 
        'image', 
        'description', 
        'content', 
        'is_active',
        'views'
    ];
}