@include('Clients.blocks.header')
@include('Clients.blocks.banner', ['title' => 'Tin Tức'])

<section class="blog-list-page py-100 rel z-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-item style-three" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <div class="image">
                        <img src="{{ asset('clients/assets/images/blog/blog-list1.jpg') }}" alt="Blog List">
                    </div>
                    <div class="content">
                        <a href="blog.html" class="category">Du lịch</a>
                        <h5><a href="blog-details.html">Cẩm nang toàn diện để lập kế hoạch cho kỳ nghỉ mơ ước của bạn</a></h5>
                        <ul class="blog-meta">
                            <li><i class="far fa-calendar-alt"></i> <a href="#">25 Tháng 2, 2024</a></li>
                            <li><i class="far fa-comments"></i> <a href="#">Bình luận (5)</a></li>
                        </ul>
                        <p>Chúng tôi chuyên thiết kế những trải nghiệm thành phố khó quên cho những du khách đang tìm kiếm...</p>
                        <a href="blog-details.html" class="theme-btn style-two style-three">
                            <span data-hover="Đọc ngay">Xem thêm</span>
                            <i class="fal fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <ul class="pagination pt-15 flex-wrap" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <li class="page-item disabled">
                        <span class="page-link"><i class="far fa-chevron-left"></i></span>
                    </li>
                    <li class="page-item active">
                        <span class="page-link">
                            1
                            <span class="sr-only">(Hiện tại)</span>
                        </span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#"><i class="far fa-chevron-right"></i></a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-8 col-sm-10 rmt-75">
                <div class="blog-sidebar">
                    
                    <div class="widget widget-search" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <form action="#" class="default-search-form">
                            <input type="text" placeholder="Tìm kiếm tin tức..." required="">
                            <button type="submit" class="searchbutton far fa-search"></button>
                        </form>
                    </div>
                    
                    <div class="widget widget-category" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <h5 class="widget-title">Danh mục</h5>
                        <ul class="list-style-three">
                            <li><a href="blog.html">Khám phá mạo hiểm</a></li>
                            <li><a href="blog.html">Leo núi & Trekking</a></li>
                            <li><a href="blog.html">Tour xe đạp</a></li>
                            <li><a href="blog.html">Tour gia đình</a></li>
                            <li><a href="blog.html">Leo núi mạo hiểm</a></li>
                            <li><a href="blog.html">Chèo thuyền vượt thác</a></li>
                            <li><a href="blog.html">Dù lượn ven biển</a></li>
                        </ul>
                    </div>
                    
                    <div class="widget widget-news" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <h5 class="widget-title">Tin mới nhất</h5>
                        <ul>
                            <li>
                                <div class="image">
                                    <img src="{{ asset('clients/assets/images/widgets/news1.jpg') }}" alt="News">
                                </div>
                                <div class="content">
                                    <h6><a href="blog-details.html">Những điểm đến độc đáo và những câu chuyện chưa kể</a></h6>
                                    <span class="date"><i class="far fa-calendar-alt"></i> 25 Th2 2024</span>
                                </div>
                            </li>
                            <li>
                                <div class="image">
                                    <img src="{{ asset('clients/assets/images/widgets/news2.jpg') }}" alt="News">
                                </div>
                                <div class="content">
                                    <h6><a href="blog-details.html">Trải nghiệm đắm chìm từ khắp nơi trên thế giới</a></h6>
                                    <span class="date"><i class="far fa-calendar-alt"></i> 25 Th2 2024</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="widget widget-gallery" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <h5 class="widget-title">Thư viện ảnh</h5>
                        <div class="gallery">
                            <a href="{{ asset('clients/assets/images/widgets/gallery1.jpg') }}">
                                <img src="{{ asset('clients/assets/images/widgets/gallery1.jpg') }}" alt="Gallery">
                            </a>
                            <a href="{{ asset('clients/assets/images/widgets/gallery2.jpg') }}">
                                <img src="{{ asset('clients/assets/images/widgets/gallery2.jpg') }}" alt="Gallery">
                            </a>
                            </div>
                    </div>
                    <!--
                    <div class="widget widget-cta" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <div class="content text-white">
                            <span class="h6">Khám phá thế giới</span>
                            <h3>Những điểm du lịch tốt nhất</h3>
                            <a href="tour-list.html" class="theme-btn style-two bgc-secondary">
                                <span data-hover="Khám phá ngay">Khám phá ngay</span>
                                <i class="fal fa-arrow-right"></i>
                            </a>
                        </div>
                        <div class="image">
                            <img src="{{ asset('clients/assets/images/widgets/cta-widget.png') }}" alt="CTA">
                        </div>
                        <div class="cta-shape"><img src="{{ asset('clients/assets/images/widgets/cta-shape.png') }}" alt="Shape"></div>
                    </div>
                    -->
                    
                </div>
            </div>
        </div>
    </div>
</section>
@include('Clients.blocks.footer')