
@php
    use Illuminate\Support\Facades\Storage;
    use App\Helpers\Wish;
    use App\Helpers\AddToCart;
@endphp
@if (count($userCart) > 0)

<div class="col-lg-8">

    @php
    $total = 0;
    @endphp
    @foreach ($userCart as $cart)
    @php
        $total += $cart['product']['discounted_price'] * $cart['quantity'];
    @endphp
    <div class="cart_left_box mb-4" id="remove-{{ $cart['id'] }}">
        <div class="d-block d-lg-flex justify-content-between align-items-center">
            <div class="left_img_text">
                <div class="cart_small_img">
                    <a href=""
                        style="color:black; text-decoration:unset;"><img
                            src="{{ storage::url($cart->product['image']) }}"
                            alt="" /></a>
                </div>
                <div class="img_left_text">
                    <h5><a href=""
                            style="color:black; text-decoration:unset;">
                            {!! Str::limit($cart['product']['name'], 17, ' ...') !!}</a></h5>
                     @if(AddToCart::CheckStock($cart['product']['id']) == 0)<span class="outstock">Out of
                        stock</span>@endif
                    <ul>
                        <li>
                            <a href="javascript:void(0);" data-id="{{ $cart['id'] }}"
                                class="remove-product"><i class="fa-solid fa-trash"></i> Remove</a>
                        </li>
                        <li>
                            @if (Auth::check() && Auth::user()->hasRole('CUSTOMER'))
                                <a href="javascript:void(0);" class="add-wishlist"
                                    data-id="{{ $cart['product_id'] }}"><i data-id="{{ $cart['product_id'] }}"
                                        class="fa-solid fa-heart @if (Wish::wishListCount($cart['product_id'], Auth::user()->id) > 0) active-wishlist-cart @endif"></i>
                                    Move to
                                    Wishlist</a>
                            @else
                                <a href="{{ route('login') }}"><i class="fa-solid fa-heart"></i> Move to
                                    Wishlist</a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="small_number me-3">
                <form>
                  <div class="value-button decrease" data-id="{{ $cart['id'] }}" id="decrease"   value="Decrease Value"><i class="fa-solid fa-minus"></i></div>
                  <input type="number" id="number" data-id="{{ $cart['id'] }}" class="number" value="{{$cart['quantity']}}" min="1"/>
                  <div class="value-button increase" data-id="{{ $cart['id'] }}" id="increase"  value="Increase Value"><i class="fa-solid fa-plus"></i></div>
                </form>
            </div>
            <div class="price my-2">
                ${{ $cart['product']['discounted_price'] * $cart['quantity'] }} <strike
                    class="original-price">${{ $cart['product']['price'] * $cart['quantity'] }}
                </strike></div>
        </div>
    </div>
    @endforeach   
</div>
  <div class="col-lg-4">
    <div class="cart_right">
      <div class="row m-0">
        <div class="col-sm-8 p-0">
          <h6>Subtotal</h6>
        </div>
        <div class="col-sm-4 p-0">
          <p id="subtotal">${{ $total }}</p>
        </div>
      </div>
      {{-- <div class="row m-0">
        <div class="col-sm-8 p-0 ">
          <h6>Tax</h6>
        </div>
        <div class="col-sm-4 p-0">
          <p id="tax">$6.40</p>
        </div>
      </div> --}}
      <hr>
      <div class="row mx-0 mb-2">
        <div class="col-sm-8 p-0 d-inline">
          <h5>Total</h5>
        </div>
        <div class="col-sm-4 p-0">
          <p id="total">${{ $total }}</p>
        </div>
      </div>
    @if (Auth::check() && Auth::user()->hasRole('CUSTOMER'))
        <a href="{{ route('checkout') }}"><button id="btn-checkout"
                class="shopnow"><span>Checkout</span></button></a>
    @else
        <a href="{{ route('login') }}"><button id="btn-checkout"
                class="shopnow"><span>Checkout</span></button></a>
    @endif
    </div>
  </div>

  @else
    <div class="col-lg-8">
        <div class="cart_left_box mb-4">
            <h3>Cart is empty</h3>
        </div>
    </div>
@endif


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
                        $('#wish-item').text(response.count);
                        toastr.success('Product added to wishlist');
                    } else {
                        $('i[data-id=' + id + ']').removeClass('active-wishlist-cart');
                        $('#wish-item').text(response.count);
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
                    $('#cart-item').text(resp.count);
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

 
