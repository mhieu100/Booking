<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Gọi Model User vào (Hãy đảm bảo đường dẫn này đúng với Model User của bạn)

class Review extends Model
{
    use HasFactory;

    protected $table = 'tbl_reviews';
    protected $primaryKey = 'reviewid';

    public $timestamps = false;

    protected $fillable = [
        'tourid',
        'userid',
        'rating',
        'comment',
        'createdat',
        'status',       // Thêm dòng này
        'admin_reply'
    ];

    // BỔ SUNG ĐOẠN NÀY ĐỂ KHẮC PHỤC LỖI
    public function user()
    {
        // Liên kết bảng tbl_reviews với bảng users
        // 'userid' là khóa ngoại ở bảng tbl_reviews
        // 'id' là khóa chính ở bảng users
        return $this->belongsTo(User::class, 'userid', 'userid'); 
    }
    public function tour()
    {
        // Liên kết với Model Tours để lấy tên tour
        // 'tourid' thứ 1 là khóa ngoại ở bảng tbl_reviews
        // 'tourid' thứ 2 là khóa chính ở bảng tours
        return $this->belongsTo(\App\Models\clients\Tours::class, 'tourid', 'tourid'); 
    }
}