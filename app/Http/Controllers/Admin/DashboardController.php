<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

public function index()
{

// =============================
// THỐNG KÊ TỔNG
// =============================

$totalBookings = DB::table('tbl_bookings')->count();

$totalUsers = DB::table('tbl_users')
->where('role','user')
->count();

$pendingBookings = DB::table('tbl_bookings')
->where('bookingstatus','pending')
->count();

$totalRevenue = DB::table('tbl_bookings')
->where('bookingstatus','confirmed')
->sum('paid_amount');

// Tính tổng tiền chưa thu của các đơn hàng chưa bị hủy
$totalDebt = DB::table('tbl_bookings')
    ->where('bookingstatus', '!=', 'cancelled')
    ->sum(DB::raw('totalprice - paid_amount'));

// Nhớ truyền 'totalDebt' vào compact() ở cuối hàm.

// =============================
// BIỂU ĐỒ DOANH THU 12 THÁNG
// =============================

$monthlyRevenue = [];
$currentYear = date('Y'); // Thêm lấy năm hiện tại

for($i=1;$i<=12;$i++){

$revenue = DB::table('tbl_bookings')
->whereMonth('bookingdate',$i)
->whereYear('bookingdate', $currentYear) // Lọc thêm theo năm hiện tại
->where('bookingstatus','confirmed')
->sum('paid_amount');

$monthlyRevenue[] = $revenue;

}


// =============================
// BIỂU ĐỒ TRẠNG THÁI BOOKING
// =============================

$statusChart = [

'confirmed'=>DB::table('tbl_bookings')
->where('bookingstatus','confirmed')->count(),

'pending'=>DB::table('tbl_bookings')
->where('bookingstatus','pending')->count(),

'cancelled'=>DB::table('tbl_bookings')
->where('bookingstatus','cancelled')->count(),

];


// =============================
// TOP TOUR BÁN CHẠY
// =============================

$topTours = DB::table('tbl_bookings')

->join('tbl_tours','tbl_bookings.tourid','=','tbl_tours.tourid')

->select(

'tbl_bookings.tourid',

DB::raw('count(*) as total_bookings'),

DB::raw('sum(paid_amount) as total_earned'),

'tbl_tours.title'

)

->where('bookingstatus','confirmed')

->groupBy(

'tbl_bookings.tourid',

'tbl_tours.title'

)

->orderByDesc('total_bookings')

->limit(5)

->get();


// =============================
// TOUR MỚI
// =============================

$recentTours = DB::table('tbl_tours')

->orderByDesc('tourid')

->limit(5)

->get();


// =============================
// BOOKING MỚI
// =============================

$recentBookings = DB::table('tbl_bookings')

->join('tbl_users','tbl_bookings.userid','=','tbl_users.userid')

->join('tbl_tours','tbl_bookings.tourid','=','tbl_tours.tourid')

->select(

'tbl_bookings.*',

'tbl_users.username',

'tbl_tours.title'

)

->orderByDesc('bookingid')

->limit(6)

->get();


// =============================
// LỊCH SỬ HỆ THỐNG
// =============================

$histories = DB::table('tbl_history')

->join('tbl_users','tbl_history.userid','=','tbl_users.userid')

->select(

'tbl_history.*',

'tbl_users.username'

)

->orderByDesc('timestamp')

->limit(8)

->get();


// =============================

return view('admin.dashboard',compact(

'totalBookings',
'totalRevenue',
'totalUsers',
'pendingBookings',
'topTours',
'recentTours',
'recentBookings',
'histories',
'monthlyRevenue',
'statusChart',
'totalDebt'

));

}

}