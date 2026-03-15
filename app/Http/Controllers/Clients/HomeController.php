<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Đổi từ Home sang gọi thẳng Model Tours chúng ta vừa làm
use App\Models\Clients\Tours; 

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

        return view('Clients.home', compact('title', 'tours'));
    }
}