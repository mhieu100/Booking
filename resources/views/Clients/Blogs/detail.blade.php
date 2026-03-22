@include('Clients.blocks.header')
@include('Clients.blocks.banner', ['title' => $blog->title])

<section class="blog-details-page py-100 bg-white">
    <div class="container">
        <div class="row">

            {{-- ================= MAIN CONTENT (BÊN TRÁI) ================= --}}
            <div class="col-lg-8">
                <article class="blog-details-inner pr-20 rpr-0" data-aos="fade-up">
                    
                    {{-- BREADCRUMB & META --}}
                    <div class="blog-header-meta mb-20 d-flex align-items-center flex-wrap">
                        <a href="{{ route('blogs', ['category' => $blog->category_name]) }}" class="category-badge-detail mr-20 mb-10">
                            {{ $blog->category_name }}
                        </a>
                        <ul class="blog-meta-detail mb-10 d-flex text-muted small">
                            <li class="mr-20"><i class="far fa-calendar-alt text-primary mr-5"></i> {{ $blog->created_at->format('d/m/Y') }}</li>
                            <li><i class="far fa-eye text-primary mr-5"></i> {{ number_format($blog->views ?? 0) }} lượt xem</li>
                        </ul>
                    </div>

                    {{-- TITLE --}}
                    <h1 class="blog-main-title mb-30 font-weight-bold" style="line-height: 1.3;">{{ $blog->title }}</h1>

                    {{-- FEATURED IMAGE --}}
                    <div class="main-image mb-40 shadow-sm rounded overflow-hidden">
                        <img src="{{ asset($blog->image ?? 'clients/assets/images/blog/blog-details.jpg') }}" 
                             alt="{{ $blog->title }}" class="img-fluid w-100 transition-5">
                    </div>

                    {{-- DYNAMIC CONTENT (CKEDITOR OUTPUT) --}}
                    <div class="blog-post-content mb-50 text-justify" style="font-size: 1.1rem; line-height: 1.8; color: #333;">
                        {!! $blog->content !!}
                    </div>

                    {{-- SHARE & CATEGORY FOOTER --}}
                    <div class="tag-share-box d-flex justify-content-between align-items-center flex-wrap py-25 border-top border-bottom mb-50">
                        <div class="cat-info mb-10">
                            <span class="font-weight-bold mr-10">Chuyên mục:</span>
                            <a href="{{ route('blogs', ['category' => $blog->category_name]) }}" class="text-primary hover-underline">
                                {{ $blog->category_name }}
                            </a>
                        </div>
                        <div class="social-share mb-10">
                            <span class="font-weight-bold mr-15">Chia sẻ ngay:</span>
                            <a target="_blank" rel="noopener noreferrer" 
                               href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                               class="share-fb-btn shadow-sm transition">
                                <i class="fab fa-facebook-f mr-5"></i> Facebook
                            </a>
                        </div>
                    </div>

                    {{-- RELATED POSTS --}}
                    @if($relatedBlogs->isNotEmpty())
                        <div class="related-posts-section mb-50">
                            <h4 class="section-title mb-30 font-weight-bold">Có thể bạn quan tâm</h4>
                            <div class="row">
                                @foreach($relatedBlogs as $item)
                                    <div class="col-md-6 mb-30">
                                        <div class="related-item card border-0 shadow-sm h-100 transition">
                                            <a href="{{ route('blog.detail', $item->slug) }}" class="overflow-hidden rounded-top">
                                                <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" 
                                                     class="card-img-top w-100 transition-5" style="height: 200px; object-fit: cover;">
                                            </a>
                                            <div class="card-body p-3">
                                                <h6 class="mb-0">
                                                    <a href="{{ route('blog.detail', $item->slug) }}" class="text-dark hover-primary line-clamp-2">
                                                        {{ $item->title }}
                                                    </a>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </article>
            </div>

            {{-- ================= SIDEBAR (BÊN PHẢI - STICKY) ================= --}}
            <div class="col-lg-4">
                <aside class="blog-sidebar sticky-sidebar pl-20 rpl-0">

                    {{-- SEARCH WIDGET --}}
                    <div class="widget widget-search-detail p-30 bg-light rounded mb-30">
                        <h5 class="widget-title mb-20 font-weight-bold">Tìm kiếm</h5>
                        <form action="{{ route('blogs') }}" method="GET" class="position-relative">
                            <input type="text" name="search" class="form-control border-0 px-4 py-3 rounded-pill" 
                                   placeholder="Bạn muốn tìm gì..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary position-absolute rounded-pill px-3 shadow-sm" 
                                    style="right: 5px; top: 5px; height: calc(100% - 10px);">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>

                    {{-- RECENT POSTS WIDGET --}}
                    @if($recentNews->isNotEmpty())
                        <div class="widget widget-recent-detail p-30 bg-white border rounded mb-30 shadow-sm">
                            <h5 class="widget-title mb-25 font-weight-bold">Bài viết mới nhất</h5>
                            <ul class="list-unstyled mb-0">
                                @foreach($recentNews as $news)
                                    <li class="d-flex align-items-center mb-20 pb-20 border-bottom">
                                        <div class="image flex-shrink-0 mr-15">
                                            <a href="{{ route('blog.detail', $news->slug) }}" class="d-block overflow-hidden rounded">
                                                <img width="85" height="75" style="object-fit: cover;" 
                                                     src="{{ asset($news->image) }}" alt="{{ $news->title }}" class="transition-5">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h6 class="mb-1 text-sm">
                                                <a href="{{ route('blog.detail', $news->slug) }}" class="text-dark hover-primary line-clamp-2 font-weight-bold">
                                                    {{ $news->title }}
                                                </a>
                                            </h6>
                                            <small class="text-muted"><i class="far fa-clock mr-1"></i> {{ $news->created_at->format('d/m/Y') }}</small>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </aside>
            </div>

        </div>
    </div>
