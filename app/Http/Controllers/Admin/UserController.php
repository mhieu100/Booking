<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    
    public function __construct()
{
    if(session('role') != 1){
        abort(403,'Bạn không có quyền truy cập');
    }
}

// danh sách user
public function index()
{
    $users = DB::table('tbl_users')->get();

    return view('admin.users.index',compact('users'));
}



// khóa user
public function block($id)
{
    DB::table('tbl_users')
    ->where('userid',$id)
    ->update(['status'=>0]);

    return redirect()->back();
}


// mở user
public function active($id)
{
    DB::table('tbl_users')
    ->where('userid',$id)
    ->update(['status'=>1]);

    return redirect()->back();
}


// xóa user
public function delete($id)
{
    DB::table('tbl_users')->where('userid',$id)->delete();

    return redirect()->back();
}

}