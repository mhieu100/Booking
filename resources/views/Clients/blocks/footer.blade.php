{{-- ================= CUSTOM FOOTER CSS ================= --}}
<style>
    .custom-footer {
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        position: relative;
        color: #d5d5d5;
        margin-top: 80px; /* Tạo khoảng trống cho khối Newsletter trồi lên */
    }
    
    /* Lớp màng Gradient hiện đại phủ lên ảnh nền */
    .custom-footer::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(135deg, rgba(15, 32, 39, 0.95) 0%, rgba(32, 58, 67, 0.85) 50%, rgba(44, 83, 100, 0.95) 100%);
        z-index: 1;
    }

    .footer-content-wrapper { position: relative; z-index: 2; }

    /* Khối Đăng ký nhận tin nổi bật (Glassmorphism) */
    .newsletter-premium {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 40px 50px;
        transform: translateY(-50px); /* Đẩy trồi lên trên */
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    }

    /* Tinh chỉnh Link Hover */
    .footer-widget.footer-links ul li { margin-bottom: 12px; }
    .footer-widget.footer-links ul li a {
        color: #d5d5d5;
        transition: all 0.3s ease;
        position: relative;
    }
    .footer-widget.footer-links ul li a:hover {
        color: #ffb606; /* Màu cam vàng nổi bật */
        padding-left: 8px;
    }
    .footer-widget.footer-links ul li a::before {
        content: '›';
        position: absolute;
        left: -15px;
        opacity: 0;
        color: #ffb606;
        transition: all 0.3s ease;
    }
    .footer-widget.footer-links ul li a:hover::before {
        left: -10px;
        opacity: 1;
    }

    /* Icon Liên hệ */
    .footer-contact ul li { margin-bottom: 15px; display: flex; align-items: flex-start; }
    .footer-contact ul li i { color: #ffb606; font-size: 18px; margin-right: 15px; margin-top: 5px; }
    .footer-contact ul li a:hover { color: #ffb606; }

    /* ================= CHATBOT CSS - FIX CỐ ĐỊNH LAYOUT ================= */
    #chat-bot-btn {
        position: fixed;
        bottom: 80px;
        right: 20px;
        background-color: #ffb606;
        color: #fff;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        text-align: center;
        line-height: 60px;
        font-size: 24px;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        z-index: 9999;
        transition: 0.3s;
    }
    #chat-bot-btn:hover { background-color: #e0a005; transform: scale(1.05); }

    #chat-bot-box {
        position: fixed;
        bottom: 150px;
        right: 20px;
        width: 350px;
        height: 480px; /* Chiều cao cố định */
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        z-index: 9998;
        display: none; /* Mặc định ẩn, hiện qua JQuery */
        flex-direction: column; /* Quan trọng để cố định footer chat */
        overflow: hidden;
        font-family: inherit;
    }

    .chat-header {
        background: #ffb606;
        color: #fff;
        padding: 15px;
        font-weight: bold;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-shrink: 0;
    }
    .chat-header .close-chat { cursor: pointer; font-size: 18px; }

    .chat-body {
        flex: 1; /* Chiếm hết khoảng trống ở giữa */
        padding: 15px;
        overflow-y: auto; /* Tạo thanh cuộn riêng ở đây */
        background: #f8f9fa;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .msg-bubble {
        max-width: 85%;
        padding: 10px 15px;
        border-radius: 15px;
        font-size: 14px;
        line-height: 1.4;
        word-wrap: break-word;
    }
    .msg-user { background: #ffecb3; color: #333; align-self: flex-end; border-bottom-right-radius: 2px; }
    .msg-bot { background: #fff; color: #333; align-self: flex-start; border: 1px solid #eee; border-bottom-left-radius: 2px; }
    .msg-admin { background: #007bff; color: #fff; align-self: flex-start; border-bottom-left-radius: 2px; }

    .chat-footer-box {
        padding: 10px;
        background: #fff;
        border-top: 1px solid #eee;
        display: flex;
        gap: 10px;
        flex-shrink: 0; /* KHÔNG BAO GIỜ CHO PHÉP FOOTER BỊ CO LẠI HOẶC BIẾN MẤT */
    }
    .chat-footer-box input {
        flex: 1;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 20px;
        outline: none;
        font-size: 14px;
    }
    .chat-footer-box button {
        background: #ffb606;
        color: white;
        border: none;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        cursor: pointer;
        transition: 0.2s;
    }
    .chat-footer-box button:hover { background: #e0a005; }
    .typing-indicator { font-size: 12px; color: #888; align-self: flex-start; display: none; margin: 0 0 10px 15px;}
</style>

{{-- ================= HTML FOOTER ================= --}}
<footer class="custom-footer" style="background-image: url('{{ asset('clients/assets/images/backgrounds/footer.jpg') }}');">
    <div class="footer-content-wrapper container">
        
        <div class="newsletter-premium" data-aos="fade-up" data-aos-duration="1000">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="section-title counter-text-wrap">
                        <h2 class="text-white mb-1">Đăng Ký Bản Tin</h2>
                        <p class="mb-0 text-white">Hơn <span class="count-text plus text-warning fw-bold" data-speed="3000" data-stop="34500">0</span> trải nghiệm du lịch tuyệt vời đang chờ đón bạn!</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form class="newsletter-form d-flex" action="#">
                        <input id="news-email" type="email" placeholder="Nhập địa chỉ Email của bạn..." required class="form-control me-2" style="height: 55px; border-radius: 8px;">
                        <button type="submit" class="theme-btn bgc-secondary style-two" style="height: 55px; border-radius: 8px; min-width: 150px;">
                            <span data-hover="Đăng Ký">Đăng Ký</span>
                            <i class="fal fa-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="widget-area pt-30 pb-45">
            <div class="row justify-content-between">
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="1000">
                    <div class="footer-widget footer-text">
                        <div class="footer-logo mb-3">
                            <a href="{{ route('home') }}"><img src="{{ asset('clients/assets/images/logos/logo.png') }}" alt="Logo Go Viet" style="max-height: 60px;"></a>
                        </div>
                        <p class="text-light">Chúng tôi thiết kế những hành trình riêng biệt phù hợp với sở thích của bạn, đảm bảo mỗi chuyến đi đều trọn vẹn và đáng nhớ nhất.</p>
                        <div class="social-style-one mt-3">
                            <a href="#" class="rounded-circle"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="rounded-circle"><i class="fab fa-youtube"></i></a>
                            <a href="#" class="rounded-circle"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="rounded-circle"><i class="fab fa-tiktok"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
                    <div class="footer-widget footer-links">
                        <h5 class="footer-title text-white mb-3">Dịch Vụ</h5>
                        <ul class="list-unstyled">
                            <li><a href="#">Hướng Dẫn Viên</a></li>
                            <li><a href="#">Đặt Tour Du Lịch</a></li>
                            <li><a href="#">Đặt Khách Sạn</a></li>
                            <li><a href="#">Đặt Vé Máy Bay</a></li>
                            <li><a href="#">Dịch Vụ Cho Thuê</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                    <div class="footer-widget footer-links">
                        <h5 class="footer-title text-white mb-3">Công Ty</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('about') }}">Về Chúng Tôi</a></li>
                            <li><a href="{{ route('blogs') }}">Blog Cộng Đồng</a></li>
                            <li><a href="{{ route('contact') }}">Tuyển Dụng</a></li>
                            <li><a href="{{ route('blogs') }}">Tin Tức</a></li>
                            <li><a href="{{ route('contact') }}">Liên Hệ</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000">
                    <div class="footer-widget footer-contact">
                        <h5 class="footer-title text-white mb-3">Thông Tin Liên Hệ</h5>
                        <ul class="list-unstyled text-light">
                            <li><i class="fal fa-map-marked-alt text-warning"></i> <span>123 Đường Lê Lợi, TP. Đà Nẵng, Việt Nam</span></li>
                            <li><i class="fal fa-envelope text-warning"></i> <a href="mailto:support@goviet.com" class="text-light">support@goviet.com</a></li>
                            <li><i class="fal fa-clock text-warning"></i> <span>Thứ 2 - Thứ 6: 08:00 AM - 05:00 PM</span></li>
                            <li><i class="fal fa-phone-volume text-warning"></i> <a href="callto:+84123456789" class="fw-bold fs-5 text-warning">+84 (123) 456 789</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom border-top border-secondary pt-3 pb-3" style="position: relative; z-index: 2; background: rgba(0,0,0,0.3);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center text-lg-start mb-2 mb-lg-0">
                    <p class="mb-0 text-white">© 2026 Bản quyền thuộc về <a href="{{ route('home') }}" class="text-warning fw-bold">Go Viet</a>. All rights reserved.</p>
                </div>
                <div class="col-lg-6 text-center text-lg-end">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="#" class="text-light">Điều khoản</a></li>
                        <li class="list-inline-item ms-3"><a href="#" class="text-light">Chính sách bảo mật</a></li>
                        <li class="list-inline-item ms-3"><a href="#" class="text-light">Hỗ trợ</a></li>
                    </ul>
                </div>
            </div>
            <button class="scroll-top scroll-to-target bgc-secondary text-white" data-target="html" style="border: none; border-radius: 5px; padding: 10px 15px; right: 20px; bottom: 20px; position: fixed; z-index: 99;"><i class="fal fa-angle-double-up"></i></button>
        </div>
    </div>
</footer>

{{-- ================= CHATBOT HTML ================= --}}
<div id="chat-bot-btn"><i class="fas fa-comments"></i></div>

<div id="chat-bot-box">
    <div class="chat-header">
        <span><i class="fas fa-robot mr-2"></i> Trợ lý GoViet</span>
        <span class="close-chat" id="close-chat-btn"><i class="fas fa-times"></i></span>
    </div>
    <div class="chat-body" id="chat-body">
        <div class="msg-bubble msg-bot">Xin chào! 👋 Mình là trợ lý ảo của GoViet. Mình có thể giúp gì cho bạn?</div>
    </div>
    <div class="typing-indicator" id="chat-typing">Trợ lý đang xử lý...</div>
    <div class="chat-footer-box">
        <input type="text" id="chat-input" placeholder="Nhập tin nhắn..." autocomplete="off">
        <button id="chat-send-btn"><i class="fas fa-paper-plane"></i></button>
    </div>
</div>

{{-- ================= SCRIPTS HỆ THỐNG ================= --}}
<script src="{{ asset('clients/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/appear.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/slick.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/skill.bars.jquery.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/aos.js') }}"></script>
<script src="{{ asset('clients/assets/js/script.js') }}"></script>
<script src="{{ asset('clients/assets/js/custom-js.js') }}"></script>

<script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.3/dist/echo.iife.js"></script>

<script>
$(document).ready(function() {
    // ===== 1. Cấu hình chung & CSRF =====
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': csrfToken } });

    const chatBox = $('#chat-bot-box');
    const chatBody = $('#chat-body');
    const chatInput = $('#chat-input');
    const typingIndicator = $('#chat-typing');
    let isSending = false; // Chống spam click/enter
    let isHistoryLoaded = false; // Kiểm tra đã tải lịch sử chưa

    // Cuộn xuống cuối cùng
    function scrollToBottom() {
    chatBody[0].scrollTop = chatBody[0].scrollHeight;
}

    // Hàm hiển thị tin nhắn lên màn hình (Lọc XSS & xử lý xuống dòng)
    function appendMessage(text, className) {
        if (!text) return;
        let textSafe = $('<div>').text(text).html(); 
        chatBody.append(`
            <div class="msg-bubble ${className}">
                ${textSafe.replace(/\n/g, '<br>')}
            </div>
        `);
        scrollToBottom();
    }

    // ===== 2. Khởi tạo Real-time (Laravel Echo & Pusher) =====
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '9501c7beb77a1a519ef4',
        cluster: 'ap1',
        forceTLS: true
    });

    let currentUserId = "{{ session('userid') }}";

if (!window.chatInitialized) {
    window.chatInitialized = true;

    window.Echo.channel('chat-room.' + currentUserId)
    .listen('.new-message', (data) => {
        if (data.senderClass !== 'msg-user') {
            typingIndicator.hide();
            appendMessage(data.message, data.senderClass);
        }
    });
}

    // ===== 3. Hàm tải lịch sử tin nhắn (Fetch History) =====
    function loadChatHistory() {
        if (isHistoryLoaded) return; // Nếu đã tải rồi thì không tải lại

        $.get("{{ url('/chat/fetch-messages') }}", function(res) {
            if (res.status === 'success') {
                console.log(res);
                chatBody.find('.msg-bubble').not('#chat-typing').remove(); // Xóa các tin nhắn tạm (nếu có)
                res.messages.forEach(msg => {
                    let className = 'msg-bot';
                    if (msg.adminid == 0) className = 'msg-user';
                    else if (msg.adminid != 999) className = 'msg-admin';
                    
                    appendMessage(msg.message, className);
                });
                isHistoryLoaded = true;
                scrollToBottom();
            }
        });
    }

    // ===== 4. Hàm gửi tin nhắn =====
    function sendMessage() {
        let text = chatInput.val().trim();
        if (text === '' || isSending) return;

        isSending = true; // Khóa nút gửi
        chatInput.val('').focus(); // Xóa ô nhập liệu

        // Hiển thị ngay tin nhắn của User (Local append)
        appendMessage(text, 'msg-user');
        
        // Hiển thị hiệu ứng chờ
        typingIndicator.show();
        scrollToBottom();

        // Gửi lên server
        $.post("{{ url('/chat/send') }}", { message: text })
            .done(function(res) {
                // Nếu server trả về reply trực tiếp (không qua Pusher) thì dùng dòng dưới:
                // typingIndicator.hide();
                // appendMessage(res.reply, 'msg-bot');
            })
            .fail(function() {
                typingIndicator.hide();
                appendMessage('Lỗi hệ thống! Vui lòng thử lại sau.', 'msg-bot text-danger');
            })
            .always(function() {
                isSending = false; // Mở khóa nút gửi
            });
    }

    // ===== 5. Đăng ký sự kiện (Event Listeners) =====

    // Click nút gửi
    $('#chat-send-btn').on('click', function(e) {
        e.preventDefault();
        sendMessage();
    });

    // Nhấn Enter để gửi
    $('#chat-input').on('keypress', function(e) {
        if (e.which == 13 && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    // Mở khung chat & Tải lịch sử
    $('#chat-bot-btn').on('click', function(e) {
        e.preventDefault();
        chatBox.fadeToggle(300, function() {
            if ($(this).is(':visible')) {
                $(this).css('display', 'flex');
                loadChatHistory(); // Tải tin nhắn cũ khi vừa mở chat
                scrollToBottom();
            }
        });
    });

    // Đóng khung chat
    $('#close-chat-btn').on('click', function() {
        chatBox.fadeOut(300);
    });
});
</script>