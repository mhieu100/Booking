@include('Clients.blocks.header')
@include('Clients.blocks.banner_search')

{{-- ================= SECTION 1: ĐIỂM ĐẾN PHỔ BIẾN (TỐI ƯU UX) ================= --}}
<section class="popular-destinations-area pt-100 pb-90 rel z-1 bg-white">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-xl-8 col-lg-10">
                <div class="section-title counter-text-wrap mb-50" data-aos="fade-up">
                    <span class="sub-title-premium mb-15">Hành trình mơ ước</span>
                    <h2 class="fw-800">Điểm Đến Xu Hướng 2026</h2>
                    <p class="lead-text">Khám phá <span class="count-text plus text-primary font-weight-bold" data-speed="3000" data-stop="1500">0</span> hành trình độc đáo được tinh tuyển riêng cho bạn.</p>
                    
                    <ul class="destinations-nav-premium mt-40 shadow-lg d-inline-flex p-1">
                        <li data-filter="*" class="active">Tất cả</li>
                        <li data-filter=".north">Miền Bắc</li>
                        <li data-filter=".center">Miền Trung</li>
                        <li data-filter=".south">Miền Nam</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row destinations-active">
            @foreach($popularDestinations as $dest)
            <div class="col-xl-4 col-md-6 mb-30 item {{ $loop->index % 2 == 0 ? 'north' : 'south' }}">
                <div class="destination-premium-card" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="image-wrapper-parallax">
                        {{-- Dùng helper asset và kiểm tra ảnh tồn tại --}}
                        <img loading="lazy" src="{{ $dest->image ? asset('uploads/tours/'.$dest->image) : asset('assets/images/default-tour.jpg') }}" alt="{{ $dest->destination }}">
                        
                        <div class="card-glass-overlay">
                            <div class="top-meta">
                                <span class="badge-premium">{{ $dest->total_tours }} Chuyến đi</span>
                            </div>
                            <div class="bottom-content">
                                <h4><a href="{{ route('Tours', ['search' => $dest->destination]) }}">{{ $dest->destination }}</a></h4>
                                <div class="explore-row">
                                    <span class="small-desc">Khám phá ngay</span>
                                    <a href="{{ route('Tours', ['search' => $dest->destination]) }}" class="circle-btn"><i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= SECTION 2: ƯU ĐÃI ĐỘC QUYỀN (PREMIUM DEALS) ================= --}}
<section class="hot-deals-area pt-100 pb-70 bg-light-gradient rel z-1">
    <div class="container">
        <div class="row align-items-end mb-50">
            <div class="col-lg-7">
                <div class="section-title" data-aos="fade-right">
                    <span class="sub-title-premium mb-10 text-danger">Giá tốt nhất</span>
                    <h2 class="fw-800">Ưu Đãi Đặc Biệt Giờ Chót</h2>
                </div>
            </div>
            <div class="col-lg-5 text-lg-right">
                <a href="{{ route('destination') }}" class="btn-text-link">Xem tất cả ưu đãi <i class="fal fa-long-arrow-right ml-10"></i></a>
            </div>
        </div>

        <div class="row">
            @foreach($hotDeals as $deal)
            <div class="col-lg-4 col-md-6">
                <div class="premium-deal-card mb-40 shadow-hover" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                    <div class="image-box">
                        <div class="promo-badge">Tiết kiệm 20%</div>
                        <img src="{{ $deal->images ? asset('uploads/tours/'.$deal->images) : asset('assets/images/default-tour.jpg') }}" alt="{{ $deal->title }}">
                        <div class="deal-price-floating">
                            <small class="text-muted text-through">{{ number_format($deal->priceadult * 1.2) }}đ</small>
                            <span class="main-price text-primary">{{ number_format($deal->priceadult) }}đ</span>
                        </div>
                    </div>
                    <div class="content-box p-30 bg-white">
                        <div class="meta-tags mb-15">
                            <span class="tag-item"><i class="fal fa-map-marker-alt"></i> {{ $deal->destination }}</span>
                            <span class="tag-item"><i class="fal fa-calendar-check"></i> Mỗi tuần</span>
                        </div>
                        <h5 class="mb-20 title-link"><a href="{{ route('tour-detail', $deal->tourid) }}">{{ $deal->title }}</a></h5>
                        <div class="footer-action pt-20 border-top d-flex justify-content-between align-items-center">
                            <div class="rating-box text-warning small">
                                <i class="fas fa-star"></i> 4.9 <span class="text-muted ml-5">({{ rand(20, 150) }})</span>
                            </div>
                            <a href="{{ route('tour-detail', $deal->tourid) }}" class="btn-action-premium">Chi tiết <i class="fal fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= SECTION 3: NEWSLETTER (PREMIUM DESIGN) ================= --}}
