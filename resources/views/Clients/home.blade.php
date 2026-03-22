@include('Clients.blocks.header_home')
@include('Clients.blocks.banner_home')

<section class="destinations-area bgc-black pt-100 pb-70 rel z-1">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-title text-white text-center counter-text-wrap mb-70" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <h2>Khám Phá Những Kho Báu Thế Giới Cùng GOVIET</h2>
                    <p>Hơn <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> trải nghiệm phổ biến nhất mà bạn sẽ nhớ mãi</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
    @foreach($tours as $tour)
        @php
            // Xử lý ảnh (Code gốc của bạn)
            $imageName = 'default.jpg';
            if (!empty($tour->images)) {
                $decoded = json_decode($tour->images, true);
                if (is_array($decoded) && count($decoded) > 0) {
                    $imageName = $decoded[0];
                } else {
                    $imageName = str_replace(['"', '[', ']', '\\'], '', $tour->images);
                }
            }

            // Xử lý kiểm tra trạng thái tour
            $isPast = \Carbon\Carbon::parse($tour->startdate)->endOfDay()->isPast();
            $isFull = $tour->quantity <= 0;
            $isClosed = $tour->availability == 0;
            $isUnavailable = $isPast || $isFull || $isClosed;
        @endphp
        
        <div class="col-xxl-3 col-xl-4 col-md-6">
            <div class="destination-item block_tours_home" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                
                <div class="image" style="position: relative;">
@if($isPast)
                        <span class="badge bg-secondary" style="position: absolute; bottom: 15px; left: 15px; z-index: 2; padding: 5px 10px; font-weight: normal;">Đã khởi hành</span>
                    @elseif($isFull)
                        <span class="badge bg-danger" style="position: absolute; bottom: 15px; left: 15px; z-index: 2; padding: 5px 10px; font-weight: normal;">Đã hết chỗ</span>
                    @elseif($isClosed)
                        <span class="badge bg-warning text-dark" style="position: absolute; bottom: 15px; left: 15px; z-index: 2; padding: 5px 10px; font-weight: normal;">Tạm ngưng</span>
                    @endif

                    <div class="ratting"><i class="fas fa-star"></i> 4.8</div>
                    <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                    <img src="{{ asset('clients/assets/images/gallery-tours/' . $imageName) }}" alt="{{ $tour->title }}">
                </div>
                
                <div class="content">
                    <span class="location"><i class="fal fa-map-marker-alt"></i> {{ $tour->destination }}</span>
                    <h5><a href="{{ route('tour-detail', ['id' => $tour->tourid]) }}">{{ Str::limit($tour->title, 45) }}</a></h5>
                    <span class="time">{{ $tour->time }}</span>
                </div>
                
                <div class="destination-footer">
                    <span class="price"><span>{{ number_format($tour->priceadult, 0, ',', '.') }}</span> VND/người</span>
                    
                    @if($isUnavailable)
                        <a href="{{ route('tour-detail', ['id' => $tour->tourid]) }}" class="read-more" style="color: #888;">
                            Xem chi tiết <i class="fal fa-info-circle"></i>
                        </a>
                    @else
                        <a href="{{ route('tour-detail', ['id' => $tour->tourid]) }}" class="read-more">
                            Đặt Ngay <i class="fal fa-angle-right"></i>
                        </a>
                    @endif
                </div>
                
            </div>
        </div>
    @endforeach
</div>
    </div>
</section>

