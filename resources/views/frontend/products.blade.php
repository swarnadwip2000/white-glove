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
                    <input type="text" class="input" placeholder="Search" id="filter_product">
                    <button type="submit" class="product-search"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="d-flex align-items-center justify-content-end">
                <div class="me-2">Sort By: </div>
                <div class="all_select">
                  <select class="form-select sort-by" aria-label="">
                    <option selected="" value="popularity">Popularity</option>
                    <option value="1">Price- Low to High</option>
                    <option value="0">Price- High to Low</option>
                  </select>
                </div>
              </div>                    
            </div>
          </div>
          <div id="product-filter">@include('frontend.product-filter')</div>
        </div>
      </div>
    </div>
  </section>

  @endsection

  @push('scripts')
<script>
  $(document).ready(function() {
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
                $('#cart-item').text(response.count);
                toastr.success(response.message);
            } else {
                toastr.error(response.message);
            }
        }
    });
  });

  $('.add-wishlist').on('click', function(){
      var id = $(this).data('wish');
      var url = "{{ route('update-wishlist') }}";
      
      $.ajax({
        url: url,
        type: "POST",
        data: {
          "_token": "{{ csrf_token() }}",
          "id": id
        },
        success: function(response){
          if (response.action == 'added') {
            $('a[data-wish='+id+']').addClass('active-wishlist');
            toastr.success('Product added to wishlist successfully');
              } else {
            $('a[data-wish='+id+']').removeClass('active-wishlist');       
            toastr.success('Product removed from wishlist successfully');       
          }
        }
      });
    });
});
</script>

<script>
  $('.product-search').on('click', function(){   
   var product = $('#filter_product').val();
   var sort = $('.sort-by').val();
   var category = (location.href.substring(location.href.lastIndexOf('/') + 1));
    
   $.ajax({
        url: "{{ route('product.sorting') }}",
        method: "GET",
        data: {
          product: product,
          sort: sort,
          category: category,
        },
        success: function(resp) {
            $('#product-filter').html(resp.view);
        }
    });
});
</script>

<script>
  $('.sort-by').on('change', function(){   
    var sort = $('.sort-by').val();  
    var product = $('#filter_product').val();
    var category = (location.href.substring(location.href.lastIndexOf('/') + 1));
    
    $.ajax({
        url: "{{ route('product.sorting') }}",
        method: "GET",
        data: {
          sort: sort,
          product: product,
          category: category,
        },
        success: function(respons) {
          
          $('#product-filter').html(respons.view);
        }
    });   
});
</script>

@endpush
