<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class Home extends Model
{
    use HasFactory;

    protected $table = 'tbl_tours';

    public function getHomeTours(): Collection
    {
        // Lấy thông tin tour
        $tours = DB::table($this->table)
                    ->get();

        foreach ($tours as $tour) {

            // Lấy danh sách hình ảnh thuộc về tour
            $tour->images = DB::table('tbl_images')
                                ->where('tourid', $tour->tourid)
                                ->pluck('imageUrl');


        }

        return $tours;
    }
}