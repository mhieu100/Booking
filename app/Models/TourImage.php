<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Clients\Tours; // Import Model Tour

class TourImage extends Model
{
    protected $table = 'tbl_images';
    protected $primaryKey = 'imageid';
    public $timestamps = false;

    protected $fillable = [
        'tourid', 
        'imageurl', 
        'description', 
        'uploadDate'
    ];

    /**
     * Quan hệ ngược lại: Một ảnh chi tiết thuộc về một Tour
     */
    public function tour()
    {
        return $this->belongsTo(Tours::class, 'tourid', 'tourid');
    }
}