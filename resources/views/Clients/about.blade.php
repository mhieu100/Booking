@include('Clients.blocks.header')
@include('Clients.blocks.banner', ['title' => 'Về Chúng Tôi'])

<section class="about-area py-100 rel z-1">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-image-part" data-aos="fade-right" data-aos-duration="1500">
                    <img src="{{ asset('clients/assets/images/about/about-page.jpg') }}" alt="Về GoViet Travel" class="rounded">
                    {{-- Nếu bạn có ảnh nhỏ trang trí (experience badge), có thể thêm ở đây --}}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content" data-aos="fade-left" data-aos-duration="1500">
                    <div class="section-title mb-25">
                        <span class="sub-title mb-10">Khám Phá GoViet</span>
                        <h2>Hành Trình Chạm Đến Trái Tim Việt Nam</h2>
                    </div>
                    <p>
                        <strong>GoViet Travel</strong> không chỉ là một nền tảng đặt tour trực tuyến, chúng tôi là những người bạn đồng hành bản địa, mang sứ mệnh kết nối du khách với vẻ đẹp bất tận của dải đất hình chữ S.
                    </p>
                    <p>
                        Với tâm niệm "Mỗi chuyến đi là một trải nghiệm đời người", chúng tôi chắt lọc những điểm đến tinh túy nhất, từ những bản làng vùng cao mờ sương đến những hòn đảo hoang sơ ngoài khơi xa, tất cả đều với mức chi phí tối ưu nhất.
                    </p>
                    <ul class="list-style-two mt-20">
                        <li>Hơn 100+ hành trình trải nghiệm độc bản</li>
                        <li>Cam kết giá tốt nhất - Minh bạch mọi chi phí</li>
                        <li>Quy trình đặt tour nhanh gọn trong 60 giây</li>
                        <li>Chăm sóc khách hàng tận tâm 24/7</li>
                    </ul>
                    <a href="#" class="theme-btn style-three mt-30">
                        <span data-hover="Khám Phá Tour Ngay">Xem Các Tour Hot</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-feature-two bgc-light pt-100 pb-70 rel z-1">
    <div class="container">
        <div class="section-title text-center mb-60" data-aos="fade-up" data-aos-duration="1500">
            <h2>Giá Trị Cốt Lõi Của GoViet</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4 col-sm-6">
                <div class="feature-item style-three text-center" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500">
                    <div class="icon"><i class="flaticon-travel"></i></div>
                    <div class="content">
                        <h5>Điểm Đến Đa Dạng</h5>
                        <p>Từ vùng cao Đông Bắc đến vùng sông nước miền Tây, chúng tôi có tất cả.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="feature-item style-three text-center" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1500">
                    <div class="icon"><i class="flaticon-save-money"></i></div>
                    <div class="content">
                        <h5>Tiết Kiệm Tối Đa</h5>
                        <p>Hệ thống đối tác chiến lược giúp GoViet luôn có mức giá ưu đãi nhất thị trường.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="feature-item style-three text-center" data-aos="fade-up" data-aos-delay="150" data-aos-duration="1500">
                    <div class="icon"><i class="flaticon-guidepost"></i></div>
                    <div class="content">
                        <h5>Dịch Vụ Chuyên Nghiệp</h5>
                        <p>Đội ngũ HDV được đào tạo bài bản, am hiểu sâu sắc văn hóa địa phương.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="counter-area py-80 bgc-black text-white rel z-1">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 col-6">
                <div class="counter-item style-two" data-aos="fade-up" data-aos-duration="1500">
                    <span class="count-text plus" data-speed="3000" data-stop="120">0</span>
                    <hr>
                    <p>Tour Hoạt Động</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="counter-item style-two" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1500">
                    <span class="count-text plus" data-speed="3000" data-stop="5000">0</span>
                    <hr>
                    <p>Khách Hàng Tin Dùng</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="counter-item style-two" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1500">
                    <span class="count-text plus" data-speed="3000" data-stop="50">0</span>
                    <hr>
                    <p>Điểm Đến Toàn Quốc</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="counter-item style-two" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1500">
                    <span class="count-text plus" data-speed="3000" data-stop="10">0</span>
                    <hr>
                    <p>Năm Kinh Nghiệm</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-team-area py-100 rel z-1">
    <div class="container">
        <div class="section-title text-center mb-60" data-aos="fade-up" data-aos-duration="1500">
            <h2>Gương Mặt Đồng Hành Cùng Bạn</h2>
        </div>
        <div class="row">
            @php
                $team = [
                    ['name' => 'Nguyễn Văn Hùng', 'role' => 'Chuyên gia Leo Núi', 'img' => 'guide1.jpg'],
                    ['name' => 'Lê Thị Mai', 'role' => 'HDV Văn Hóa', 'img' => 'guide2.jpg'],
                    ['name' => 'Trần Minh Nam', 'role' => 'HDV Ẩm Thực', 'img' => 'guide3.jpg'],
                    ['name' => 'Phạm Quang Đức', 'role' => 'HDV Xuyên Việt', 'img' => 'guide4.jpg'],
                ];
            @endphp
            @foreach($team as $index => $member)
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="team-item hover-content text-center mb-30" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}" data-aos-duration="1500">
                    <div class="image">
                        <img src="{{ asset('clients/assets/images/team/'.$member['img']) }}" alt="{{ $member['name'] }}">
                    </div>
                    <div class="content">
                        <h6>{{ $member['name'] }}</h6>
                        <span class="designation">{{ $member['role'] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="video-area pb-100 rel z-1">
    <div class="container">
        <div class="video-wrap text-center" data-aos="zoom-in" data-aos-duration="1500">
            <img src="{{ asset('clients/assets/images/video/video-bg.jpg') }}" alt="Video Background" class="rounded">
            <a href="https://www.youtube.com/watch?v=9Y7ma241N8k" class="mfp-iframe video-play">
                <i class="fas fa-play"></i>
            </a>
        </div>
    </div>
</section>

<div class="client-logo-area mb-100 rel z-1">
    <div class="container text-center">
        <div class="section-title mb-40">
            <h6>Đồng hành cùng GoViet Travel</h6>
        </div>
        <div class="row align-items-center">
            @for($i=1; $i<=4; $i++)
            <div class="col-md-3 col-6">
                <div class="client-logo-item" data-aos="fade-in" data-aos-delay="{{ $i * 100 }}">
                    <img src="{{ asset('clients/assets/images/checkout/momo.png') }}" alt="Đối tác">
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>

@include('Clients.blocks.footer')