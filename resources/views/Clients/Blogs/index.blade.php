@include('Clients.blocks.header')
@include('Clients.blocks.banner', ['title' => request('category') ?? 'Tin Tức & Cảm Hứng'])

<section class="blog-list-page py-80 bg-light-soft">
    <div class="container">
        <div class="row">

            {{-- ================== DANH SÁCH BÀI VIẾT (BÊN TRÁI) ================== --}}
            <div class="col-lg-8">
                <div class="blog-list-inner">
                    @forelse($blogs as $blog)
                        <article class="blog-card-premium mb-40 shadow-sm transition" data-aos="fade-up">
                            <div class="row no-gutters bg-white overflow-hidden rounded-20 border">
                                {{-- Image Section: Khóa khung và Căn giữa --}}
                                <div class="col-md-5">
                                    <div class="blog-img-box">
                                        <a href="{{ route('blog.detail', $blog->slug) }}" class="d-block h-100">
                                            <img loading="lazy" 
                                                 src="{{ $blog->image ? asset($blog->image) : asset('clients/assets/images/blog/blog-list1.jpg') }}" 
                                                 alt="{{ $blog->title }}">
                                        </a>
                                        <a href="{{ route('blogs', ['category' => $blog->category_name]) }}" class="blog-cate-badge">
                                            {{ $blog->category_name }}
                                        </a>
                                    </div>
                                </div>

                                {{-- Content Section --}}
                                <div class="col-md-7 d-flex align-items-center">
                                    <div class="blog-info-box p-4 w-100">
                                        <div class="blog-meta mb-10">
                                            <span class="meta-item"><i class="far fa-calendar-alt"></i> {{ $blog->created_at->format('d/m/Y') }}</span>
                                            <span class="meta-item"><i class="far fa-eye"></i> {{ number_format($blog->views ?? 0) }} lượt xem</span>
                                        </div>

                                        <h3 class="blog-title mb-15">
                                            <a href="{{ route('blog.detail', $blog->slug) }}">
                                                {{ $blog->title }}
                                            </a>
                                        </h3>

                                        <p class="blog-desc text-muted mb-25 line-clamp-2">
                                            {{ Str::limit($blog->description, 150) }}
                                        </p>

                                        <div class="blog-footer d-flex justify-content-between align-items-center pt-20 border-top">
                                            <a href="{{ route('blog.detail', $blog->slug) }}" class="read-more-btn">
                                                Tiếp tục đọc <i class="fal fa-long-arrow-right"></i>
                                            </a>
                                            <div class="share-icons">
                                                <a href="#" class="ml-10 text-muted"><i class="fab fa-facebook-f"></i></a>
                                                <a href="#" class="ml-10 text-muted"><i class="fab fa-twitter"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="no-blog-found text-center py-100 bg-white rounded-20 border shadow-sm">
                            <i class="fas fa-search-minus fa-4x text-muted opacity-2 mb-20"></i>
                            <h4 class="text-muted font-italic">Rất tiếc, chưa có bài viết nào!</h4>
                            <a href="{{ route('blogs') }}" class="btn btn-primary rounded-pill px-4 mt-20">Xem tất cả bài viết</a>
                        </div>
                    @endforelse

                    {{-- PHÂN TRANG --}}
                    <div class="pagination-modern mt-50 d-flex justify-content-center">
                        {{ $blogs->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>

            {{-- ================== SIDEBAR (BÊN PHẢI - CỐ ĐỊNH) ================== --}}
            <div class="col-lg-4 col-md-8 rmt-75">
                <aside class="sticky-sidebar">

                    {{-- Tìm kiếm --}}
                    <div class="sidebar-widget mb-30 p-25 bg-white rounded-20 shadow-sm border">
                        <h5 class="widget-title">Tìm kiếm bài viết</h5>
                        <form action="{{ route('blogs') }}" method="GET" class="modern-search mt-20">
                            <div class="position-relative">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Nhập từ khóa..." required>
                                <button type="submit"><i class="far fa-search"></i></button>
                            </div>
                        </form>
                    </div>

                    {{-- Danh mục --}}
                    <div class="sidebar-widget mb-30 p-25 bg-white rounded-20 shadow-sm border">
                        <h5 class="widget-title">Danh mục bài viết</h5>
                        <ul class="cate-list mt-20">
                            @foreach($categories as $cate)
                                <li>
                                    <a href="{{ route('blogs', ['category' => $cate->category_name]) }}" 
                                       class="{{ request('category') == $cate->category_name ? 'active' : '' }}">
                                        <span><i class="fas fa-chevron-right small mr-10"></i> {{ $cate->category_name }}</span>
                                        <span class="count">{{ $cate->total }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Đăng ký nhận tin --}}
                    <div class="newsletter-gradient-box text-center text-white p-30 rounded-20 shadow-lg">
                        <div class="icon-circle mb-20">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <h5 class="mb-10 text-white">Đăng ký nhận tin</h5>
                        <p class="small opacity-8 mb-20">Nhận thông báo về những bài viết và cảm hứng mới nhất.</p>
                        <form action="#" class="newsletter-form">
                            <input type="email" placeholder="Email của bạn..." class="form-control mb-10 rounded-pill border-0 px-4">
                            <button class="btn btn-dark btn-block rounded-pill font-weight-bold">Đăng ký ngay</button>
                        </form>
                    </div>

                </aside>
            </div>

        </div>
    </div>
</section>
<style>
    /* Biến màu sắc & Cấu hình */
    :root {
        --p-color: #ff5e14;
        --bg-soft: #f4f7fa;
        --text-dark: #1a1a1a;
        --rounded-lg: 20px;
        --transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .bg-light-soft { background-color: var(--bg-soft); }
    .rounded-20 { border-radius: var(--rounded-lg) !important; }

    /* BLOG CARD: Tối ưu hiển thị ảnh căn giữa */
    .blog-card-premium {
        transition: var(--transition);
        border: none;
    }
    .blog-card-premium:hover {
        transform: translateY(-8px);
    }

    .blog-img-box {
        position: relative;
        height: 100%;
        min-height: 260px; /* Đảm bảo chiều cao tối thiểu */
        overflow: hidden;
        background: #eee;
    }

    .blog-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* KHÓA ẢNH KHÔNG BỊ MÉO */
        object-position: center center; /* LUÔN LẤY GIỮA */
        transition: transform 0.8s ease;
    }

    .blog-card-premium:hover .blog-img-box img {
        transform: scale(1.1);
    }

    /* Badge danh mục */
    .blog-cate-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: var(--p-color);
        color: white !important;
        padding: 5px 15px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        z-index: 2;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    /* Meta & Typography */
    .blog-meta .meta-item {
        font-size: 13px;
        color: #777;
        margin-right: 20px;
        display: inline-flex;
        align-items: center;
    }
    .blog-meta .meta-item i { color: var(--p-color); margin-right: 6px; }

    .blog-title a {
        font-size: 22px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1.4;
        text-decoration: none !important;
        transition: 0.3s;
    }
    .blog-title a:hover { color: var(--p-color); }

    .blog-desc { font-size: 15px; line-height: 1.6; }

    /* Nút đọc thêm */
    .read-more-btn {
        color: var(--text-dark);
        font-weight: 700;
        font-size: 14px;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        transition: 0.3s;
        text-decoration: none !important;
    }
    .read-more-btn i { margin-left: 8px; transition: 0.3s; }
    .read-more-btn:hover { color: var(--p-color); }
    .read-more-btn:hover i { transform: translateX(5px); }

    /* SIDEBAR CỐ ĐỊNH */
    .sticky-sidebar {
        position: -webkit-sticky;
        position: sticky;
        top: 100px;
    }

    .widget-title {
        font-weight: 700;
        font-size: 18px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f1f1f1;
        position: relative;
    }
    .widget-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -2px;
        width: 40px;
        height: 2px;
        background: var(--p-color);
    }

    /* Search Form */
    .modern-search input {
        width: 100%;
        padding: 12px 25px;
        border: 1px solid #eee;
        border-radius: 50px;
        background: #f9f9f9;
        outline: none;
        font-size: 14px;
    }
    .modern-search button {
        position: absolute;
        right: 5px;
        top: 50%;
        transform: translateY(-50%);
        background: var(--p-color);
        color: white;
        border: none;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        transition: 0.3s;
    }
    .modern-search button:hover { background: #333; }

    /* Cate List */
    .cate-list { list-style: none; padding: 0; }
    .cate-list li a {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        color: #555;
        font-weight: 500;
        border-bottom: 1px dashed #eee;
        text-decoration: none;
        transition: 0.3s;
    }
    .cate-list li a:hover, .cate-list li a.active {
        color: var(--p-color);
        padding-left: 8px;
    }
    .cate-list .count {
        background: #f0f0f0;
        color: #888;
        font-size: 11px;
        padding: 2px 10px;
        border-radius: 20px;
    }

    /* Newsletter Widget */
    .newsletter-gradient-box {
        background: linear-gradient(135deg, #ff5e14 0%, #ff8c52 100%);
        border: none;
    }
    .icon-circle {
        width: 70px;
        height: 70px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-size: 30px;
    }
    .newsletter-form input { height: 45px; font-size: 14px; }

    /* Phân trang */
    .pagination-modern .page-link {
        border-radius: 10px !important;
        margin: 0 4px;
        color: #555;
        border: 1px solid #eee;
    }
    .pagination-modern .page-item.active .page-link {
        background: var(--p-color);
        border-color: var(--p-color);
    }

    /* Line Clamp 2 dòng */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Responsive */
    @media (max-width: 767px) {
        .blog-img-box { min-height: 200px; }
        .blog-title a { font-size: 18px; }
        .sticky-sidebar { position: relative; top: 0; margin-top: 40px; }
    }
</style>
@include('Clients.blocks.footer')