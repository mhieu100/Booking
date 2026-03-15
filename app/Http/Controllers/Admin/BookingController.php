<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\History;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Hiển thị danh sách tất cả booking
public function index(Request $request)
    {
        // Khởi tạo query ban đầu với Eager Loading
        $query = Booking::with(['user', 'tour']);

        // 1. Lọc theo từ khóa (ID, Tên user, Tên tour)
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('bookingid', $keyword)
                  ->orWhereHas('user', function($u) use ($keyword) {
                      $u->where('username', 'like', '%' . $keyword . '%')
                        ->orWhere('email', 'like', '%' . $keyword . '%');
                  })
                  ->orWhereHas('tour', function($t) use ($keyword) {
                      $t->where('title', 'like', '%' . $keyword . '%');
                  });
            });
        }

        // 2. Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('bookingstatus', $request->status);
        }

        // 3. Lọc theo ngày đặt
        if ($request->filled('date')) {
            $query->whereDate('bookingdate', $request->date);
        }

        // Thực thi query, sắp xếp mới nhất lên đầu và phân trang
        $bookings = $query->orderBy('bookingid', 'desc')->paginate(15);

        return view('admin.bookings.index', compact('bookings'));
    }
    // Xem chi tiết một booking
    public function show($id)
    {
        $booking = Booking::with(['user', 'tour'])->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    // Cập nhật trạng thái booking (Duyệt / Hủy)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'bookingstatus' => 'required|in:pending,confirmed,cancelled'
        ]);

        $booking = Booking::findOrFail($id);
        $oldStatus = $booking->bookingstatus;
        $newStatus = $request->bookingstatus;

        // Cập nhật trạng thái
        $booking->bookingstatus = $newStatus;
        $booking->save();

        // Ghi lại lịch sử hệ thống vào bảng tbl_history
        $actionText = '';
        if ($newStatus == 'confirmed') {
            $actionText = "Admin duyệt booking ID: " . $booking->bookingid;
        } elseif ($newStatus == 'cancelled') {
            $actionText = "Admin hủy booking ID: " . $booking->bookingid;
        } else {
            $actionText = "Admin chuyển booking ID: " . $booking->bookingid . " về chờ xử lý";
        }

        // Lưu lịch sử (Giả sử bạn lấy ID admin đang đăng nhập, nếu không có auth thì tạm để mặc định)
        $adminId = Auth::check() ? Auth::user()->userid : 3; // Lấy tạm ID 3 theo data test của bạn
        
        $history = new History();
        $history->userid = $adminId; 
        $history->actionType = $actionText;
        $history->save();

        return redirect()->route('admin.bookings.show', $id)->with('success', 'Đã cập nhật trạng thái thành công!');
    }
}