<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Thực hiện tìm kiếm trong cơ sở dữ liệu hoặc xử lý logic tìm kiếm
        // Ví dụ: $results = Tour::where('name', 'like', '%' . $query . '%')->get();

        // Trả về kết quả tìm kiếm cho view
        return view('Clients.search', compact('query'));
    }
}
