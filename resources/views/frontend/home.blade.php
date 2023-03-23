@extends('frontend.layouts.master')
@section('meta')
@endsection
@section('title')
White Globe | HOME
@endsection
@push('styles')
@endpush


@section('content')


<section class="banner__slider banner_sec">        
    <div class="slider stick-dots">
        <div class="slide">
            <div class="slide__content slide__content__left">
              <div class="slide__content--headings text-left">
                <h2 class="animated title" data-animation-in="fadeInUp">Find Your<br>Next </h2>
                <p class="animated top-title" data-animation-in="fadeInUp" data-delay-in="0.3">Our most popular and trending <b>White Glove Comics & KCI.</b> perfect 
                  Not sure what to read now next reading mood perfectly.</p>
                <div class="hero-text mb-3" data-animation-in="fadeInUp" data-delay-in="0.6">
                    <a class="red_btn" href="#">Explore Now</a>
                </div>
              </div>
            </div>
            <div class="banner_img">
              <div class="banner_right_img">
                <a href="">
                  <img src="" alt="" data-lazy="{{ asset('frontend_assets/images/banner_img.png')}}" class="full-image animated" data-animation-in="fadeInUp" data-delay-in="0.3" />
                  <span class="full-image animated" data-animation-in="fadeInUp" data-delay-in="0.5"><b>Hooded Cloak Battle</b> of the Gods Fujin and Raijin</span>
                </a>
              </div>
              <div class="banner_right_img">
                <a href="">
                  <span class="full-image animated" data-animation-in="fadeInDown" data-delay-in="0.5"><b>Hooded Cloak Battle</b> of the Gods Fujin and Raijin</span>
                  <img src="" alt="" data-lazy="{{ asset('frontend_assets/images/banner_img1.png')}}" class="full-image animated" data-animation-in="fadeInDown" data-delay-in="0.3" />                      
                </a>
              </div>
              <div class="banner_right_img">
                <a href="">
                  <img src="" alt="" data-lazy="{{ asset('frontend_assets/images/banner_img2.png')}}" class="full-image animated" data-animation-in="fadeInUp" data-delay-in="0.3" />
                  <span class="full-image animated" data-animation-in="fadeInUp" data-delay-in="0.5"><b>Hooded Cloak Battle</b> of the Gods Fujin and Raijin</span>
                </a>
              </div>
            </div>
        </div>
        <div class="slide">
          <div class="slide__content slide__content__left">
            <div class="slide__content--headings text-left">
              <h2 class="animated title" data-animation-in="fadeInUp">Find Your<br>Next </h2>
              <p class="animated top-title" data-animation-in="fadeInUp" data-delay-in="0.3">Our most popular and trending <b>White Glove Comics & KCI.</b> perfect 
                Not sure what to read now next reading mood perfectly.</p>
              <div class="hero-text mb-3" data-animation-in="fadeInUp" data-delay-in="0.6">
                  <a class="red_btn" href="#">Explore Now</a>
              </div>
            </div>
          </div>
          <div class="banner_img">
            <div class="banner_right_img">
              <a href="">
                <img src="" alt="" data-lazy="{{ asset('frontend_assets/images/banner_img.png')}}" class="full-image animated" data-animation-in="fadeInUp" data-delay-in="0.3" />
                <span class="full-image animated" data-animation-in="fadeInUp" data-delay-in="0.5"><b>Hooded Cloak Battle</b> of the Gods Fujin and Raijin</span>
              </a>
            </div>
            <div class="banner_right_img">
              <a href="">
                <span class="full-image animated" data-animation-in="fadeInDown" data-delay-in="0.5"><b>Hooded Cloak Battle</b> of the Gods Fujin and Raijin</span>
                <img src="" alt="" data-lazy="{{ asset('frontend_assets/images/banner_img1.png')}}" class="full-image animated" data-animation-in="fadeInDown" data-delay-in="0.3" />                      
              </a>
            </div>
            <div class="banner_right_img">
              <a href="">
                <img src="" alt="" data-lazy="{{ asset('frontend_assets/images/banner_img2.png')}}" class="full-image animated" data-animation-in="fadeInUp" data-delay-in="0.3" />
                <span class="full-image animated" data-animation-in="fadeInUp" data-delay-in="0.5"><b>Hooded Cloak Battle</b> of the Gods Fujin and Raijin</span>
              </a>
            </div>
          </div>
      </div>
        <!-- <div class="slide">
            <div class="slide__content slide__content__left">
                <div class="slide__content--headings text-left">
                  <h2 class="animated title" data-animation-in="fadeInUp">Find Your<br>Next </h2>
                  <p class="animated top-title" data-animation-in="fadeInUp" data-delay-in="0.3">There are many variations of passages of Lorem Ipsum available, but the majority have suffered</p>
                  <div class="hero-text mb-3" data-animation-in="fadeInUp" data-delay-in="0.6">
                      <a class="red_btn type2" href="#">View More Questions</a>
                  </div>
                </div>
            </div>
            <div class="banner_img">
                <img src="" alt="" data-lazy="assets/images/banner.png" class="full-image animated" data-animation-in="fadeInUp" data-delay-in="0.5" />
            </div>
        </div> -->

    </div>
    <div class="explore_btn">
      <a href="">Scroll Down <i class="fa-solid fa-angle-down"></i> </a>
    </div>
