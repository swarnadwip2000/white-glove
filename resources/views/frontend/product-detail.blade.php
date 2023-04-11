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
    use App\Helpers\AddToCart;
    use App\Helpers\Wish;
@endphp


@section('content')
    <section class="inner_banner_sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner_banner_ontent">
                        <h1>Product Details</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="all_catagory">
        <div class="container-fluid">
            <div class="inner_cata_box">
                <div class="heading_hp mb-4 text-center">
                    <h2>Categories</h2>
                </div>
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
    <section class="catagory_sec">
        <div class="container-fluid">
            <div class="row details-snippet1">
                <div class="col-md-5">
                    <div class="slider_left">
                        <div class="slider-for">
                            <div class="slid_big_img">
                                <img src="{{ Storage::url($product['image']) }}" />
                            </div>
                        </div>
                        <!-- <div class="slider-nav">
                  <div class="small_box_img">
                    <div class="slid_small_img">
                      <img src="assets/images/featured_product1.jpg"/>
                    </div>
                  </div>
                  <div class="small_box_img">
                    <div class="slid_small_img">
                      <img src="assets/images/featured_product1.jpg"/>
                    </div>
                  </div>
                  <div class="small_box_img">
                    <div class="slid_small_img">
                      <img src="assets/images/featured_product1.jpg"/>
                    </div>
                  </div>
                  <div class="small_box_img">
                    <div class="slid_small_img">
                      <img src="assets/images/featured_product1.jpg"/>
                    </div>
                  </div>
                </div> -->
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- <div class="category"><span class="theme-text">Category:</span> Flower</div> -->
                    <div class="title">{{ $product['name'] }}</div>
                    <div class="ratings my-2">
                        <div class="stars d-flex">
                            <div class="theme-text me-2">Product Ratings: </div>
                            <div>&#9733;</div>
                            <div>&#9733;</div>
                            <div>&#9733;</div>
                            <div>&#9733;</div>
                            <div>&#9733;</div>
                            <div class="ms-2">({{ $product->getReview($product['id']) }}) {{ count($reviews) }} Reviews</div>
                        </div>
                    </div>

                    <div class="price my-2">Price: ${{ $product['discounted_price'] }} <strike
                            class="original-price">${{ $product['price'] }}</strike></div>
                    <!-- <div class="theme-text subtitle">Brief Description:</div> -->
                    <div class="brief-description">
                        {!! $product['specification'] !!}
                              {{-- <ul>
                      <li>Written by VICTOR GISCHLER</li>
                      <li>Penciled by CHRIS BACHALO</li>
                      <li>Cover by TERRY DODSON</li>
                    </ul> --}}
                    </div>
                    <hr>
                    <div class="d-flex justify-content-start align-items-center">
                        <div class="quentity_de">
                            <span>Quantity:</span>
                        </div>
                        <div class="small_number me-3">
                            <form>
                                <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value"><i
                                        class="fa-solid fa-minus"></i></div>
                                <input type="number" id="number" value="1" min="1" />
                                <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value"><i
                                        class="fa-solid fa-plus"></i></div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-start align-items-center">
                        {{-- <div class="small_number me-3">
                  <input type="number" id="product-quantity" class="form-control" value="1" min="1">
              </div> --}}
                        <div class="me-3 {{ AddToCart::CheckStock($product['id']) == 0 ? 'disabledbutton' : '' }}">
                            @if (AddToCart::CheckCartItem($product['id']) > 0)
                                <a href="{{ route('cart') }}" class="red_btn black_bg"><span><i
                                            class="fa-solid fa-cart-shopping"></i> Go to Cart</span></a>
                            @else
                                <div id="cart-disable">
                                    <a href="javascript:void(0);" id="add-cart" data-route="{{ route('add-to-cart') }}"
                                        class="red_btn black_bg"><span><i class="fa-solid fa-cart-shopping"></i> Add to
                                            Cart</span></a>
                                </div>
                            @endif
                        </div>
                        <div class="{{ AddToCart::CheckStock($product['id']) == 0 ? 'disabledbutton' : '' }}"><a
                                href="{{ route('checkout', $product['id']) }}" class="red_btn"><span><i
                                        class="fa-solid fa-bag-shopping"></i>
                                    Buy Now</span></a></div>

                    </div>
                    <div class="my-2">
                        @if (AddToCart::CheckStock($product['id']) == 0)
                            <span class="outstock"><i class='fas fa-frown' style='color:red'></i> Out Of Stocks</span>
                        @endif
                    </div>
                </div>

            </div>
            <div class="additional-details my-5 text-left">
                <!-- Nav pills -->
                <ul class="nav nav-tabs justify-content-start">
                    <li class="nav-tabs">
                        <a class="nav-link active" data-toggle="tab" data-bs-toggle="tab" href="#home">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" data-bs-toggle="tab" href="#menu1">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" data-bs-toggle="tab" href="#menu2">Specifications</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content mt-4 mb-3">
                    <div class="tab-pane active" id="home">
                        <div class="description">
                            {!! $product['description'] !!}
                        </div>
                    </div>
                    <div class="tab-pane container fade" id="menu1">
                        <div class="review">
                            <div class="pure_tab">
                                <form id="review-form" action="javascript:void(00);" method="post">
                                    <h2>Write Your Review</h2>
                                    <div class="rate">
                                        <input type="radio" checked id="star5" class="rate" name="rating"
                                            value="5" />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" class="rate" name="rating"
                                            value="4" />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" class="rate" name="rating"
                                            value="3" />
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" class="rate" name="rating"
                                            value="2">
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" class="rate" name="rating"
                                            value="1" />
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                    <div class="form-group">
                                        {{-- <label class="control-label" for="review">Your Review:</label> --}}
                                        <textarea class="form-control" rows="5" placeholder="Write your review..." name="review" id="comment"></textarea>
                                        <span id="reviewInfo" class="help-block pull-right">
                                    </div>
                                    @if (Auth::check() && Auth::user()->hasRole('CUSTOMER'))
                                        <a href="javascript:void(0);" class="red_btn mb-5 submit-btn"
                                            data-route=""><span>Submit</span></a>
                                    @else
                                        <a href="{{ route('login') }}" class="red_btn mb-5"><span>Submit</span></a>
                                    @endif
                                </form>

                                <div id="reviews-testmonial">
                                    @include('frontend.product-reviews')
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="menu2">
                        <div class="specification">
                            {!! $product['specification'] !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="related-products details-snippet1">
                <div class="heading_hp">
                    <h2>Related <span>Products</span></h2>
                </div>
                <div class="related_product_slid">
                    @foreach ($related_products as $pro)
                        <div class="slid_rel">
                            <div class="card_box">
                                <div class="wish_cart">
                                    <div class="wish">
                                        <a href=""><i class="fa-solid fa-heart"></i></a>
                                    </div>
                                </div>
                                <div class="card_img">
                                    <a
                                        href="{{ route('product-detail', ['slug' => $pro['slug'], 'id' => encrypt($pro['id'])]) }}">
                                        <img src="{{ Storage::url($pro['image']) }}" alt="" />
                                    </a>
                                </div>
                                <div class="card_text">
                                    <h4><a
                                            href="{{ route('product-detail', ['slug' => $pro['slug'], 'id' => encrypt($pro['id'])]) }}">{{ $pro['name'] }}</a>
                                    </h4>
                                    <div class="card_star">
                                        @if ($pro->getReview($pro['id']) != 0)
                                <ul>
                                    @php
                                        $count = 1;
                                    @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= round($pro->getReview($pro->id)))
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
                                    <h3>Price: ${{ $pro['discounted_price'] }} <strike class="original-price">${{ $pro['price'] }}</strike></h3>
                                    <div class="cart">
                                        <a
                                            href="{{ route('product-detail', ['slug' => $pro['slug'], 'id' => encrypt($pro['id'])]) }}"><i
                                                class="fa-solid fa-bag-shopping"></i> Add</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#add-cart').on('click', function() {

                var route = $(this).data('route');
                var quantity = $('#number').val();
                var product_id = {{ $product['id'] }};

                $.ajax({
                    url: route,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        quantity: quantity,
                        product_id: product_id
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status == 'success') {
                            $('#cart-disable').html(
                                '<a href="{{ route('cart') }}" class="red_btn black_bg"><span><i class="fa-solid fa-cart-shopping"></i> Go to Cart</span></a>'
                                );
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

    <script>
        $(document).ready(function() {
            $('.submit-btn').on('click', function() {
                var route = $(this).data('route');
                var review = $('#comment').val();
                var rating = $('input[name=rating]:checked').val();
                var product_id = {{ $product['id'] }};
                var url = "{{ route('product.reviews') }}";


                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "review": review,
                        "rating": rating,
                        "product_id": product_id
                    },
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 'success') {
                            $('#comment').val('');
                            $('#reviews-testmonial').html(response.view);
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.error);
                        }
                    }
                });
            });
        });
    </script>
@endpush