</section>

@include('Clients.blocks.footer')

{{-- ================= CUSTOM CSS (TỐI ƯU HIỂN THỊ NỘI DUNG) ================= --}}
<style>
    /* Content Styling (CKEditor Fix) */
    .blog-post-content img { max-width: 100%; height: auto !important; border-radius: 8px; margin: 20px 0; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
    .blog-post-content blockquote { border-left: 5px solid var(--primary-color, #ff5e14); background: #f9f9f9; padding: 25px 30px; font-style: italic; margin: 30px 0; border-radius: 0 8px 8px 0; font-size: 1.2rem; }
    .blog-post-content table { width: 100% !important; border-collapse: collapse; margin-bottom: 25px; overflow-x: auto; display: block; }
    .blog-post-content table td, .blog-post-content table th { border: 1px solid #eee; padding: 12px; }

    /* Meta & Badge */
    .category-badge-detail { background: var(--primary-color, #ff5e14); color: #fff; padding: 6px 20px; border-radius: 50px; font-weight: 600; font-size: 14px; box-shadow: 0 4px 10px rgba(255, 94, 20, 0.3); }
    .category-badge-detail:hover { color: #fff; transform: translateY(-2px); }
    
    /* Share Button */
    .share-fb-btn { background: #1877f2; color: #fff; padding: 8px 25px; border-radius: 50px; font-weight: 600; font-size: 14px; }
    .share-fb-btn:hover { color: #fff; background: #145dbf; transform: scale(1.05); }

    /* Related & Hover */
    .hover-primary:hover { color: var(--primary-color, #ff5e14) !important; }
    .transition-5 { transition: all 0.5s ease; }
    .recent-image:hover img, .related-item:hover img { transform: scale(1.1); }
    .related-item:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important; }
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

    /* Sticky Sidebar */
    @media (min-width: 992px) {
        .sticky-sidebar { position: -webkit-sticky; position: sticky; top: 120px; }
    }
</style>