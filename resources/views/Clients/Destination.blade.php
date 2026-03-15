@include('Clients.blocks.header')
@include('Clients.blocks.banner_search')



        
<section class="popular-destinations-area pt-100 pb-90 rel z-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-title text-center counter-text-wrap mb-40" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <h2>Khám Phá Các Điểm Đến Phổ Biến</h2>
                    <p>Trang web duy nhất với <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> trải nghiệm phổ biến nhất</p>
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
            <div class="row gap-10 destinations-active justify-content-center">
                <div class="col-xl-3 col-md-6 item recent rating">
                    <div class="destination-item style-two" data-aos="flip-up" data-aos-duration="1500" data-aos-offset="50">
                        <div class="image">
                            <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                            <img src="assets/images/destinations/destination1.jpg" alt="Điểm đến">
                        </div>
                        <div class="content">
                            <h6><a href="destination-details.html">Bãi biển Thái Lan</a></h6>
                            <span class="time">5352+ tour & 856+ Hoạt động</span>
                            <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 item features">
                    <div class="destination-item style-two" data-aos="flip-up" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="50">
                        <div class="image">
                            <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                            <img src="{{ asset('assets/images/destinations/destination2.jpg') }}" alt="Điểm đến">
                        </div>
                        <div class="content">
                            <h6><a href="destination-details.html">Parga, Hy Lạp</a></h6>
                            <span class="time">5352+ tour & 856+ Hoạt động</span>
                            <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 item recent city rating">
                    <div class="destination-item style-two" data-aos="flip-up" data-aos-delay="200" data-aos-duration="1500" data-aos-offset="50">
                        <div class="image">
                            <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                            <img src="{{ asset('assets/images/destinations/destination3.jpg') }}" alt="Điểm đến">
                        </div>
                        <div class="content">
                            <h6><a href="destination-details.html">Castellammare del Golfo, Ý</a></h6>
                            <span class="time">5352+ tour & 856+ Hoạt động</span>
                            <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 item city features">
                    <div class="destination-item style-two" data-aos="flip-up" data-aos-duration="1500" data-aos-offset="50">
                        <div class="image">
                            <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                            <img src="{{ asset('assets/images/destinations/destination4.jpg') }}" alt="Điểm đến">
                        </div>
                        <div class="content">
                            <h6><a href="destination-details.html">Khu bảo tồn, Canada</a></h6>
                            <span class="time">5352+ tour & 856+ Hoạt động</span>
                            <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 item recent">
                    <div class="destination-item style-two" data-aos="flip-up" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="50">
                        <div class="image">
                            <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                            <img src="{{ asset('assets/images/destinations/destination5.jpg') }}" alt="Điểm đến">
                        </div>
                        <div class="content">
                            <h6><a href="destination-details.html">Dubai, UAE</a></h6>
                            <span class="time">5352+ tour & 856+ Hoạt động</span>
                            <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 item features rating">
                    <div class="destination-item style-two" data-aos="flip-up" data-aos-delay="200" data-aos-duration="1500" data-aos-offset="50">
                        <div class="image">
                            <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                            <img src="{{ asset('assets/images/destinations/destination6.jpg') }}" alt="Điểm đến">
                        </div>
                        <div class="content">
                            <h6><a href="destination-details.html">Milos, Hy Lạp</a></h6>
                            <span class="time">5352+ tour & 856+ Hoạt động</span>
                            <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="hotel-area bgc-black pt-100 pb-70 rel z-1">
    <div class="container">
        <div class="row">
            <div class="col-xl-4">
                <div class="destination-left-content mb-35">
                    <div class="section-title text-white counter-text-wrap mb-45" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <h2>Khám Phá Những Khách Sạn Đẳng Cấp Thế Giới</h2>
                        <p>Một trang web duy nhất với <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> trải nghiệm <br> phổ biến nhất mà bạn sẽ nhớ mãi</p>
                    </div>
                    <a href="{{ route('destination') }}" class="theme-btn style-four mb-15">
                        <span data-hover="Khám phá thêm khách sạn">Khám phá thêm khách sạn</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="destination-item style-three" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <div class="image">
                        <div class="ratting"><i class="fas fa-star"></i> 4.8</div>
                        <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                        <img src="assets/images/destinations/hotel1.jpg" alt="Khách sạn">
                    </div>
                    <div class="content">
                        <span class="location"><i class="fal fa-map-marker-alt"></i> Ao Nang, Thái Lan</span>
                        <h5><a href="tour-details.html">Khách sạn The Brown Bench (Gần hồ bơi)</a></h5>
                        <ul class="list-style-one">
                            <li><i class="fal fa-bed-alt"></i> 2 Phòng ngủ</li>
                            <li><i class="fal fa-hat-chef"></i> 1 Nhà bếp</li>
                            <li><i class="fal fa-bath"></i> 2 Phòng tắm</li>
                            <li><i class="fal fa-router"></i> Internet</li>
                        </ul>
                        <div class="destination-footer">
                            <span class="price"><span>$85.00</span>/đêm</span>
                            <a href="tour-details.html" class="read-more">Đặt ngay <i class="fal fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="destination-item style-three" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
                    <div class="image">
                        <div class="ratting"><i class="fas fa-star"></i> 4.8</div>
                        <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                        <img src="assets/images/destinations/hotel2.jpg" alt="Khách sạn">
                    </div>
                    <div class="content">
                        <span class="location"><i class="fal fa-map-marker-alt"></i> Kigali, Rwanda</span>
                        <h5><a href="tour-details.html">Khách sạn Marriott (Cạnh sông và rừng cây)</a></h5>
                        <ul class="list-style-one">
                            <li><i class="fal fa-bed-alt"></i> 2 Phòng ngủ</li>
                            <li><i class="fal fa-hat-chef"></i> 1 Nhà bếp</li>
                            <li><i class="fal fa-bath"></i> 2 Phòng tắm</li>
                            <li><i class="fal fa-router"></i> Internet</li>
                        </ul>
                        <div class="destination-footer">
                            <span class="price"><span>$85.00</span>/đêm</span>
                            <a href="tour-details.html" class="read-more">Đặt ngay <i class="fal fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="destination-item style-three" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <div class="image">
                        <div class="ratting"><i class="fas fa-star"></i> 4.8</div>
                        <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                        <img src="assets/images/destinations/hotel3.jpg" alt="Khách sạn">
                    </div>
                    <div class="content">
                        <span class="location"><i class="fal fa-map-marker-alt"></i> Ao Nang, Thái Lan</span>
                        <h5><a href="tour-details.html">Khách sạn biệt thự sơn màu bao quanh bởi cây xanh</a></h5>
                        <ul class="list-style-one">
                            <li><i class="fal fa-bed-alt"></i> 2 Phòng ngủ</li>
                            <li><i class="fal fa-hat-chef"></i> 1 Nhà bếp</li>
                            <li><i class="fal fa-bath"></i> 2 Phòng tắm</li>
                            <li><i class="fal fa-router"></i> Internet</li>
                        </ul>
                        <div class="destination-footer">
                            <span class="price"><span>$85.00</span>/đêm</span>
                            <a href="tour-details.html" class="read-more">Đặt ngay <i class="fal fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="destination-item style-three" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
                    <div class="image">
                        <div class="ratting"><i class="fas fa-star"></i> 4.8</div>
                        <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                        <img src="assets/images/destinations/hotel4.jpg" alt="Khách sạn">
                    </div>
                    <div class="content">
                        <span class="location"><i class="fal fa-map-marker-alt"></i> Ao Nang, Thái Lan</span>
                        <h5><a href="tour-details.html">Khách sạn Jungle Pool Indonesia (Hồ bơi rừng rậm)</a></h5>
                        <ul class="list-style-one">
                            <li><i class="fal fa-bed-alt"></i> 2 Phòng ngủ</li>
                            <li><i class="fal fa-hat-chef"></i> 1 Nhà bếp</li>
                            <li><i class="fal fa-bath"></i> 2 Phòng tắm</li>
                            <li><i class="fal fa-router"></i> Internet</li>
                        </ul>
                        <div class="destination-footer">
                            <span class="price"><span>$85.00</span>/đêm</span>
                            <a href="tour-details.html" class="read-more">Đặt ngay <i class="fal fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


        
