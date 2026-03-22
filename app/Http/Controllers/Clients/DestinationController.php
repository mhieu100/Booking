<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Quan trọng: Phải có dòng này để dùng DB query

class DestinationController extends Controller
{
    /**
     * Hiển thị trang điểm đến
     */
    public function index()
    {
        // 1. Lấy danh sách điểm đến phổ biến dựa trên dữ liệu thật từ tbl_tours
        $popularDestinations = DB::table('tbl_tours')
            ->select('destination', DB::raw('count(*) as total_tours'), DB::raw('MIN(images) as image'))
            ->groupBy('destination')
            ->limit(6)
            ->get();

        // 2. Lấy các tour ưu đãi (ví dụ: lấy các tour còn chỗ và giá rẻ nhất)
        $hotDeals = DB::table('tbl_tours')
            ->where('availability', 1)
            ->orderBy('priceadult', 'asc')
            ->limit(3)
            ->get();

        // 3. Trả về giao diện và truyền dữ liệu đã lấy được
        return view('Clients.Destination', compact('popularDestinations', 'hotDeals'));
    }
}