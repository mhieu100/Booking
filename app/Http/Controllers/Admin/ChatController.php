<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\ChatMessageSent; // <-- QUAN TRỌNG: Phải import Event vào để sử dụng

class ChatController extends Controller
{
    // ==========================================
    // 1. GIAO DIỆN QUẢN LÝ CHAT
    // ==========================================
    public function index()
    {
        // Lấy danh sách những user đã từng chat, sắp xếp theo tin nhắn mới nhất
        $chatUsers = DB::table('tbl_chat')
            ->join('tbl_users', 'tbl_chat.userid', '=', 'tbl_users.userid')
            ->select('tbl_users.userid', 'tbl_users.username', DB::raw('MAX(tbl_chat.createdat) as last_activity'))
            ->groupBy('tbl_users.userid', 'tbl_users.username')
            ->orderByDesc('last_activity')
            ->get();

        return view('admin.chats.index', compact('chatUsers'));
    }

    // ==========================================
    // 2. TẢI LỊCH SỬ CHAT CỦA 1 USER (DÙNG AJAX)
    // ==========================================
    public function fetchMessages($userid)
    {
        $messages = DB::table('tbl_chat')
            ->where('userid', $userid)
            ->orderBy('createdat', 'asc')
            ->get();

        // Đánh dấu các tin nhắn của user này là đã đọc ('Y')
        DB::table('tbl_chat')
            ->where('userid', $userid)
            ->where('adminid', 0) // Chỉ update tin nhắn của user gửi
            ->update(['isread' => 'Y']);

        return response()->json(['status' => 'success', 'messages' => $messages]);
    }

    // ==========================================
    // 3. ADMIN GỬI TIN NHẮN CHO USER
    // ==========================================
    public function sendMessage(Request $request)
    {
        $userid = $request->input('userid');
        $message = trim($request->input('message'));

        if(empty($message)) {
            return response()->json(['status' => 'error', 'message' => 'Tin nhắn rỗng.']);
        }

        // Lưu tin nhắn vào CSDL với adminid = 1
        DB::table('tbl_chat')->insert([
            'userid' => $userid,
            'message' => $message,
            'isread' => 'Y', // Tin của admin gửi đi mặc định là đã đọc
            'adminid' => 1,  // Có thể đổi thành session('adminid') nếu có hệ thống phân quyền
            'createdat' => now(),
            'ipaddress' => $request->ip()
        ]);

        // PHÁT SÓNG SỰ KIỆN QUA PUSHER
        event(new ChatMessageSent($userid, $message, 'msg-admin'));
        
        return response()->json(['status' => 'success']);
    }
}