<section class="hot-deals-area pt-70 pb-50 rel z-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-title text-center counter-text-wrap mb-50" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <h2>Khám Phá Ưu Đãi Cực Hot</h2>
                    <p>Hơn <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> trải nghiệm phổ biến nhất mà bạn sẽ nhớ mãi</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="destination-item style-four no-border" data-aos="flip-left" data-aos-duration="1500" data-aos-offset="50">
                    <div class="image">
                        <span class="badge">Giảm 10%</span>
                        <a href="#" class="heart" aria-label="Yêu thích"><i class="fas fa-heart"></i></a>
                        <img src="assets/images/destinations/hot-deal1.jpg" alt="Ưu đãi Hot">
                    </div>
                    <div class="content">
                        <span class="location"><i class="fal fa-map-marker-alt"></i> Thành phố Venice, Ý</span>
                        <h5><a href="tour-details.html">Kênh Đào Venice, Mùa Hè Rực Rỡ Tại Venice</a></h5>
                    </div>
                    <div class="destination-footer">
                        <span class="price"><span>$58.00</span>/người</span>
                        <div class="ratting">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <a href="destination-details.html" class="theme-btn style-three">
                        <span data-hover="Khám phá">Khám phá</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="destination-item style-four no-border" data-aos="flip-left" data-aos-duration="1500" data-aos-offset="50">
                    <div class="image">
                        <span class="badge">Giảm 10%</span>
                        <a href="#" class="heart" aria-label="Yêu thích"><i class="fas fa-heart"></i></a>
                        <img src="{{ asset('assets/images/destinations/hot-deal2.jpg') }}" alt="Ưu đãi Hot">
                    </div>
                    <div class="content">
                        <span class="location"><i class="fal fa-map-marker-alt"></i> Kyoto, Nhật Bản</span>
                        <h5><a href="tour-details.html">Nhật Bản, Kyoto, Du lịch và Con người tại Kyoto bởi Sorasak</a></h5>
                    </div>
                    <div class="destination-footer">
                        <span class="price"><span>$58.00</span>/người</span>
                        <div class="ratting">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <a href="destination-details.html" class="theme-btn style-three">
                        <span data-hover="Khám phá">Khám phá</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="destination-item style-four no-border" data-aos="flip-left" data-aos-duration="1500" data-aos-offset="50">
                    <div class="image">
                        <span class="badge">Giảm 10%</span>
                        <a href="#" class="heart" aria-label="Yêu thích"><i class="fas fa-heart"></i></a>
                        <img src="{{ asset('assets/images/destinations/hot-deal3.jpg') }}" alt="Ưu đãi Hot">
                    </div>
                    <div class="content">
                        <span class="location"><i class="fal fa-map-marker-alt"></i> Tamnougalt, Ma-rốc</span>
                        <h5><a href="tour-details.html">Lạc đà trên sa mạc dưới bầu trời xanh tại Sahara, Ma-rốc.</a></h5>
                    </div>
                    <div class="destination-footer">
                        <span class="price"><span>$58.00</span>/người</span>
                        <div class="ratting">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <a href="destination-details.html" class="theme-btn style-three">
                        <span data-hover="Khám phá">Khám phá</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

        
