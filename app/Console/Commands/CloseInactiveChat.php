<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CloseInactiveChat extends Command
{
    protected $signature = 'chat:close-inactive';
    protected $description = 'Tự động đóng chat khi user không hoạt động';

    public function handle()
    {
        // Lấy danh sách user đang chờ admin nhưng không hoạt động 10 phút
        $users = DB::table('tbl_chat')
            ->select('userid')
            ->where('is_waiting_admin', 1)
            ->where('last_activity', '<', now()->subMinutes(10))
            ->groupBy('userid')
            ->get();

        foreach ($users as $user) {

            // Gửi tin nhắn kết thúc
            DB::table('tbl_chat')->insert([
                'userid' => $user->userid,
                'message' => 'Phiên hỗ trợ đã kết thúc do bạn không phản hồi. Nếu cần hỗ trợ, vui lòng nhắn lại.',
                'isread' => 'N',
                'adminid' => 999,
                'is_waiting_admin' => 0,
                'createdat' => now()
            ]);

            // Reset trạng thái
            DB::table('tbl_chat')
                ->where('userid', $user->userid)
                ->update(['is_waiting_admin' => 0]);
        }

        return 0;
    }
}