</section>
  <section class="all_catagory">
    <div class="container-fluid">
      <div class="catagory_box">
        <div class="cata_slider">
          @foreach($categories as $category)
          <div class="cata_box">
            <a href="{{ route('product',$category['id']) }}">
              <div class="cata_img">
                <img src="{{ Storage::url($category['image']) }}" alt=""/>
              </div>
              <h5>{{ $category['name'] }}</h5>
            </a>
          </div>
          @endforeach
          {{-- <div class="cata_box">
            <a href="product.html">
              <div class="cata_img">
                <img src="{{asset('frontend_assets/images/cata1.png')}}" alt=""/>
              </div>
              <h5>Comics- The Bronze Age (1970 - 1983)</h5>
            </a>
          </div>
          <div class="cata_box">
            <a href="product.html">
              <div class="cata_img">
                <img src="{{asset('frontend_assets/images/cata2.png')}}" alt=""/>
              </div>
              <h5>Comics - The Modern Age (1992 - Present)</h5>
            </a>
          </div>
          <div class="cata_box">
            <a href="product.html">
              <div class="cata_img">
                <img src="{{asset('frontend_assets/images/cata3.png')}}" alt=""/>
              </div>
              <h5>Superhero Capes, Boots, And Bracelets - (Apparel)</h5>
            </a>
          </div>
          <div class="cata_box">
            <a href="product.html">
              <div class="cata_img">
                <img src="{{asset('frontend_assets/images/cata4.png')}}" alt=""/>
              </div>
              <h5>The Utility Belt - (Tech)</h5>
            </a>
          </div>
          <div class="cata_box">
            <a href="product.html">
              <div class="cata_img">
                <img src="{{asset('frontend_assets/images/cata5.png')}}" alt=""/>
              </div>
              <h5>The Secret Hideout. - (Home Decor)</h5>
            </a>
          </div>
          <div class="cata_box">
            <a href="product.html">
              <div class="cata_img">
                <img src="{{asset('frontend_assets/images/cata3.png')}}" alt=""/>
              </div>
              <h5>Superhero Capes, Boots, And Bracelets - (Apparel)</h5>
            </a>
          </div>               --}}

        </div>
      </div>
    </div>
  </section>
  <section class="can_bis_2">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="cannabis_tow_box">
            <div class="can_img"><img src="{{asset('frontend_assets/images/canabi.png')}}" alt=""/></div>
            <div class="position-relative">
              <div class="row justify-content-end">
                <div class="col-lg-6">
                  <div class="heading_hp text_white">
                    <h2>Present the "Gods & Monsters" Collection</h2>
                    <a class="sec_btn" href=""><span>Shop Now</span></a>
                  </div>
                </div>                  
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="about_sec">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-6 col-7" data-aos="fade-up" data-aos-duration="500">
          <div class="heading_hp">
            <h2><span>Featured</span> Products</h2>
          </div>
        </div> 
        <div class="col-md-6 col-5 text-end" data-aos="fade-up" data-aos-duration="1000">
          <a class="red_btn" href=""><span>view all</span></a>
        </div>            
        <div class="product_slider mt-4">
          @foreach($featured_products as $product)
          <div class="product_slid">
            <div class="card_box">
              <div class="wish_cart">
                <div class="wish">
                  <a href="{{ route('product-detail',$product['id']) }}"><i class="fa-solid fa-heart"></i></a>
                </div>                    
              </div>
              <div class="card_img">
                <a href="{{ route('product-detail',$product['id']) }}">
                  <img src="{{ Storage::url($product['image']) }}" alt=""/>
                </a>
              </div>                  
              <div class="card_text">
                <h4><a href="{{ route('product-detail',$product['id']) }}">{!! Str::limit($product['name'], 30, ' ...') !!}</a></h4>
                
                <div class="card_star">
                  <ul>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                  </ul>
                </div>
                <h3>Price ${{ $product['price'] }}</h3>
                <div class="cart">
                  <a href=""><i class="fa-solid fa-bag-shopping"></i> Add</a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          {{-- <div class="product_slid">
            <div class="card_box">
              <div class="wish_cart">
                <div class="wish">
                  <a href=""><i class="fa-solid fa-heart"></i></a>
                </div>
              </div>
              <div class="card_img">
                <a href="">
                  <img src="{{asset('frontend_assets/images/featured_product1.jpg')}}" alt=""/>
                </a>
              </div>                  
              <div class="card_text">
                <h4><a href="">Reaper Skull Angel and Demon 3D All Over Printed</a></h4>
                <div class="card_star">
                  <ul>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                  </ul>
                </div>
                <h3>Price $34.75</h3>
                <div class="cart">
                  <a href=""><i class="fa-solid fa-bag-shopping"></i> Add</a>
                </div>
              </div>
            </div>
          </div>
          <div class="product_slid">
            <div class="card_box">
              <div class="wish_cart">
                <div class="wish">
                  <a href=""><i class="fa-solid fa-heart"></i></a>
                </div>
              </div>
              <div class="card_img">
                <a href="">
                  <img src="{{asset('frontend_assets/images/featured_product2.jpg')}}" alt=""/>
                </a>
              </div>
              <div class="card_text">
                <h4><a href="">Reaper Skull Angel and Demon 3D All Over Printed</a></h4>
                <div class="card_star">
                  <ul>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                  </ul>
                </div>
                <h3>Price $34.75</h3>
                <div class="cart">
                  <a href=""><i class="fa-solid fa-bag-shopping"></i> Add</a>
                </div>
              </div>
            </div>
          </div>
          <div class="product_slid">
            <div class="card_box">
              <div class="wish_cart">
                <div class="wish">
                  <a href=""><i class="fa-solid fa-heart"></i></a>
                </div>
              </div>
              <div class="card_img">
                <a href="">
                  <img src="{{asset('frontend_assets/images/featured_product3.jpg')}}" alt=""/>
                </a>
              </div>
              <div class="card_text">
                <h4><a href="">Reaper Skull Angel and Demon 3D All Over Printed</a></h4>
                <div class="card_star">
                  <ul>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                  </ul>
                </div>
                <h3>Price $34.75</h3>
                <div class="cart">
                  <a href=""><i class="fa-solid fa-bag-shopping"></i> Add</a>
                </div>
              </div>
            </div>
          </div>
          <div class="product_slid">
            <div class="card_box">
              <div class="wish_cart">
                <div class="wish">
                  <a href=""><i class="fa-solid fa-heart"></i></a>
                </div>
              </div>
              <div class="card_img">
                <a href="">
                  <img src="{{asset('frontend_assets/images/featured_product4.jpg')}}" alt=""/>
                </a>
              </div>
              <div class="card_text">
                <h4><a href="">Reaper Skull Angel and Demon 3D All Over Printed</a></h4>
                <div class="card_star">
                  <ul>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                  </ul>
                </div>
                <h3>Price $34.75</h3>
                <div class="cart">
                  <a href=""><i class="fa-solid fa-bag-shopping"></i> Add</a>
                </div>
              </div>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
  </section>
  <section class="online_book_fire">
    <div class="online_book_bg">
      <img src="{{asset('frontend_assets/images/online_book.png')}}" alt=""/>
    </div>
    <div class="container">
      <div class="row justify-content-end">
        <div class="col-lg-4">
          <div class="border_b">
            <div class="heading_hp text_white text-center">
              <h2>Online Book Fairs 2022</h2>
              <p>Lorem ipsum dolor sit amet consectetur. Lacus egestas odio ut enim. Mus diam rhoncus viverra varius amet tellus orci. Enim vestibulum ornare vulputate ornare egestas purus dolor. </p>
              <a class="thired_btn" href="">Create account</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="offers_sec">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-6 col-7" data-aos="fade-up" data-aos-duration="500">
          <div class="heading_hp">
            <h2>Offers</h2>
          </div>
        </div> 
        <div class="col-md-6 col-5 text-end" data-aos="fade-up" data-aos-duration="1000">
          <a class="red_btn" href=""><span>View All</span></a>
        </div>            
        <div class="offer_slider mt-4">
          <div class="offer_slid">
            <div class="offer_box">
              <div class="offer_img">
                <a href="">
                  <img src="{{asset('frontend_assets/images/offers.jpg')}}" alt=""/>
                </a>
              </div>                  
              <div class="offer_text">
                <h4><a href="">This month’s discount - 50%</a></h4>                    
              </div>
            </div>
          </div>
          <div class="offer_slid">
            <div class="offer_box">
              <div class="offer_img">
                <a href="">
                  <img src="{{asset('frontend_assets/images/offers.jpg')}}" alt=""/>
                </a>
              </div>                  
              <div class="offer_text">
                <h4><a href="">This month’s discount - 30%</a></h4>                    
              </div>
            </div>
          </div>
          <div class="offer_slid">
            <div class="offer_box">
              <div class="offer_img">
                <a href="">
                  <img src="{{asset('frontend_assets/images/offers.jpg')}}" alt=""/>
                </a>
              </div>                  
              <div class="offer_text">
                <h4><a href="">This month’s discount - 20%</a></h4>                    
              </div>
            </div>
          </div>              
        </div>
      </div>
    </div>
  </section>
  <section class="best_selling_sec">
    <div class="container-fluid">
      <div class="row align-items-center mb-4">
        <div class="col-md-12" data-aos="fade-up" data-aos-duration="500">
          <div class="heading_hp">
            <h2>Top - 10 Best Selling Products</h2>
          </div>
        </div>
      </div>
      <div class="row row-cols-1 row-cols-lg-2 align-items-center best_sell">
        <div class="col mb-4" data-aos="fade-up" data-aos-duration="500">
          <div class="best_seling_box">
            <div class="row">
              <div class="col-lg-4 col-md-6 pe-3 pe-lg-0">
                <div class="card_img">
                  <a href="">
                    <img src="{{asset('frontend_assets/images/best_sell.jpg')}}" alt=""/>
                  </a>
                </div>
              </div>
              <div class="col-lg-8 col-md-6 ps-3 ps-lg-0">
                <div class="card_text">
                  <div class="wish">
                    <a href=""><i class="fa-solid fa-heart"></i></a>
                  </div>
                  <h4><a href="">Reaper Skull Angel and Demon 3D All Over Printed</a></h4>
                  <div class="card_star">
                    <ul>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                    </ul>
                  </div>
                  <h3>Price $34.75</h3>
                  <div class="cart">
                    <a href=""><i class="fa-solid fa-bag-shopping"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col mb-4" data-aos="fade-up" data-aos-duration="500">
          <div class="best_seling_box">
            <div class="row">
              <div class="col-lg-4 col-md-6 pe-3 pe-lg-0">
                <div class="card_img">
                  <a href="">
                    <img src="{{asset('frontend_assets/images/best_sell1.jpg')}}" alt=""/>
                  </a>
                </div>
              </div>
              <div class="col-lg-8 col-md-6 ps-3 ps-lg-0">
                <div class="card_text">
                  <div class="wish">
                    <a href=""><i class="fa-solid fa-heart"></i></a>
                  </div>
                  <h4><a href="">Reaper Skull Angel and Demon 3D All Over Printed</a></h4>
                  <div class="card_star">
                    <ul>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                    </ul>
                  </div>
                  <h3>Price $34.75</h3>
                  <div class="cart">
                    <a href=""><i class="fa-solid fa-bag-shopping"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col mb-4" data-aos="fade-up" data-aos-duration="500">
          <div class="best_seling_box">
            <div class="row">
              <div class="col-lg-4 col-md-6 pe-3 pe-lg-0">
                <div class="card_img">
                  <a href="">
                    <img src="{{asset('frontend_assets/images/best_sell2.jpg')}}" alt=""/>
                  </a>
                </div>
              </div>
              <div class="col-lg-8 col-md-6 ps-3 ps-lg-0">
                <div class="card_text">
                  <div class="wish">
                    <a href=""><i class="fa-solid fa-heart"></i></a>
                  </div>
                  <h4><a href="">Reaper Skull Angel and Demon 3D All Over Printed</a></h4>
                  <div class="card_star">
                    <ul>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                    </ul>
                  </div>
                  <h3>Price $34.75</h3>
                  <div class="cart">
                    <a href=""><i class="fa-solid fa-bag-shopping"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col mb-4" data-aos="fade-up" data-aos-duration="500">
          <div class="best_seling_box">
            <div class="row">
              <div class="col-lg-4 col-md-6 pe-3 pe-lg-0">
                <div class="card_img">
                  <a href="">
                    <img src="{{asset('frontend_assets/images/best_sell3.jpg')}}" alt=""/>
                  </a>
                </div>
              </div>
              <div class="col-lg-8 col-md-6 ps-3 ps-lg-0">
                <div class="card_text">
                  <div class="wish">
                    <a href=""><i class="fa-solid fa-heart"></i></a>
                  </div>
                  <h4><a href="">Reaper Skull Angel and Demon 3D All Over Printed</a></h4>
                  <div class="card_star">
                    <ul>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                    </ul>
                  </div>
                  <h3>Price $34.75</h3>
                  <div class="cart">
                    <a href=""><i class="fa-solid fa-bag-shopping"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>            
      </div>          
    </div>
  </section>
  <section class="blog_sec">
    <div class="container-fluid">
      <div class="row align-items-center mb-4">
        <div class="col-md-6 col-7" data-aos="fade-up" data-aos-duration="500">
          <div class="heading_hp">
            <h2>Latest Blogs</h2>
          </div>
        </div> 
        <div class="col-md-6 col-5 text-end" data-aos="fade-up" data-aos-duration="1000">
          <a class="red_btn" href=""><span>View All</span></a>
        </div>
      </div>
    </div>
    <div class="bg_blog">
      <div class="blog_slider">
        <div class="blog_slid">
          <div class="blog_box">
            <div class="row align-items-center">
              <div class="col-md-8 order-2 order-md-1">
                <div class="blog_text">
                  <h4><a href="">Reaper Skull Angel and Demon 3D All Over Printed</a></h4>
                  <span>27 th Nov’22</span>
                  <p>Lorem ipsum dolor sit amet consectetur. Lacus egestas odio ut enim. Mus diam rhoncus viverra varius amet tellus orci. Enim vestibulum ornare vulputate ornare egestas purus dolor.</p>
                  <a href="" class="read_more">READ MORE</a>
                </div>
              </div>
              <div class="col-md-4 order-1 order-md-2">
                <div class="blog_img">
                  <a href="">
                    <img src="{{asset('frontend_assets/images/offers.jpg')}}" alt=""/>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="blog_slid">
          <div class="blog_box">
            <div class="row align-items-center">
              <div class="col-md-8 order-2 order-md-1">
                <div class="blog_text">
                  <h4><a href="">Reaper Skull Angel and Demon 3D All Over Printed</a></h4>
                  <span>27 th Nov’22</span>
                  <p>Lorem ipsum dolor sit amet consectetur. Lacus egestas odio ut enim. Mus diam rhoncus viverra varius amet tellus orci. Enim vestibulum ornare vulputate ornare egestas purus dolor.</p>
                  <a href="" class="read_more">READ MORE</a>
                </div>
              </div>
              <div class="col-md-4 order-1 order-md-2">
                <div class="blog_img">
                  <a href="">
                    <img src="{{asset('frontend_assets/images/offers.jpg')}}" alt=""/>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="blog_slid">
          <div class="blog_box">
            <div class="row align-items-center">
              <div class="col-md-8 order-2 order-md-1">
                <div class="blog_text">
                  <h4><a href="">Reaper Skull Angel and Demon 3D All Over Printed</a></h4>
                  <span>27 th Nov’22</span>
                  <p>Lorem ipsum dolor sit amet consectetur. Lacus egestas odio ut enim. Mus diam rhoncus viverra varius amet tellus orci. Enim vestibulum ornare vulputate ornare egestas purus dolor.</p>
                  <a href="" class="read_more">READ MORE</a>
                </div>
              </div>
              <div class="col-md-4 order-1 order-md-2">
                <div class="blog_img">
                  <a href="">
                    <img src="{{asset('frontend_assets/images/offers.jpg')}}" alt=""/>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>            
      </div>
    </div>        
  </section> 


@endsection

@push('scripts')
@endpush