<section class="newsletter-area-premium py-100 bg-dark-modern text-white position-relative">
    <div class="abstract-shape"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 text-center">
                <div class="newsletter-inner" data-aos="zoom-in">
                    <div class="icon-hld mb-30 shadow-lg"><i class="fal fa-envelope-open-text fa-3x text-primary"></i></div>
                    <h2 class="mb-20 fw-800 text-white">Đăng ký nhận cẩm nang du lịch</h2>
                    <p class="mb-40 opacity-7 lead">Cập nhật những ưu đãi ẩn và mẹo du lịch độc quyền chỉ dành cho thành viên của GoViet.</p>
                    
                    <form class="newsletter-form-premium mx-auto">
                        <div class="input-group-premium">
                            <input type="email" placeholder="Địa chỉ email của bạn..." required>
                            <button type="submit" class="btn-submit-premium">Đăng ký ngay</button>
                        </div>
                    </form>
                    <div class="mt-20 text-white-50 small"><i class="fas fa-lock-alt mr-5"></i> Chúng tôi không bao giờ chia sẻ email của bạn.</div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('Clients.blocks.footer')

{{-- ================= PREMIUM CUSTOM CSS ================= --}}
<style>
    :root { --primary-color: #ff5e14; --dark-modern: #1a1a1a; }
    .fw-800 { font-weight: 800; }
    
    /* Destination Premium Card */
    .destination-premium-card { border-radius: 25px; overflow: hidden; position: relative; height: 450px; cursor: pointer; }
    .image-wrapper-parallax { width: 100%; height: 100%; overflow: hidden; position: relative; }
    .destination-premium-card img { width: 100%; height: 100%; object-fit: cover; transition: 1.5s cubic-bezier(0.19, 1, 0.22, 1); }
    .destination-premium-card:hover img { transform: scale(1.15); }
    
    .card-glass-overlay { 
        position: absolute; inset: 0; padding: 30px; 
        background: linear-gradient(180deg, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.8) 100%); 
        display: flex; flex-direction: column; justify-content: space-between;
    }
    
    .badge-premium { background: rgba(255, 94, 20, 0.9); backdrop-filter: blur(5px); color: #fff; padding: 6px 16px; border-radius: 50px; font-size: 12px; font-weight: 700; }
    .bottom-content h4 a { color: #fff; text-decoration: none; font-size: 24px; font-weight: 800; }
    .explore-row { display: flex; align-items: center; justify-content: space-between; margin-top: 15px; opacity: 0; transform: translateY(20px); transition: 0.5s ease; }
    .destination-premium-card:hover .explore-row { opacity: 1; transform: translateY(0); }
    .small-desc { color: #ccc; font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
    .circle-btn { width: 45px; height: 45px; background: #fff; color: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; }

    /* Premium Deal Card */
    .premium-deal-card { background: #fff; border-radius: 20px; overflow: hidden; transition: 0.4s; }
    .shadow-hover:hover { box-shadow: 0 25px 50px rgba(0,0,0,0.1); transform: translateY(-10px); }
    .premium-deal-card .image-box { position: relative; height: 260px; }
    .promo-badge { position: absolute; top: 20px; left: 20px; background: #e3342f; color: #fff; padding: 5px 15px; border-radius: 8px; font-weight: 700; z-index: 5; }
    .deal-price-floating { 
        position: absolute; bottom: -25px; right: 25px; background: #fff; 
        padding: 12px 25px; border-radius: 15px; display: flex; flex-direction: column; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.15); z-index: 10;
    }
    .text-through { text-decoration: line-through; font-size: 12px; }
    .main-price { font-size: 20px; font-weight: 900; }
    
    .meta-tags .tag-item { font-size: 13px; color: #777; margin-right: 15px; }
    .title-link a { color: #111; font-weight: 800; transition: 0.3s; }
    .title-link a:hover { color: var(--primary-color); }
    .btn-action-premium { font-weight: 700; color: var(--primary-color); text-transform: uppercase; font-size: 12px; }

    /* Nav Premium */
    .destinations-nav-premium { background: #fff; border-radius: 100px; }
    .destinations-nav-premium li { padding: 12px 30px; cursor: pointer; font-weight: 700; border-radius: 100px; color: #555; }
    .destinations-nav-premium li.active { background: var(--primary-color); color: #fff; box-shadow: 0 10px 20px rgba(255, 94, 20, 0.3); }

    /* Newsletter Premium */
    .bg-dark-modern { background: var(--dark-modern); border-radius: 50px; margin: 0 20px; overflow: hidden; }
    .abstract-shape { position: absolute; width: 400px; height: 400px; background: var(--primary-color); filter: blur(150px); opacity: 0.15; top: -100px; right: -100px; }
    .icon-hld { width: 100px; height: 100px; background: #252525; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; }
    
    .newsletter-form-premium { max-width: 600px; }
    .input-group-premium { background: #fff; padding: 10px; border-radius: 100px; display: flex; }
    .input-group-premium input { flex: 1; border: none; padding-left: 30px; outline: none; color: #111; font-weight: 600; }
    .btn-submit-premium { background: var(--primary-color); color: #fff; border: none; padding: 15px 40px; border-radius: 100px; font-weight: 800; transition: 0.3s; }
    .btn-submit-premium:hover { background: #000; letter-spacing: 1px; }

    .bg-light-gradient { background: linear-gradient(180deg, #f8f9fa 0%, #fff 100%); }
</style>