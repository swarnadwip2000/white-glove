@extends('frontend.layouts.master')
@section('meta')
@endsection
@section('title')
White Globe | HOME
@endsection
@push('styles')
@endpush

@php
    use Illuminate\Support\Facades\Storage;
    use App\Helpers\Wish;
    use App\Helpers\AddToCart;
@endphp


@section('content')
<section class="inner_banner_sec">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="inner_banner_ontent">
              <h1>Our Products</h1>
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
            @foreach($categories as $category)
          <div class="cata_box">
            <a href="{{ route('product',$category['slug']) }}">
              <div class="cata_img">
                <img src="{{ Storage::url($category['image']) }}" alt=""/>
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
      <div class="row">                  
        <div class="col-md-12">
          <div class="row justify-content-end align-items-center mb-4">
            <div class="col-xl-6 col-lg-6">
              <div class="inner_search_box">
                <div class="search_box">
                  <div class="search_field">                        
                    <input type="text" class="input" placeholder="Search">
                    <button type="submit"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="d-flex align-items-center justify-content-end">
                <div class="me-2">Sort By: </div>
                <div class="all_select">
                  <select class="form-select" aria-label="">
                    <option selected="">Popular</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
              </div>                    
            </div>
          </div>
          @if($products->count() > 0)
          <div class="row justify-content-center align-items-center mb-3">
            <div class="col-xl-12 col-lg-12 text-center">
              <div class="silver_age">
                @if( $single_category == 'All Products')
                <h4>{{ $single_category }}</h4>
                @else
                <h4>{{ $single_category['name'] }}</h4>
                @endif
                <p>Showing 1 – 9 Packages of {{$products->count()}} results for “@if( $single_category == 'All Products') {{ $single_category }} @else {{$single_category['name']}} @endif”</p>
                
              </div>
            </div>
          </div>
          <div class="row row-cols-1 row-cols-xxl-5 row-cols-xl-4 row-cols-lg-2">
            @foreach($products as $product)
            <div class="col mb-4 mb-xl-5">
              <div class="card_box">
                <div class="wish_cart">
                  <div class="wish">
                    @if (Auth::check() && Auth::user()->hasRole('CUSTOMER'))
                    <a href="javascript:void(0);" class="add-wishlist @if((Wish::wishListCount($product['id'], Auth::user()->id)) > 0) active-wishlist @endif" id="wish-{{ $product['id'] }}" data-wish="{{ $product['id'] }}" ><i class="fa-solid fa-heart"></i></a>
                    @else
                    <a href="{{ route('login') }}" class=""><i class="fa-regular fa-heart"></i></a>
                    @endif
                  </div>                    
                </div> 
                <div class="card_img">
                  <a href="{{ route('product-detail',$product['id']) }}">
                    <img src="{{ Storage::url($product['image']) }}" alt=""/>
                  </a>
                </div>                  
                <div class="card_text">
                  <h4><a href="{{ route('product-detail',$product['id']) }}">{{ $product['name'] }}</a></h4>
                  <div class="card_star">
                    <ul>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                      <li><i class="fa-solid fa-star"></i></li>
                    </ul>
                  </div>
                  <div class="price my-2">Price: ${{ $product['discounted_price'] }} <strike class="original-price">${{ $product['price'] }}</strike></div>
                
                  <div class="cart">
                    @if(AddToCart::CheckCartItem($product['id']) > 0)
                    <a href="{{ route('cart') }}"><i class="fa-solid fa-cart-shopping"></i></a>
                    @else
                    <div class="cart-disable-{{ $product['id'] }}">
                    <a href="javascript:void(0);" data-route="{{ route('add-to-cart') }}" class="add-cart" data-id="{{ $product['id'] }}"><i class="fa-solid fa-cart-shopping"></i></a>
                  </div>
                  @endif
                  </div>
                </div>
              </div>
            </div>
           @endforeach 
          </div>
          <div class="">
            {!! $products->links() !!}
          </div>
          @else
          <div>
            <h4>No Product Found</h4>
          </div>
          @endif
        </div>
      </div>
    </div>
  </section>

  @endsection

  @push('scripts')
  <script>
  $('.add-cart').on('click', function(){
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
        success: function(response){
            // console.log(response);
            if(response.status == 'success'){
                $('.cart-disable-'+product_id).html('<a href="{{ route('cart') }}"><i class="fa-solid fa-cart-shopping"></i>Go to Cart</a>');
                toastr.success(response.message);
            } else {
                toastr.error(response.message);
            }
        }
    });
});
</script>
@endpush