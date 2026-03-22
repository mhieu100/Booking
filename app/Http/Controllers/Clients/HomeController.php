<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Đổi từ Home sang gọi thẳng Model Tours chúng ta vừa làm
use App\Models\Clients\Tours; 
use App\Models\Clients\Blog;
use Illuminate\Support\Facades\DB; // Thêm thư viện DB để truy vấn bảng reviews
class HomeController extends Controller
{
    public function index()
    {
        $title = 'Trang chủ';
        
        // Gọi thẳng Model Tours, lấy các tour đang mở bán (availability = 1)
        // Sắp xếp mới nhất lên đầu và lấy ra 8 tour để hiển thị
        $tours = Tours::where('availability', 1)
                      ->orderBy('tourid', 'desc')
                      ->take(8)
                      ->get();
        $blogs = Blog::where('is_active', 1)
        ->latest()
        ->take(3) // lấy 3 bài mới
        ->get();
$testimonials = DB::table('tbl_reviews')
        ->join('tbl_users', 'tbl_reviews.userid', '=', 'tbl_users.userid')
        ->join('tbl_tours', 'tbl_reviews.tourid', '=', 'tbl_tours.tourid')
        ->where('tbl_reviews.status', 1)
        ->select('tbl_reviews.*', 'tbl_users.username', 'tbl_users.avatar', 'tbl_tours.title as tour_name', 'tbl_tours.destination')
        ->orderBy('tbl_reviews.rating', 'desc') // Ưu tiên các đánh giá 5 sao lên đầu
        ->limit(8)
        ->get();
        return view('Clients.home', compact('title', 'tours', 'blogs', 'testimonials'));
    }
    
}