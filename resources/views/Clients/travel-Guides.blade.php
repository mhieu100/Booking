@include('Clients.blocks.header')
@include('Clients.blocks.banner_home')

<section class="benefit-area mt-100 rel z-1">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-6">
                <div class="benefit-image-part style-two mb-55">
                    <div class="image-one" data-aos="fade-right" data-aos-duration="1500">
                        <img src="{{ asset('clients/assets/images/benefit/benefit1.png') }}" alt="Lợi ích">
                    </div>
                    <div class="image-two" data-aos="fade-down" data-aos-delay="50" data-aos-duration="1500">
                        <img src="{{ asset('clients/assets/images/benefit/benefit2.png') }}" alt="Lợi ích">
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-6">
                <div class="mobile-app-content" data-aos="fade-left" data-aos-duration="1500">
                    <div class="section-title counter-text-wrap mb-40">
                        <h2>Cẩm Nang Khám Phá Tuyệt Đỉnh – Hướng Dẫn Hành Trình Trọn Vẹn</h2>
                    </div>
                    <p>Chúng tôi đồng hành cùng bạn để thấu hiểu mọi mong muốn, từ đó đưa ra những giải pháp du lịch tùy chỉnh nhằm tối ưu hóa trải nghiệm, mang lại sự hài lòng và những kỷ niệm bền vững.</p>
                    
                    <div class="skillbar mt-80" data-percent="93">
                        <span class="skillbar-title">Mức Độ Hài Lòng Của Khách Hàng</span>
                        <div class="progress-bar-striped skillbar-bar progress-bar-animated" role="progressbar" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                        <span class="skill-bar-percent"></span>
                    </div>

                    <ul class="list-style-two mt-35 mb-30">
                        <li>Đại lý du lịch giàu kinh nghiệm</li>
                        <li>Đội ngũ hướng dẫn viên chuyên nghiệp</li>
                        <li>Hỗ trợ khách hàng 24/7</li>
                    </ul>
                    
                    <a href="{{ route('about') }}" class="theme-btn style-two">
                        <span data-hover="Xem Hướng Dẫn">Xem Hướng Dẫn</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-team-area pt-100 rel z-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-title text-center counter-text-wrap mb-50" data-aos="fade-up" data-aos-duration="1500">
                    <h2>Gặp Gỡ Đội Ngũ Hướng Dẫn Viên</h2>
                    <p>Đồng hành cùng hơn <span class="count-text plus bgc-primary" data-speed="3000" data-stop="150">0</span> chuyên gia bản địa</p>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center">
            @php
                // Dữ liệu mẫu với tên file ảnh chuẩn
                $dummyTeam = [
                    ['name' => 'Nguyễn Văn Hùng', 'role' => 'Chuyên Gia Tour Leo Núi', 'img' => 'guide1.jpg'],
                    ['name' => 'Lê Thị Mai', 'role' => 'Hướng Dẫn Viên Văn Hóa', 'img' => 'guide2.jpg'],
                    ['name' => 'Trần Hoàng Nam', 'role' => 'Chuyên Gia Ẩm Thực', 'img' => 'guide3.jpg'],
                    ['name' => 'Phạm Minh Đức', 'role' => 'Hướng Dẫn Viên Xuyên Việt', 'img' => 'guide4.jpg'],
                ];
            @endphp

            @foreach($dummyTeam as $index => $member)
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="team-item hover-content" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}" data-aos-duration="1500">
                    <div class="image">
                        {{-- Sửa lỗi đường dẫn: trỏ thẳng vào clients/assets/images/team/ --}}
                        <img src="{{ asset('clients/assets/images/team/' . $member['img']) }}" alt="{{ $member['name'] }}">
                    </div>
                    <div class="content">
                        <h6>{{ $member['name'] }}</h6>
                        <span class="designation">{{ $member['role'] }}</span>
                        <div class="social-style-one inner-content">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="col-lg-12 text-center mt-20">
                <a href="#" class="theme-btn style-three">
                    <span data-hover="Xem Tất Cả Đội Ngũ">Xem Tất Cả Đội Ngũ</span>
                    <i class="fal fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="testimonials-area py-100 rel z-1">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="testimonial-left-content rmb-50" data-aos="fade-right" data-aos-duration="1500">
                    <img src="{{ asset('clients/assets/images/testimonials/testimonial-left2.png') }}" alt="Đánh giá">
                    <div class="happy-customer text-white bgc-black">
                        <hr>
                        <p>Đánh giá tích cực</p>
                        <div class="ratting">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="testimonial-right-content" data-aos="fade-left" data-aos-duration="1500">
                    <div class="section-title mb-55">
                        <h2>Hơn <span>5280</span> Khách Hàng Nói Gì</h2>
                    </div>
                    <div class="testimonials-active">
                        <div class="testimonial-item">
                            <div class="testi-header">
                                <div class="quote"><i class="flaticon-double-quotes"></i></div>
                                <h4>Dịch Vụ Chất Lượng</h4>
                                <div class="ratting">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                            </div>
                            <div class="text">"Chuyến đi của chúng tôi thực sự hoàn hảo nhờ công ty du lịch này! Họ chăm chút từng chi tiết nhỏ, từ chỗ ở đến các trải nghiệm thực tế tuyệt vời."</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="newsletter-three bgc-primary py-100 rel z-1" style="background-image: url({{ asset('clients/assets/images/newsletter/newsletter-bg-lines.png') }});">
    <div class="container container-1500">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="newsletter-content-part text-white rmb-55" data-aos="zoom-in-right" data-aos-duration="1500">
                    <div class="section-title counter-text-wrap mb-45">
                        <h2>Đăng Ký Nhận Tin Để Nhận Ưu Đãi</h2>
                        <p>Cùng <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> khách hàng cập nhật xu hướng</p>
                    </div>
                    <form class="newsletter-form mb-15" action="#">
                        <input id="news-email" type="email" placeholder="Địa chỉ Email của bạn" required>
                        <button type="submit" class="theme-btn bgc-secondary style-two">
                            <span data-hover="Đăng ký ngay">Đăng ký ngay</span>
                            <i class="fal fa-arrow-right"></i>
                        </button>
                    </form>
                </div>
                <div class="newsletter-bg-image" data-aos="zoom-in-up" data-aos-duration="1500">
                    <img src="{{ asset('clients/assets/images/newsletter/newsletter-bg-image.png') }}" alt="Bản tin">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="newsletter-image-part bgs-cover" style="background-image: url({{ asset('clients/assets/images/newsletter/newsletter-two-right.jpg') }}); min-height: 400px;" data-aos="fade-left" data-aos-duration="1500"></div>
            </div>
        </div>
    </div>
</section>

@include('Clients.blocks.footer')