@extends('frontend.layouts.master')
@section('meta')
@endsection
@section('title')
    {{ env('APP_NAME') }} | HOME
@endsection
@push('styles')
@endpush
@php
    use Illuminate\Support\Facades\Storage;
    use App\Helpers\Wish;
    use App\Helpers\AddToCart;
@endphp

@section('content')
    <section class="banner__slider banner_sec">
        <div class="slider stick-dots">
            <div class="slide">
                <div class="slide__content slide__content__left">
                    <div class="slide__content--headings text-left">
                        <h2 class="animated title" data-animation-in="fadeInUp">{{ $homeCms->banner_title }}</h2>
                        <p class="animated top-title" data-animation-in="fadeInUp" data-delay-in="0.3">
                            {{ $homeCms->banner_description }}</p>
                        <div class="hero-text mb-3" data-animation-in="fadeInUp" data-delay-in="0.6">
                            <a class="red_btn" href="{{ route('product', ['slug' => 'all-products']) }}">Explore Now</a>
                        </div>
                    </div>
                </div>
                <div class="banner_img">
                    @foreach ($categories->take(3) as $category)
                        <div class="banner_right_img">
                            <a href="">
                                <img src="" alt="" data-lazy="{{ Storage::url($category['image']) }}"
                                    class="full-image animated" data-animation-in="fadeInUp" data-delay-in="0.3" />
                                <span class="full-image animated" data-animation-in="fadeInUp"
                                    data-delay-in="0.5"><b>{{ $category->name }}</b></span>
                            </a>
                        </div>
                        {{-- <div class="banner_right_img">
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
              </div> --}}
                    @endforeach
                </div>
            </div>
            <div class="slide">
                <div class="slide__content slide__content__left">
                    <div class="slide__content--headings text-left">
                        <h2 class="animated title" data-animation-in="fadeInUp">{{ $homeCms->banner_title }} </h2>
                        <p class="animated top-title" data-animation-in="fadeInUp" data-delay-in="0.3">
                            {{ $homeCms->banner_description }}</p>
                        <div class="hero-text mb-3" data-animation-in="fadeInUp" data-delay-in="0.6">
                            <a class="red_btn" href="{{ route('product', ['slug' => 'all-products']) }}">Explore Now</a>
                        </div>
                    </div>
                </div>
                <div class="banner_img">
                    @foreach ($categories->take(3) as $category)
                        <div class="banner_right_img">
                            <a href="">
                                <img src="" alt="" data-lazy="{{ Storage::url($category['image']) }}"
                                    class="full-image animated" data-animation-in="fadeInUp" data-delay-in="0.3" />
                                <span class="full-image animated" data-animation-in="fadeInUp"
                                    data-delay-in="0.5"><b>{{ $category->name }}</b></span>
                            </a>
                        </div>
                    @endforeach
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
                    @foreach ($categories as $category)
                        <div class="cata_box">
                            <a href="{{ route('product', $category['slug']) }}">
                                <div class="cata_img">
                                    <img src="{{ Storage::url($category['image']) }}" alt="" />
                                </div>
                                <h5>{{ $category['name'] }}</h5>
                            </a>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </section>
    <section class="can_bis_2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="cannabis_tow_box">
                        <div class="can_img"><img src="{{ Storage::url($homeCms['section_2_image']) }}" alt="" />
                        </div>
                        <div class="position-relative">
                            <div class="row justify-content-end">
                                <div class="col-lg-6">
                                    <div class="heading_hp text_white">
                                        <h2>{{ $homeCms->section_2_title }}</h2>
                                        <a class="sec_btn"
                                            href="{{ route('product', ['slug' => 'all-products']) }}"><span>Shop
                                                Now</span></a>
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
                    <a class="red_btn" href="{{ route('product', ['slug' => 'featured']) }}"><span>view all</span></a>
                </div>
                <div class="product_slider mt-4">
                    @foreach ($featured_products as $product)
                        <div class="product_slid">
                            <div class="card_box">
                                <div class="wish_cart">
                                    <div class="wish">

                                        @if (Auth::check() && Auth::user()->hasRole('CUSTOMER'))
                                            <a href="javascript:void(0);"
                                                class="add-wishlist @if (Wish::wishListCount($product['id'], Auth::user()->id) > 0) active-wishlist @endif"
                                                id="wish-{{ $product['id'] }}" data-wish="{{ $product['id'] }}"><i
                                                    class="fa-solid fa-heart"></i></a>
                                        @else
                                            <a href="{{ route('login') }}" class=""><i
                                                    class="fa-regular fa-heart"></i></a>
                                        @endif
                                    </div>
                                </div>
                                <div class="card_img">
                                    <a
                                        href="{{ route('product-detail', ['slug' => $product['slug'], 'id' => encrypt($product['id'])]) }}">
                                        <img src="{{ Storage::url($product['image']) }}" alt="" />
                                    </a>
                                </div>
                                <div class="card_text">
                                    <h4><a
                                            href="{{ route('product-detail', ['slug' => $product['slug'], 'id' => encrypt($product['id'])]) }}">{!! Str::limit($product['name'], 26, ' ...') !!}</a>
                                    </h4>

                                    <div class="card_star">
                                        @if ($product->getReview($product['id']) != 0)
                                            <ul>
                                                @php
                                                    $count = 1;
                                                @endphp
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= round($product->getReview($product['id'])))
                                                        <li><i class="fa-solid fa-star"></i></li>
                                                    @else
                                                        <li> <i class="fa-solid fa-star"
                                                                style="color: #bbb9ad !important;"></i></li>
                                                    @endif
                                                    @php
                                                        $count++;
                                                    @endphp
                                                @endfor

                                            </ul>
                                        @else
                                            <ul>
                                                <li><i class=""> </i></li>
                                                <li><i class=""> </i></li>
                                                <li><i class=""> </i></li>
                                                <li><i class=""> </i></li>
                                                <li><i class=""> </i></li>
                                            </ul>
                                        @endif
                                    </div>
                                    <div class="price my-2"><b>Price: ${{ $product['discounted_price'] }}</b>
                                        <strike class="original-price">${{ $product['price'] }}</strike>
                                        @if (AddToCart::CheckStock($product['id']) == 0)<span class="outstock">Out of stock</span>@endif
                                    </div>
                                    <div class="cart">
                                        @if (AddToCart::CheckCartItem($product['id']) > 0)
                                            <a href="{{ route('cart') }}"><i class="fa-solid fa-cart-shopping"></i></a>
                                        @else
                                            <div class="cart-disable-{{ $product['id'] }}">
                                                <a href="javascript:void(0);" data-route="{{ route('add-to-cart') }}"
                                                    class="add-cart" data-id="{{ $product['id'] }}"><i
                                                        class="fa-solid fa-cart-shopping"></i></a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <section class="online_book_fire">
        <div class="online_book_bg">
            <img src="{{ Storage::url($homeCms['section_3_image']) }}" alt="" />
        </div>
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-lg-4">
                    <div class="border_b">
                        <div class="heading_hp text_white text-center">
                            <h2>{{ $homeCms->section_3_title }}</h2>
                            <p>{!! $homeCms->section_3_description !!}</p>
                            <a class="thired_btn" href="{{ route('login') }}">Create account</a>
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
                    <a class="red_btn" href="{{ route('product', ['slug' => 'all-products']) }}"><span>View All</span></a>
                </div>
                <div class="offer_slider mt-4">
                    @foreach ($offers->take(3) as $offer)
                        <div class="offer_slid">
                            <div class="offer_box">
                                <div class="offer_img">
                                    <a href="">
                                        <img src="{{ Storage::url($offer['image']) }}" alt="" />
                                    </a>
                                </div>
                                <div class="offer_text">
                                    <h4><a href="">{{ $offer->title }}</a></h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="offer_slid">
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
          </div>               --}}
                </div>
            </div>
        </div>
    </section>
    <section class="best_selling_sec">
        <div class="container-fluid">
            <div class="row align-items-center mb-4">
                <div class="col-md-12" data-aos="fade-up" data-aos-duration="500">
                    <div class="heading_hp">
                        <h2>Top - 4 Best Selling Products</h2>
                    </div>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-lg-2 align-items-center best_sell">
                @foreach($best_selling->take(4) as $sell_product)
                <div class="col mb-4" data-aos="fade-up" data-aos-duration="500">
                    <div class="best_seling_box">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 pe-3 pe-lg-0">
                                <div class="card_img">
                                    <a href="{{ route('product-detail', ['slug' => $sell_product['product']['slug'], 'id' => encrypt($sell_product['product']['id'])]) }}">
                                        <img src="{{ Storage::url($sell_product['product']['image']) }}" alt="" />
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-6 ps-3 ps-lg-0">
                                <div class="card_text">
                                    <div class="wish">
                                        @if (Auth::check() && Auth::user()->hasRole('CUSTOMER'))
                                        <a href="javascript:void(0);"
                                            class="add-wishlist @if (Wish::wishListCount($sell_product['product']['id'], Auth::user()->id) > 0) active-wishlist @endif"
                                            id="wish-{{ $sell_product['product']['id'] }}" data-wish="{{ $sell_product['product']['id'] }}"><i
                                                class="fa-solid fa-heart"></i></a>
                                        @else
                                            <a href="{{ route('login') }}" class=""><i
                                                    class="fa-regular fa-heart"></i></a>
                                        @endif
                                    </div>
                                    <h4><a href="{{ route('product-detail', ['slug' => $sell_product['product']['slug'], 'id' => encrypt($sell_product['product']['id'])]) }}">{{ $sell_product['product']['name'] }}</a></h4>
                                    
                                    <div class="card_star">
                                        @if ($sell_product->product->getReview($sell_product->product['id']) != 0)
                                        <ul>
                                            @php
                                                $count = 1;
                                            @endphp
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= round($sell_product->product->getReview($sell_product->product->id)))
                                                    <li><i class="fa-solid fa-star"></i></li>
                                                @else
                                                    <li> <i class="fa-solid fa-star"
                                                            style="color: #bbb9ad !important;"></i></li>
                                                @endif
                                                @php
                                                    $count++;
                                                @endphp
                                            @endfor
                                        </ul>
                                        @else
                                            <ul>
                                                <li><i class=""> </i></li>
                                                <li><i class=""> </i></li>
                                                <li><i class=""> </i></li>
                                                <li><i class=""> </i></li>
                                                <li><i class=""> </i></li>
                                            </ul>
                                        @endif
                                    </div>
                                    <h3>Price: ${{ $sell_product['product']['discounted_price'] }}</h3>
                                    <div class="my-2">
                                    @if (AddToCart::CheckStock($sell_product['product']['id']) == 0)
                                        <span class="outstock"> Out of stock</span>
                                    @endif
                                    </div>
                                    <div class="cart">
                                        @if (AddToCart::CheckCartItem($sell_product['product']['id']) > 0)
                                            <a href="{{ route('cart') }}"><i class="fa-solid fa-cart-shopping"></i></a>
                                        @else
                                            <div class="cart-disable-{{ $sell_product['product']['id'] }}">
                                                <a href="javascript:void(0);" data-route="{{ route('add-to-cart') }}"
                                                    class="add-cart" data-id="{{ $sell_product['product']['id'] }}"><i
                                                        class="fa-solid fa-cart-shopping"></i></a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- <div class="col mb-4" data-aos="fade-up" data-aos-duration="500">
                    <div class="best_seling_box">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 pe-3 pe-lg-0">
                                <div class="card_img">
                                    <a href="">
                                        <img src="{{ asset('frontend_assets/images/best_sell1.jpg') }}" alt="" />
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
                                        <img src="{{ asset('frontend_assets/images/best_sell2.jpg') }}" alt="" />
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
                                        <img src="{{ asset('frontend_assets/images/best_sell3.jpg') }}" alt="" />
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
                </div> --}}
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
                    <a class="red_btn" href="{{ route('blogs') }}"><span>View All</span></a>
                </div>
            </div>
        </div>
        <div class="bg_blog">
            <div class="blog_slider">
                @foreach ($blogs as $blog)
                    <div class="blog_slid">
                        <div class="blog_box">
                            <div class="row align-items-center">
                                <div class="col-md-8 order-2 order-md-1">
                                    <div class="blog_text">
                                        <h4><a
                                                href="{{ route('blog-detail', ['slug' => $blog['slug'], 'id' => encrypt($blog['id'])]) }}">{{ $blog->name }}</a>
                                        </h4>
                                        <span>{{ date('d M, Y', strtotime($blog->updated_at)) }}</span>
                                        <p>{!! Str::limit($blog->description, 200, ' ...') !!}</p>
                                        <a href="{{ route('blog-detail', ['slug' => $blog['slug'], 'id' => encrypt($blog['id'])]) }}"
                                            class="read_more">READ MORE</a>
                                    </div>
                                </div>
                                <div class="col-md-4 order-1 order-md-2">
                                    <div class="blog_img">
                                        <a
                                            href="{{ route('blog-detail', ['slug' => $blog['slug'], 'id' => encrypt($blog['id'])]) }}">
                                            <img src="{{ Storage::url($blog->image) }}" alt="" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="blog_slid">
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
        </div>             --}}
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.add-wishlist').on('click', function() {
                var id = $(this).data('wish');
                var url = "{{ route('update-wishlist') }}";

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    success: function(response) {
                        if (response.action == 'added') {
                            $('a[data-wish=' + id + ']').addClass('active-wishlist');
                            $('#wish-item').text(response.count);
                            toastr.success('Product added to wishlist successfully');
                        } else {
                            $('a[data-wish=' + id + ']').removeClass('active-wishlist');
                            $('#wish-item').text(response.count);
                            toastr.success('Product removed from wishlist successfully');
                        }
                    }
                });
            });


            $('.add-cart').on('click', function() {
                var route = $(this).data('route');
                var quantity = 1;
                var product_id = $(this).data('id');
                // alert(product_id);   
                $.ajax({
                    url: route,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        quantity: quantity,
                        product_id: product_id
                    },
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 'success') {
                            $('.cart-disable-' + product_id).html(
                                '<a href="{{ route('cart') }}"><i class="fa-solid fa-cart-shopping"></i>Go to Cart</a>'
                                );
                            console.log(response.count);
                            $('#cart-item').text(response.count);
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    }
                });
            });
        });
    </script>
@endpush

