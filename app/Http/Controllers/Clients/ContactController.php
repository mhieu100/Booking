<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone_number,
            'email' => $request->email,
            'messageContent' => $request->message
        ];

Mail::raw(
    "Tên: {$request->name}\n".
    "SĐT: {$request->phone_number}\n".
    "Email: {$request->email}\n".
    "Nội dung: {$request->message}",
    function ($mail) {
        $mail->to('vuongvanbui20@gmail.com')
             ->subject('Liên hệ từ website GoViet');
    }
);

        return back()->with('success','Gửi liên hệ thành công!');
    }
}