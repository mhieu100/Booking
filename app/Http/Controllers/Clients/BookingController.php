<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{

    // Trang đặt tour
    public function index($id)
    {

        if(!session()->has('userid')){
            return redirect('/login')
            ->with('error','Vui lòng đăng nhập để đặt tour');
        }

        $title = "Đặt Tour";

        $tour = DB::table('tbl_tours')
        ->where('tourid',$id)
        ->first();

        return view('Clients.Booking',compact('tour','title'));
    }


    // Lưu booking
    public function store(Request $request, $id)
    {

        if(!session()->has('userid')){
            return redirect('/login')
            ->with('error','Vui lòng đăng nhập để đặt tour');
        }

        $adult = $request->numadults;
        $child = $request->numchildren;

        $tour = DB::table('tbl_tours')
        ->where('tourid',$id)
        ->first();

        $total = ($adult * $tour->priceadult) + ($child * $tour->pricechild);

        $info = "Tên: ".$request->username.
                " | Email: ".$request->email.
                " | SĐT: ".$request->tel.
                " | Địa chỉ: ".$request->dia_chi;

        DB::table('tbl_bookings')->insert([

            'tourid'=>$id,
            'userid'=>session('userid'),
            'bookingdate'=>now(),
            'numadults'=>$adult,
            'numchildren'=>$child,
            'totalprice'=>$total,
            'bookingstatus'=>'pending',
            'specialrequest'=>$info

        ]);

        return redirect()->back()->with('success','Đặt tour thành công!');
    }


    // LỊCH SỬ ĐẶT TOUR
    public function history()
    {

        if(!session()->has('userid')){
            return redirect('/login')
            ->with('error','Vui lòng đăng nhập');
        }

        $userid = session('userid');

        $bookings = DB::table('tbl_bookings')
        ->join('tbl_tours','tbl_bookings.tourid','=','tbl_tours.tourid')
        ->where('tbl_bookings.userid',$userid)
        ->select(
            'tbl_bookings.*',
            'tbl_tours.title',
            'tbl_tours.startdate'
        )
        ->orderBy('bookingdate','desc')
        ->get();

        return view('Clients.booking-history',compact('bookings'));

    }


    // HỦY TOUR
    public function cancel($id)
    {

        if(!session()->has('userid')){
            return redirect('/login')
            ->with('error','Vui lòng đăng nhập');
        }

        $userid = session('userid');

        DB::table('tbl_bookings')
        ->where('bookingid',$id)
        ->where('userid',$userid)
        ->update([
            'bookingstatus'=>'cancelled'
        ]);

        // lưu lịch sử
        DB::table('tbl_history')->insert([

            'userid'=>$userid,
            'actionType'=>'Hủy booking ID: '.$id,
            'timestamp'=>now()

        ]);

        return back()->with('success','Đã hủy tour');

    }



    // ĐẶT LẠI TOUR
    public function rebook($id)
    {

        if(!session()->has('userid')){
            return redirect('/login')
            ->with('error','Vui lòng đăng nhập');
        }

        $userid = session('userid');

        $booking = DB::table('tbl_bookings')
        ->where('bookingid',$id)
        ->where('userid',$userid)
        ->first();

        if(!$booking){
            return back()->with('error','Không tìm thấy booking');
        }

        // tạo booking mới
        DB::table('tbl_bookings')->insert([

            'tourid'=>$booking->tourid,
            'userid'=>$userid,
            'bookingdate'=>now(),
            'numadults'=>$booking->numadults,
            'numchildren'=>$booking->numchildren,
            'totalprice'=>$booking->totalprice,
            'bookingstatus'=>'pending',
            'specialrequest'=>$booking->specialrequest

        ]);

        // lưu lịch sử
        DB::table('tbl_history')->insert([

            'userid'=>$userid,
            'actionType'=>'Đặt lại tour ID: '.$booking->tourid,
            'timestamp'=>now()

        ]);

        return back()->with('success','Đặt lại tour thành công');

    }
// Xem chi tiết booking
public function detail($id)
{

    if(!session()->has('userid')){
        return redirect('/login')
        ->with('error','Vui lòng đăng nhập');
    }

    $userid = session('userid');

    $booking = DB::table('tbl_bookings')
    ->join('tbl_tours','tbl_bookings.tourid','=','tbl_tours.tourid')
    ->where('bookingid',$id)
    ->where('tbl_bookings.userid',$userid)
    ->select(
        'tbl_bookings.*',
        'tbl_tours.title',
        'tbl_tours.startdate',
        'tbl_tours.location'
    )
    ->first();

    return view('Clients.booking-detail',compact('booking'));

}
}