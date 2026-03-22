<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow; // Dùng Now để phát ngay lập tức
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userid;
    public $message;
    public $senderClass;

    public function __construct($userid, $message, $senderClass)
    {
        $this->userid = $userid;
        $this->message = $message;
        $this->senderClass = $senderClass; // VD: 'msg-bot' hoặc 'msg-admin'
    }

    // Xác định kênh phát sóng (Mỗi user sẽ có một phòng chat riêng)
    public function broadcastOn()
    {
        return new Channel('chat-room.' . $this->userid);
    }

    // Tên của sự kiện để Javascript lắng nghe
    public function broadcastAs()
    {
        return 'new-message';
    }
}