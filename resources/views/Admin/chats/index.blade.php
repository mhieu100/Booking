@extends('adminlte::page')

@section('title', 'Quản lý Hỗ trợ Khách hàng')

@section('content_header')
    <h1><i class="fas fa-comments text-primary"></i> Chat Hỗ Trợ Khách Hàng</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card card-primary card-outline shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Danh sách yêu cầu</h3>
            </div>
            <div class="card-body p-0">
                <ul class="nav nav-pills flex-column" id="user-list">
                    @forelse($chatUsers as $user)
                        <li class="nav-item border-bottom">
                            <a href="#" class="nav-link user-chat-link" data-id="{{ $user->userid }}" data-name="{{ $user->username }}">
                                <i class="fas fa-user-circle text-info mr-2"></i> {{ $user->username }}
                                <span class="float-right text-muted text-sm"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($user->last_activity)->diffForHumans() }}</span>
                            </a>
                        </li>
                    @empty
                        <li class="nav-item p-3 text-center text-muted">Chưa có dữ liệu chat.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card direct-chat direct-chat-primary shadow-sm" id="chat-panel" style="display: none; height: 500px;">
            <div class="card-header">
                <h3 class="card-title">Đang chat với: <strong id="current-chat-name" class="text-primary"></strong></h3>
            </div>
            
            <div class="card-body">
                <div class="direct-chat-messages" id="admin-chat-body" style="height: 380px;">
                    </div>
            </div>
            
            <div class="card-footer">
                <div class="input-group">
                    <input type="hidden" id="current-user-id" value="">
                    <input type="text" id="admin-chat-input" placeholder="Nhập tin nhắn hỗ trợ..." class="form-control" autocomplete="off">
                    <span class="input-group-append">
                        <button type="button" id="admin-send-btn" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Gửi</button>
                    </span>
                </div>
            </div>
        </div>
        
        <div class="card shadow-sm" id="empty-chat-panel" style="height: 500px; display: flex; align-items: center; justify-content: center;">
            <div class="text-center text-muted">
                <i class="fas fa-comment-dots fa-4x mb-3 text-light"></i>
                <h5>Chọn một khách hàng bên trái để bắt đầu trò chuyện</h5>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
<script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.3/dist/echo.iife.js"></script>

<script>
$(document).ready(function() {
    let currentUserid = null;
    let echoChannel = null; // Biến lưu trữ kênh Pusher hiện tại

    // 1. Khởi tạo kết nối Pusher
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '{{ env('PUSHER_APP_KEY') }}', // Lấy key từ file .env
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        forceTLS: true
    });

    // Thiết lập CSRF Token cho AJAX POST
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    // Hàm cuộn xuống cuối
function scrollToBottom() {
    let chatBody = $('#admin-chat-body');
    chatBody[0].scrollTop = chatBody[0].scrollHeight;
}
    // Hàm render 1 bong bóng chat (Tái sử dụng cho cả load cũ và nhận mới)
    function renderMessage(msg, isUser, isBot) {
        let senderName = isUser ? 'Khách hàng' : (isBot ? 'Bot AI' : 'Admin');
        let bgClass = isUser ? 'bg-light' : (isBot ? 'bg-warning' : 'bg-primary');
        let alignment = isUser ? '' : 'right';
        let floatName = isUser ? 'float-left' : 'float-right';
        let floatTime = isUser ? 'float-right' : 'float-left';
        let avatar = isUser ? 'avatar.png' : 'avatar5.png'; // Bạn có thể thêm icon cho Bot nếu muốn

        // Chống XSS (Mã hóa HTML)
        let textSafe = $('<div>').text(msg.message).html().replace(/\n/g, '<br>');

        return `
        <div class="direct-chat-msg ${alignment}">
            <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name ${floatName}">${senderName}</span>
                <span class="direct-chat-timestamp ${floatTime}">${msg.createdat}</span>
            </div>
            <img class="direct-chat-img" src="{{ asset('vendor/adminlte/dist/img/') }}/${avatar}" alt="Avatar">
            <div class="direct-chat-text ${bgClass}">${textSafe}</div>
        </div>`;
    }

    // Hàm load tin nhắn từ server khi mới click vào tên khách hàng
    function loadMessages(userid) {
        $.get("{{ url('/admin/chats/fetch') }}/" + userid, function(res) {
            if(res.status === 'success') {
                $('#admin-chat-body').empty();
                
                let allHtml = ''; // Nối chuỗi để chèn vào 1 lần cho mượt
                res.messages.forEach(function(msg) {
                    let isUser = msg.adminid == 0;
                    let isBot = msg.adminid == 999;
                    allHtml += renderMessage(msg, isUser, isBot);
                });
                
                $('#admin-chat-body').append(allHtml);
                scrollToBottom();
            }
        });
    }

    // Xử lý khi click vào 1 user bên danh sách
    $('.user-chat-link').click(function(e) {
        e.preventDefault();
        
        $('.user-chat-link').removeClass('active bg-light border-primary');
        $(this).addClass('active bg-light border-primary');

        $('#empty-chat-panel').hide();
        $('#chat-panel').show();

        // Lấy thông tin user
        currentUserid = $(this).data('id');
        let userName = $(this).data('name');
        
        $('#current-user-id').val(currentUserid);
        $('#current-chat-name').text(userName);

        // Load tin nhắn lịch sử
        loadMessages(currentUserid);

        // --- PUSHER: RỜI PHÒNG CŨ, VÀO PHÒNG MỚI ---
        if (echoChannel) {
    window.Echo.leave(echoChannel);
    window.Echo.stopListening('.new-message');
    echoChannel = null;
}
        
        echoChannel = 'chat-room.' + currentUserid;
        window.Echo.channel(echoChannel)
            .listen('.new-message', (data) => {
                 console.log('RECEIVED:', data); 
                // Nhận được tin nhắn -> in ngay ra màn hình
                let isUser = data.senderClass === 'msg-user';
                let isBot = data.senderClass === 'msg-bot';
                
                // Giả lập định dạng msg cho hàm render
                let simulatedMsg = {
                    message: data.message,
                    createdat: new Date().toLocaleTimeString(), // Giờ hiện tại
                    adminid: isUser ? 0 : (isBot ? 999 : 1)
                };

                $('#admin-chat-body').append(renderMessage(simulatedMsg, isUser, isBot));
                scrollToBottom();
            });
    });

    // Xử lý gửi tin nhắn của Admin
    function sendAdminMessage() {
    let text = $('#admin-chat-input').val().trim();
    let userid = $('#current-user-id').val();
    
    if(text === '' || !userid) return;

    // Xóa input
    $('#admin-chat-input').val('').focus();

    // Hiển thị ngay tin nhắn admin
    let simulatedMsg = {
        message: text,
        createdat: new Date().toLocaleTimeString(),
        adminid: 1
    };

    
    scrollToBottom();

    // Gửi lên server
    $.post("{{ url('/admin/chats/send') }}", { userid: userid, message: text }, function(res) {
        if(res.status !== 'success') {
            alert('Lỗi: ' + res.message);
        }
    }).fail(function() {
        alert('Lỗi đường truyền! Vui lòng thử lại.');
    });
}

    $('#admin-send-btn').click(function() { sendAdminMessage(); });
    $('#admin-chat-input').keypress(function(e) {
        if(e.which == 13) sendAdminMessage();
    });

});
</script>
@stop