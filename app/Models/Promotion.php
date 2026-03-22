<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    // Chỉ định chính xác tên bảng trong Database
    protected $table = 'tbl_promotion';

    // Chỉ định khóa chính của bảng (Mặc định Laravel tìm cột 'id', nên ta phải khai báo lại)
    protected $primaryKey = 'promotionid';

    // Bảng này không có 2 cột created_at và updated_at nên ta phải tắt nó đi để tránh lỗi
    public $timestamps = false; 

    // Các cột được phép thêm/sửa dữ liệu (Mass Assignment)
    protected $fillable = [
        'code',
        'discount_percent',
        'startdate',
        'enddate',
        'quantity'
    ];
}