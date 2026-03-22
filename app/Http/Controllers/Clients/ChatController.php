<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gemini\Laravel\Facades\Gemini; // Thư viện Google Gemini AI
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Events\ChatMessageSent;

class ChatController extends Controller
{
    // ==========================================
    // 1. LẤY LỊCH SỬ TIN NHẮN KHI MỞ KHUNG CHAT
    // ==========================================
    public function fetchMessages()
    {
        if (!session()->has('userid')) {
            return response()->json(['status' => 'error', 'message' => 'Vui lòng đăng nhập để chat.']);
        }

        $userid = session('userid');

        // Lấy toàn bộ tin nhắn của user này, sắp xếp cũ đến mới
        $messages = DB::table('tbl_chat')
            ->where('userid', $userid)
            ->orderBy('createdat', 'desc')
            ->limit(50)
          ->get()
->reverse() // Đảo ngược lại để hiển thị đúng thứ tự thời gian
        ->values();
            

        return response()->json(['status' => 'success', 'messages' => $messages]);
    }

    // ==========================================
    // 2. XỬ LÝ GỬI TIN NHẮN (USER -> HỆ THỐNG) - ĐÃ FIX LỖI LẶP BOT & LỖI CÚ PHÁP
    // ==========================================
    // ==========================================
    // 2. XỬ LÝ GỬI TIN NHẮN (USER -> HỆ THỐNG)
    // ==========================================
    public function sendMessage(Request $request)
    {
        if (!session()->has('userid')) {
            return response()->json(['status' => 'error', 'message' => 'Vui lòng đăng nhập để chat.']);
        }

        $userid = session('userid');
        $userMessage = trim($request->input('message'));

        if (empty($userMessage)) {
            return response()->json(['status' => 'error', 'message' => 'Tin nhắn không được để trống.']);
        }

        // Lưu tin nhắn user
        DB::table('tbl_chat')->insert([
            'userid' => $userid,
            'message' => $userMessage,
            'isread' => 'N',
            'adminid' => 0,
            'createdat' => now(),
            'ipaddress' => $request->ip()
        ]);
        event(new ChatMessageSent($userid, $userMessage, 'msg-user'));

        // ==========================================
        // KIỂM TRA TỪ KHÓA: MUỐN GẶP AI?
        // ==========================================
        
        // 1. Kiểm tra từ khóa muốn gọi BOT quay lại
        $botKeywords = ['gặp bot', 'chat với bot', 'thoát admin', 'hủy admin', 'gọi bot', 'bot ơi','bot', 'trợ lý', 'trợ giúp', 'tư vấn tự động'];
        $wantsBot = false;
        foreach ($botKeywords as $word) {
            if (str_contains(mb_strtolower($userMessage), $word)) {
                $wantsBot = true;
                break;
            }
        }

        // 2. Kiểm tra từ khóa muốn gặp ADMIN
        $adminKeywords = ['admin', 'nhân viên', 'người thật', 'tư vấn', 'hỗ trợ', 'gặp người','gặp admin'];
        $wantsAdmin = false;
        foreach ($adminKeywords as $word) {
            if (str_contains(mb_strtolower($userMessage), $word)) {
                $wantsAdmin = true;
                break;
            }
        }

        // ==========================================
        // XÁC ĐỊNH TRẠNG THÁI HIỆN TẠI
        // ==========================================

        // Lấy thời điểm gọi Bot gần nhất
        $lastBotCallTime = DB::table('tbl_chat')
            ->where('userid', $userid)
            ->where(function($query) use ($botKeywords) {
                foreach($botKeywords as $word) {
                    $query->orWhere('message', 'LIKE', '%' . $word . '%');
                }
            })
            ->max('createdat') ?? '2000-01-01 00:00:00';

        // Kiểm tra trạng thái chờ admin (Chỉ tính khi yêu cầu gặp Admin xảy ra SAU khi gọi Bot)
        $isWaitingAdmin = DB::table('tbl_chat')
            ->where('userid', $userid)
            ->where(function($query) {
                $query->where('message', 'LIKE', '%gặp admin%')
                      ->orWhere('message', 'LIKE', '%nhân viên%');
            })
            ->where('createdat', '>', now()->subHours(2))
            ->where('createdat', '>', $lastBotCallTime) // <--- CHỐT CHẶN RESET VỀ BOT
            ->exists();

        $adminJoined = DB::table('tbl_chat')
            ->where('userid', $userid)
            ->whereNotIn('adminid', [0, 999])
            ->where('createdat', '>', now()->subMinutes(30))
            ->where('createdat', '>', $lastBotCallTime) // <--- CHỐT CHẶN RESET VỀ BOT
            ->exists();

        // ==========================================
        // PHẢN HỒI NGAY NẾU ĐỔI CHẾ ĐỘ
        // ==========================================

        if ($wantsBot) {
            $replyMessage = 'Đã ngắt kết nối với Admin. Trợ lý AI GoViet đã quay lại, tôi có thể giúp gì cho bạn?';
            $this->saveBotMessage($userid, $replyMessage);

            return response()->json([
                'status' => 'success',
                'reply' => $replyMessage,
                'sender' => 'bot'
            ]);
        }

        if ($wantsAdmin) {
            $replyMessage = 'Admin sẽ vào hỗ trợ bạn ngay!';
            $this->saveBotMessage($userid, $replyMessage);

            return response()->json([
                'status' => 'success',
                'reply' => $replyMessage,
                'sender' => 'bot'
            ]);
        }

        // Nếu đang trong chế độ Admin (và không có lệnh gọi Bot) → Bot im lặng
        if ($isWaitingAdmin || $adminJoined) {
            return response()->json([
                'status' => 'success',
                'reply' => '',
                'sender' => 'bot'
            ]);
        }
        
        // ================= AI =================
        // ================= AI =================
        try {
            // 1. Lấy thông tin Tour
            $tours = DB::table('tbl_tours')
                ->where('availability', 1)
                ->limit(5)
                ->get();
            $tourInfo = json_encode($tours, JSON_UNESCAPED_UNICODE);

            // 2. LẤY LỊCH SỬ CHAT GẦN NHẤT ĐỂ TẠO NGỮ CẢNH (UX Nâng cao)
            $chatHistory = DB::table('tbl_chat')
                ->where('userid', $userid)
                ->orderBy('createdat', 'desc')
                ->limit(6) // Lấy 6 tin gần nhất (cả bot và user)
                ->get()
                ->reverse();

            $historyText = "";
            foreach ($chatHistory as $msg) {
                $role = ($msg->adminid == 0) ? "Khách" : "Trợ lý";
                // Bỏ qua các tin báo hệ thống "Admin sẽ vào hỗ trợ..."
                if (!str_contains($msg->message, 'Admin sẽ vào')) {
                    $historyText .= "{$role}: {$msg->message}\n";
                }
            }

            // 3. XÂY DỰNG PROMPT THÔNG MINH HƠN
            $prompt = "Bạn là trợ lý du lịch nhiệt tình của GoViet. Nhiệm vụ của bạn là tư vấn dựa trên danh sách Tour hiện có.\n";
            $prompt .= "Danh sách Tours: {$tourInfo}\n\n";
            $prompt .= "Yêu cầu: Trả lời ngắn gọn, thân thiện, xưng 'tôi' và gọi khách là 'bạn'. Sử dụng gạch đầu dòng và in đậm để làm nổi bật thông tin quan trọng.\n\n";
            $prompt .= "LỊCH SỬ TRÒ CHUYỆN GẦN ĐÂY:\n{$historyText}\n\n";
            $prompt .= "CÂU HỎI HIỆN TẠI CỦA KHÁCH: {$userMessage}\nTrả lời:";

            // GỌI API GEMINI
            $response = Http::withoutVerifying()->timeout(15)->post(
                "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . env('GEMINI_API_KEY'),
                [
                    "contents" => [
                        [
                            "parts" => [
                                ["text" => $prompt]
                            ]
                        ]
                    ]
                ]
            );

            $data = $response->json();

            if (isset($data['error'])) {
                 throw new \Exception($data['error']['message']);
            }

            $aiReply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Xin lỗi, tôi chưa rõ ý bạn. Bạn có thể nói rõ hơn được không?';

            // Xóa các dấu markdown thừa (như ```) nếu có để tránh lỗi hiển thị HTML
            $aiReply = str_replace(['```html', '```'], '', $aiReply);

        } catch (\Exception $e) {
            // Log lỗi hệ thống cho Dev kiểm tra
            Log::error("Gemini Error: " . $e->getMessage());
            
            // Trả thông báo thân thiện cho User (UX Nâng cao)
            $aiReply = 'Xin lỗi bạn, hiện tại hệ thống AI của GoViet đang quá tải chút xíu. Bạn chờ một lát rồi thử lại nhé, hoặc gõ "gặp admin" để nhân viên hỗ trợ ngay ạ!'; 
        }

        $this->saveBotMessage($userid, $aiReply);

        return response()->json([
            'status' => 'success',
            'reply' => $aiReply,
            'sender' => 'bot'
        ]);
    } // Kết thúc hàm sendMessage

    // ==========================================
    // HÀM PHỤ: LƯU TIN NHẮN CỦA BOT VÀO DB
    // ==========================================
    private function saveBotMessage($userid, $message, $isAdmin = false)

    {
        $adminid = $isAdmin ? 1 : 999; // 1 là Admin, 999 là Bot
        $senderClass = $isAdmin ? 'msg-admin' : 'msg-bot';
        DB::table('tbl_chat')->insert([
            'userid' => $userid,
            'message' => $message,
            'isread' => 'N',
            'adminid' => $adminid,
            'createdat' => now(),
            'ipaddress' => 'NULL',
             // Hoặc bỏ trống nếu DB cho phép Null
            // 'last_activity' => now() // Cập nhật thời gian hoạt động cuối cùng của cuộc chat
        ]);
        event(new ChatMessageSent($userid, $message, $senderClass));
    }
}