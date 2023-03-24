
@extends('frontend.layouts.master')
@section('meta')
@endsection
@section('title')
White Globe | HOME
@endsection
@push('styles')
@endpush


@section('content')

<section class="inner_banner_sec">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="inner_banner_ontent">
              <h1>Cart</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="cart_sec">          
    <div class="container">
      <div class="cart_box">
        <div class="row" id="cart-items">
          @include('frontend.cart-items')
          {{-- <div class="col-lg-8">
            <div class="cart_left_box mb-4">
              <div class="d-block d-lg-flex justify-content-between align-items-center">
                <div class="left_img_text">
                  <div class="cart_small_img">
                    <img src="assets/images/featured_product.jpg" alt=""/>
                  </div>
                  <div class="img_left_text">
                    <h5>Lorem ipsum dolor</h5>
                    <span>27% THC</span>
                    <ul>
                      <li><a href=""><i class="fa-solid fa-trash"></i> Remove</a></li>
                      <li><a href=""><i class="fa-solid fa-heart"></i> Move to Wishlist</a></li>
                    </ul>
                  </div>
                </div>
                <div class="small_number">
                  <form>
                    <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value"><i class="fa-solid fa-minus"></i></div>
                    <input type="number" id="number" value="0" />
                    <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value"><i class="fa-solid fa-plus"></i></div>
                  </form>
                </div>
                <div class="right_text">
                  <div class="price my-2">$100.00 <strike class="original-price">$120.00</strike></div>
                </div>
              </div>
            </div>
            <div class="cart_left_box mb-4">
              <div class="d-flex justify-content-between align-items-center">
                <div class="left_img_text">
                  <div class="cart_small_img">
                    <img src="assets/images/featured_product1.jpg" alt=""/>
                  </div>
                  <div class="img_left_text">
                    <h5>Lorem ipsum dolor</h5>
                    <span>27% THC</span>
                    <ul>
                      <li><a href=""><i class="fa-solid fa-trash"></i> Remove</a></li>
                      <li><a href=""><i class="fa-solid fa-heart"></i> Move to Wishlist</a></li>
                    </ul>
                  </div>
                </div>
                <div class="small_number me-3">
                  <form>
                    <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value"><i class="fa-solid fa-minus"></i></div>
                    <input type="number" id="number" value="0" />
                    <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value"><i class="fa-solid fa-plus"></i></div>
                  </form>
                </div>
                <div class="right_text">
                  <div class="price my-2">$100.00 <strike class="original-price">$120.00</strike></div>
                </div>
              </div>
            </div>
            
          </div>
          <div class="col-lg-4">
            <div class="cart_right">
              <div class="row m-0">
                <div class="col-sm-8 p-0">
                  <h6>Subtotal</h6>
                </div>
                <div class="col-sm-4 p-0">
                  <p id="subtotal">$132.00</p>
                </div>
              </div>
              <div class="row m-0">
                <div class="col-sm-8 p-0 ">
                  <h6>Tax</h6>
                </div>
                <div class="col-sm-4 p-0">
                  <p id="tax">$6.40</p>
                </div>
              </div>
              <hr>
              <div class="row mx-0 mb-2">
                <div class="col-sm-8 p-0 d-inline">
                  <h5>Total</h5>
                </div>
                <div class="col-sm-4 p-0">
                  <p id="total">$138.40</p>
                </div>
              </div>
              <button id="btn-checkout" class="shopnow"><span>Checkout</span></button>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
  </section>

  @endsection


  @push('scripts')
  <script>
    $('.add').click(function() {
        var th = $(this).closest('.wrap').find('.count');
        th.val(+th.val() + 1);
    });

    $('.sub').click(function() {
        var th = $(this).closest('.wrap').find('.count');
        if (th.val() > 1) th.val(+th.val() - 1);
    });
</script>
<script>
    $(document).ready(function() {
        $('.add-wishlist').on('click', function() {
            var id = $(this).data('id');
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
                        $('i[data-id=' + id + ']').addClass('active-wishlist-cart');
                        toastr.success('Product added to wishlist');
                    } else {
                        $('i[data-id=' + id + ']').removeClass('active-wishlist-cart');
                        toastr.success('Product removed from wishlist');
                    }
                }
            });
        });

        $('.remove-product').on('click', function() {
            var id = $(this).data('id');
            var url = "{{ route('remove-product-from-cart') }}";

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(resp) {
                    $('#cart-items').html(resp.view);
                    toastr.success('Product removed from cart');
                }
            });
        });
    });
</script>

{{-- Quantity increase decrease of product --}}
<script>
    $(document).ready(function() {
      $('.decrease').on('click', function() {
            var id = $(this).data('id');
            var value = parseInt($('input[data-id=' + id + ']').val(), 10);
            value = isNaN(value) ? 0 : value;
            if (value > 1) {
                value--;
            }
            var url = "{{ route('decrease-product-quantity') }}";
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(resp) {
                    $('#cart-items').html(resp.view);
                    $('input[data-id=' + id + ']').val(value);
                }
            });
        });

        $('.increase').on('click', function() {
            var id = $(this).data('id');
            var value = parseInt($('input[data-id=' + id + ']').val(), 10);
            value = isNaN(value) ? 0 : value;
            value++;

            var url = "{{ route('increase-product-quantity') }}";
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(resp) {
                    $('#cart-items').html(resp.view);
                    $('input[data-id=' + id + ']').val(value);
                }
            });
        });
    });
</script>

@endpush