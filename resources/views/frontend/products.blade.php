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
                    <input type="text" class="input" placeholder="Search" id="search-product">
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
          <div class="product-search"> 
          @include('frontend.product-search')
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

<script>
  $(document).ready(function() {
      $('#search-product').keyup(function() {
          var query = $(this).val();
          var _token = $('input[name="_token"]').val();
          $.ajax({
              url: "{{ route('product.search') }}",
              method: "POST",
              data: {
                  query: query,
                  _token: _token
              },
              success: function(response) {
                  $('.search_dropdown').fadeIn();
                  $('.search_dropdown').html(response.view);
              }
          });
      });
      $(document).on('click', 'li', function() {
          $('#search-product').val($(this).text());
          $('.search_dropdown').fadeOut();
      });
  });
</script>
@endpush