<section class="popular-destinations-area pt-100 pb-90 rel z-1">
    <div class="container-fluid">
        <div class="popular-destinations-wrap br-20 bgc-lighter pt-100 pb-70">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section-title text-center counter-text-wrap mb-70" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <h2>Khám Phá Các Điểm Đến Phổ Biến</h2>
                        <p>Trang web duy nhất với hơn <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> trải nghiệm phổ biến nhất</p>
                        <ul class="destinations-nav mt-30">
                            <li data-filter="*" class="active">Tất cả</li>
                            <li data-filter=".features">Nổi bật</li>
                            <li data-filter=".recent">Mới nhất</li>
                            <li data-filter=".city">Thành phố</li>
                            <li data-filter=".rating">Đánh giá</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-3 col-md-6">
                        <div class="destination-item style-two" data-aos="flip-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="image">
                                <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                <img src="{{ asset('clients/assets/images/destinations/destination1.jpg') }}" alt="Điểm đến">
                            </div>
                            <div class="content">
                                <h6><a href="#">Đà Nẵng - Hội An</a></h6>
                                <span class="time">5352+ tour & 856+ Hoạt động</span>
                                <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="features-area pt-100 pb-70 rel z-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-title text-center mb-60">
                    <h2>Tại Sao Chọn GoViet</h2>
                    <p>Những trải nghiệm du lịch tuyệt vời mà chúng tôi mang lại cho bạn</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="feature-card text-center mb-30">
                    <div class="icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <div class="content">
                        <h5>Điểm đến đa dạng</h5>
                        <p>Khám phá hàng trăm địa điểm du lịch nổi tiếng trên khắp Việt Nam.</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="feature-card text-center mb-30">
                    <div class="icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <div class="content">
                        <h5>Giá tốt nhất</h5>
                        <p>Cam kết mức giá hợp lý và minh bạch cho mọi chuyến đi.</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="feature-card text-center mb-30">
                    <div class="icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="content">
                        <h5>Hỗ trợ 24/7</h5>
                        <p>Đội ngũ chăm sóc khách hàng luôn sẵn sàng hỗ trợ bạn.</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="feature-card text-center mb-30">
                    <div class="icon">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <div class="content">
                        <h5>Hướng dẫn viên</h5>
                        <p>Hướng dẫn viên chuyên nghiệp và thân thiện.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="hotel-area bgc-black py-100 rel z-1">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-title text-white text-center counter-text-wrap mb-70" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <h2>Khám Phá Những Tour Cấp Thế Giới</h2>
                    <p>Trang web duy nhất với hơn <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> trải nghiệm phổ biến nhất</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach($tours->take(2) as $tour)
                @php
                    $imageName = 'default.jpg';
                    if (!empty($tour->images)) {
                        $decoded = json_decode($tour->images, true);
                        if (is_array($decoded) && count($decoded) > 0) {
                            $imageName = $decoded[0];
                        } else {
                            $imageName = str_replace(['"', '[', ']', '\\'], '', $tour->images);
                        }
                    }
                @endphp
            <div class="col-xxl-6 col-xl-8 col-lg-10 mb-4">
                <div class="destination-item style-three" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <div class="image">
                        <div class="ratting"><i class="fas fa-star"></i> 4.8</div>
                        <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                        <img src="{{ asset('clients/assets/images/gallery-tours/' . $imageName) }}" alt="{{ $tour->title }}" style="height: 250px; object-fit: cover;">
                    </div>
                    <div class="content">
                        <span class="location"><i class="fal fa-map-marker-alt"></i>{{ $tour->destination }}</span>
                        <h5>
                            <a href="{{ route('tour-detail',['id'=>$tour->tourid]) }}">
                                {{ $tour->title }}
                            </a>
                        </h5>
                        <ul class="list-style-one">
                            <li><i class="fal fa-clock"></i> {{ $tour->duration }}</li>
                            <li><i class="fal fa-users"></i> {{ $tour->quantity }} người</li>
                            <li><i class="fal fa-calendar"></i> {{ \Carbon\Carbon::parse($tour->startdate)->format('d/m/Y') }}</li>
                        </ul>
                        <div class="destination-footer">
                            <span class="price"><span>{{ number_format($tour->priceadult, 0, ',', '.') }} VND</span>/Người</span>
                            <a href="{{ route('tour-detail',['id'=>$tour->tourid]) }}" class="read-more">
                                Xem chi tiết <i class="fal fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="hotel-more-btn text-center mt-40">
            <a href="{{ route('Tours') }}" class="theme-btn style-four">
                <span data-hover="Khám phá thêm các tour hấp dẫn">Khám phá thêm các tour hấp dẫn</span>
                <i class="fal fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
         
