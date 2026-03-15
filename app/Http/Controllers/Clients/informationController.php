<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Clients\Login;
use Illuminate\Support\Facades\Hash;
use App\Models\Booking;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;

class informationController extends Controller
{
    // hiển thị trang profile
public function index()
{
    $title = "Thông tin tài khoản";
    $user = Session::get('user');

    if(!$user){
        return redirect('/login');
    }

    // Lấy lịch sử đặt tour
    $bookings = Booking::where('userid',$user->userid)
                ->orderBy('bookingdate','desc')
                ->get();

    return view('Clients.infor', compact('title','user','bookings'));
}

    // cập nhật thông tin
    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
        ]);

        $user = Session::get('user');

        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'address' => $request->address
        ];

        Login::where('userid',$user->userid)->update($data);

        // cập nhật session
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phoneNumber = $request->phoneNumber;
        $user->address = $request->address;

        Session::put('user',$user);

        return back()->with('success','Cập nhật thông tin thành công');
    }

    public function changePassword(Request $request)
{
    $user = Session::get('user');

    $dbUser = Login::where('userid',$user->userid)->first();

    if(!Hash::check($request->old_password,$dbUser->password)){
        return back()->with('error','Mật khẩu hiện tại không đúng');
    }

    if($request->new_password != $request->confirm_password){
        return back()->with('error','Xác nhận mật khẩu không khớp');
    }

    Login::where('userid',$user->userid)->update([
        'password' => Hash::make($request->new_password)
    ]);

    return back()->with('success','Đổi mật khẩu thành công');
}
public function uploadAvatar(Request $request)
{
    $user = Session::get('user');

    if($request->hasFile('avatar'))
    {
        $file = $request->file('avatar');

        $name = time().'.'.$file->getClientOriginalExtension();

        $file->move(public_path('clients/assets/images/avatars'), $name);

        Login::where('userid',$user->userid)->update([
            'avatar' => $name
        ]);

        $user->avatar = $name;
        Session::put('user',$user);

        return back()->with('success','Upload ảnh thành công');
    }

    return back()->with('error','Vui lòng chọn ảnh');
}

}