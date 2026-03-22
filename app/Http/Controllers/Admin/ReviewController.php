<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clients\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Hiển thị danh sách đánh giá
    public function index()
    {
        // Lấy danh sách review, kèm theo thông tin user và tour, phân trang 10 dòng/trang
        $reviews = Review::with(['user', 'tour'])
                         ->orderBy('createdat', 'desc')
                         ->paginate(10);
                         
        return view('admin.reviews.index', compact('reviews'));
    }

    // Xóa đánh giá (nếu có bình luận bậy bạ/spam)
// Đổi trạng thái Ẩn / Hiện
    public function toggleStatus($id)
    {
        $review = Review::findOrFail($id);
        $review->status = $review->status == 1 ? 0 : 1; // Đảo ngược trạng thái
        $review->save();
        
        return back()->with('success', 'Đã cập nhật trạng thái hiển thị của đánh giá!');
    }

    // Lưu câu trả lời của Admin
    public function reply(Request $request, $id)
    {
        $request->validate(['admin_reply' => 'required']);
        
        $review = Review::findOrFail($id);
        $review->admin_reply = $request->admin_reply;
        $review->save();

        return back()->with('success', 'Đã phản hồi đánh giá thành công!');
    }
}