<section class="mobile-app-area py-100 rel z-1">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="mobile-app-content rmb-55">
                    <div class="section-title mb-30">
                        <h2>Đặt Tour Du Lịch Nhanh Chóng Với GoViet</h2>
                    </div>
                    <div class="text">
                        <p>
                            GoViet giúp bạn dễ dàng tìm kiếm và đặt tour du lịch chỉ trong vài phút. 
                            Khám phá hàng trăm điểm đến hấp dẫn với dịch vụ chuyên nghiệp và giá cả hợp lý.
                        </p>
                    </div>
                    <ul class="list-style-two mt-35 mb-45">
                        <li>Hàng trăm tour du lịch hấp dẫn</li>
                        <li>Đặt tour trực tuyến nhanh chóng</li>
                        <li>Giá cả minh bạch, không phát sinh</li>
                        <li>Hỗ trợ khách hàng 24/7</li>
                    </ul>
                    <a href="{{ route('Tours') }}" class="theme-btn style-three">
                        <span data-hover="Khám phá tour">Khám phá tour ngay</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="mobile-app-images">
                    <div class="bg">
                        <img src="{{ asset('clients/assets/images/mobile-app/phone-bg.png') }}" alt="Background">
                    </div>
                    <div class="images">
                        <img src="{{ asset('clients/assets/images/mobile-app/phone2.png') }}" alt="Mobile View 2">
                        <img src="{{ asset('clients/assets/images/mobile-app/phone.png') }}" alt="Mobile View 1">
                        <img src="{{ asset('clients/assets/images/mobile-app/phone3.png') }}" alt="Mobile View 3">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<section class="premium-testimonials-section py-120 rel z-1 overflow-hidden">
    <div class="bg-shape-gradient"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center mb-60" data-aos="fade-up">
                    <span class="upper-title">Hàng ngàn khách hàng hài lòng</span>
                    <h2 class="display-4 fw-bold">Chia Sẻ Từ Những <span class="text-gradient">Nhà Lữ Hành</span></h2>
                </div>
            </div>
        </div>

        <div class="swiper testimonial-swiper" data-aos="fade-up" data-aos-delay="200">
            <div class="swiper-wrapper">
                @forelse($testimonials as $item)
                <div class="swiper-slide">
                    <div class="premium-testimonial-card">
                        <div class="quote-icon"><i class="fas fa-quote-right"></i></div>
                        
                        <div class="card-header-meta">
                            <div class="stars">
                                @for($i=1; $i<=5; $i++)
                                    <i class="fas fa-star {{ $i <= $item->rating ? 'active' : '' }}"></i>
                                @endfor
                            </div>
                            <span class="verified-tag"><i class="fas fa-check-circle"></i> Đã trải nghiệm</span>
                        </div>

                        <div class="main-comment">
                            <p>"{{ $item->comment }}"</p>
                        </div>

                        <div class="card-footer-user">
                            <div class="user-avatar">
                                <img src="{{ $item->avatar ? asset('uploads/users/'.$item->avatar) : asset('assets/images/default-user.jpg') }}" alt="{{ $item->username }}">
                            </div>
                            <div class="user-details">
                                <h6 class="name">{{ $item->username }}</h6>
                                <p class="tour-info">{{ $item->tour_name }} — <span class="location">{{ $item->destination }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center">Đang cập nhật đánh giá...</p>
                @endforelse
            </div>
            
            <div class="swiper-pagination mt-40"></div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    new Swiper('.testimonial-swiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: { delay: 4000, disableOnInteraction: false },
        pagination: { el: ".swiper-pagination", clickable: true },
        breakpoints: {
            768: { slidesPerView: 2 },
            1200: { slidesPerView: 3 }
        }
    });
</script>

<section class="cta-area pt-100 rel z-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-duration="1500" data-aos-offset="50">
                <div class="cta-item" style="background-image: url({{ asset('clients/assets/images/cta/cta1.jpg') }});">
                    <span class="category">Cắm trại Lều</span>
                    <h2>Khám phá những điểm du lịch tốt nhất thế giới</h2>
                    <a href="{{ route('Tours') }}" class="theme-btn style-two bgc-secondary">
                        <span data-hover="Khám phá các Tour">Khám phá các Tour </span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
                <div class="cta-item" style="background-image: url({{ asset('clients/assets/images/cta/cta2.jpg') }});">
                    <span class="category">Bãi biển</span>
                    <h2>Những bãi biển đẹp nhất Việt Nam</h2>
                    <a href="{{ route('Tours') }}" class="theme-btn style-two">
                        <span data-hover="Khám phá các Tour">Khám phá các Tour</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="50">
                <div class="cta-item" style="background-image: url({{ asset('clients/assets/images/cta/cta3.jpg') }});">
                    <span class="category">Thác nước Kỳ vĩ</span>
                    <h2>Những thác nước hùng vĩ tại Việt Nam</h2>
                    <a href="{{ route('Tours') }}" class="theme-btn style-two bgc-secondary">
                        <span data-hover="Khám phá các Tour">Khám phá các Tour</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
         
<section class="blog-area py-70 rel z-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-title text-center counter-text-wrap mb-70" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <h2>Đọc Tin Tức & Blog Mới Nhất</h2>
                    <p>Hơn <span class="count-text plus bgc-primary" data-speed="3000" data-stop="34500">0</span> trải nghiệm phổ biến nhất mà bạn sẽ nhớ mãi</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">

@foreach($blogs as $blog)

    <div class="col-xl-4 col-md-6">
        <div class="blog-item" data-aos="fade-up">

            <div class="content">

                {{-- CATEGORY --}}
                <a href="{{ route('blogs', ['category' => $blog->category_name]) }}" class="category">
                    {{ $blog->category_name }}
                </a>

                {{-- TITLE --}}
                <h5>
                    <a href="{{ route('blog.detail', $blog->slug) }}">
                        {{ $blog->title }}
                    </a>
                </h5>

                {{-- META --}}
                <ul class="blog-meta">
                    <li>
                        <i class="far fa-calendar-alt"></i>
                        {{ $blog->created_at->format('d/m/Y') }}
                    </li>

                    <li>
                        <i class="far fa-eye"></i>
                        {{ $blog->views ?? 0 }}
                    </li>
                </ul>

            </div>

            {{-- IMAGE --}}
            <div class="image">
                <img src="{{ asset($blog->image ?? 'clients/assets/images/blog/blog1.jpg') }}">
            </div>

            {{-- BUTTON --}}
            <a href="{{ route('blog.detail', $blog->slug) }}" class="theme-btn">
                <span>Xem thêm</span>
                <i class="fal fa-arrow-right"></i>
            </a>

        </div>
    </div>

@endforeach

</div>
    </div>
</section>

@include('Clients.blocks.footer')