
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