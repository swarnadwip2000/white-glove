
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
              <h1>Wishlist</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="cart_sec">          
    <div class="container">
      <div class="cart_box">
        <div class="row"> 
          <div class="col-lg-12">
            @if (count($products) > 0)
            @foreach($products as $item)
              <div class="cart_left_box mb-4" id="remove-{{ $item['id'] }}">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="left_img_text">
                    <div class="cart_small_img">
                      <img src="{{ Storage::url($item['image']) }}" alt=""/>
                    </div>
                    <div class="img_left_text">
                      <h5>{{ $item['name'] }}</h5>
                       @if(AddToCart::CheckStock($item['id']) == 0)<span class="outstock">Out of
                          stock</span>@endif</span>
                      <ul>
                          <li><a href="javascript:void(0);" data-id="{{ $item['id'] }}" class="remove-product" data-route="{{ route('delete-wishlist', $item['id']) }}"><i class="fa-solid fa-trash"></i> Remove</a></li>
                          @if(AddToCart::CheckCartItem($item['id']) > 0)
                              <li><a href="{{ route('cart') }}"><i class="fa-solid fa-cart-shopping"></i>Go to Cart</a></li>
                          @else
                              <li class="cart-disable-{{ $item['id'] }} {{ AddToCart::CheckStock($item['id']) == 0 ? 'disabledbutton' : '' }}"><a href="javascript:void(0)" data-route="{{ route('add-to-cart') }}" data-id="{{ $item['id'] }}" class="add-cart"><i class="fa-solid fa-cart-shopping"></i>Add to Cart</a></li>
                          @endif
                      </ul>
                  </div>
                  </div>
                  <div class="right_text">
                    <div class="price my-2">${{ $item['discounted_price'] }} <strike class="original-price">${{ $item['price'] }}</strike></div>
                  </div>
                </div>
              </div> 
            @endforeach
            @else
            <div>
                <h3 class="text-center">No products in wishlist</h3>
            </div>
            @endif                     
          </div>                
        </div>
      </div>
    </div>
  </section>

  @endsection

  @push('scripts')
  <script>
     $(document).ready(function(){
      $('.remove-product').on('click', function(){
        var route = $(this).data('route');
        var product_id = $(this).data('id');
        // alert(product_id);   
        $.ajax({
            url: route,
            type: 'GET',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: product_id
            },
            success: function(response){
                // console.log(response);
                if(response.status == true){
                    $('#remove-'+product_id).remove();
                    toastr.success('Product removed from wishlist');
                } else {
                    toastr.error('Something went wrong');
                }
            }
        });
    });

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
    });
  </script>
@endpush