<section class="newsletter-three bgc-primary py-100 rel z-1" style="background-image: url({{ asset('assets/images/newsletter/newsletter-bg-lines.png') }});">
            <div class="container container-1500">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="newsletter-content-part text-white rmb-55" data-aos="zoom-in-right" data-aos-duration="1500" data-aos-offset="50">
                            <div class="section-title counter-text-wrap mb-45">
                                <h2>Đăng Ký Bản Tin Để Nhận Thêm Ưu Đãi & Mẹo Du Lịch</h2>
                                <p>Hơn <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> trải nghiệm phổ biến nhất mà bạn sẽ nhớ mãi</p>
                            </div>
                            <form class="newsletter-form mb-15" action="#">
                                <input id="news-email" type="email" placeholder="Địa chỉ Email" required>
                                <button type="submit" class="theme-btn bgc-secondary style-two">
                                    <span data-hover="Đăng ký">Đăng ký</span>
                                    <i class="fal fa-arrow-right"></i>
                                </button>
                            </form>
                            <p>Không yêu cầu thẻ tín dụng. Không ràng buộc.</p>
                        </div>
                        <div class="newsletter-bg-image" data-aos="zoom-in-up" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="50">
                            <img src="{{ asset('assets/images/newsletter/newsletter-bg-image.png') }}" alt="Bản tin">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="newsletter-image-part bgs-cover" style="background-image: url({{ asset('assets/images/newsletter/newsletter-two-right.jpg') }});" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50"></div>
                    </div>
                </div>
            </div>
        </section>

@include('Clients.blocks.footer')