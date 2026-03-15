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
    </style>

    {{-- ================= HTML FOOTER ================= --}}
    <footer class="custom-footer" style="background-image: url('{{ asset('clients/assets/images/backgrounds/footer.jpg') }}');">
        <div class="footer-content-wrapper container">
            
            <div class="newsletter-premium" data-aos="fade-up" data-aos-duration="1000">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <div class="section-title counter-text-wrap">
                            <h2 class="text-white mb-1">Đăng Ký Bản Tin</h2>
                            <p class="mb-0">Hơn <span class="count-text plus text-warning fw-bold" data-speed="3000" data-stop="34500">0</span> trải nghiệm du lịch tuyệt vời đang chờ đón bạn!</p>
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
                            <p>Chúng tôi thiết kế những hành trình riêng biệt phù hợp với sở thích của bạn, đảm bảo mỗi chuyến đi đều trọn vẹn và đáng nhớ nhất.</p>
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
                                <li><a href="destination-details.html">Hướng Dẫn Viên</a></li>
                                <li><a href="destination-details.html">Đặt Tour Du Lịch</a></li>
                                <li><a href="destination-details.html">Đặt Khách Sạn</a></li>
                                <li><a href="destination-details.html">Đặt Vé Máy Bay</a></li>
                                <li><a href="destination-details.html">Dịch Vụ Cho Thuê</a></li>
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
                            <ul class="list-unstyled">
                                <li><i class="fal fa-map-marked-alt"></i> <span>123 Đường Lê Lợi, TP. Đà Nẵng, Việt Nam</span></li>
                                <li><i class="fal fa-envelope"></i> <a href="mailto:support@goviet.com">support@goviet.com</a></li>
                                <li><i class="fal fa-clock"></i> <span>Thứ 2 - Thứ 6: 08:00 AM - 05:00 PM</span></li>
                                <li><i class="fal fa-phone-volume"></i> <a href="callto:+84123456789" class="fw-bold fs-5 text-warning">+84 (123) 456 789</a></li>
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
                        <p class="mb-0">© 2026 Bản quyền thuộc về <a href="{{ route('home') }}" class="text-warning fw-bold">Go Viet</a>. All rights reserved.</p>
                    </div>
                    <div class="col-lg-6 text-center text-lg-end">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item"><a href="{{ route('about') }}" class="text-light">Điều khoản</a></li>
                            <li class="list-inline-item ms-3"><a href="{{ route('about') }}" class="text-light">Chính sách bảo mật</a></li>
                            <li class="list-inline-item ms-3"><a href="{{ route('about') }}" class="text-light">Hỗ trợ</a></li>
                        </ul>
                    </div>
                </div>
                <button class="scroll-top scroll-to-target bgc-secondary text-white" data-target="html" style="border: none; border-radius: 5px; padding: 10px 15px; right: 20px; bottom: 20px;"><i class="fal fa-angle-double-up"></i></button>
            </div>
        </div>
    </footer>
    </div> <script src="{{ asset('clients/assets/js/jquery-3.6.0.min.js') }}"></script>
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
    
</body>
</html>