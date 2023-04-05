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
                    <div class="row justify-content-center align-items-center mb-3">
                        <div class="col-xl-12 col-lg-12 text-center">
                            <div class="silver_age">
                                @if ($single_category == 'All Products')
                                    <h4>{{ $single_category }}</h4>
                                @else
                                    <h4>{{ $single_category['name'] }}</h4>
                                @endif
                                <p>Showing {{ $products->currentPage() }} – {{ $products->lastPage() }} Packages of
                                    {{ $products->count() }} results for “@if ($single_category == 'All Products')
                                        {{ $single_category }}
                                    @else
                                        {{ $single_category['name'] }}
                                    @endif”</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-md-2 col-12">
                            <div class="discount-f">
                                <h3>DISCOUNT RANGE</h3>
                                    <div class="form-check">
                                        <input class="form-check-input range" type="radio" value="10" name="flexRadioDefault"
                                            id="flexRadioDefault1" checked>
                                        <label class="form-check-label" for="flexRadioDefault1" >
                                            10% and above
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input range" type="radio" value="20" name="flexRadioDefault"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            20% and above
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input range" type="radio" value="30" name="flexRadioDefault"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            30% and above
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input range" type="radio" value="40" name="flexRadioDefault"
                                            id="flexRadioDefault1" >
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            40% and above
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input range" type="radio" value="50" name="flexRadioDefault"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            50% and above
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input range" type="radio" value="60" name="flexRadioDefault"
                                            id="flexRadioDefault1" >
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            60% and above
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input range" type="radio" value="70" name="flexRadioDefault"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            70% and above
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input range" type="radio" value="80" name="flexRadioDefault"
                                            id="flexRadioDefault1" >
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            80% and above
                                        </label>
                                    </div>
                            </div>
                        </div>
                        <div class="col-xl-10 col-md-10 col-12">
                            <div id="product-filter">@include('frontend.product-filter')</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
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
                            $('#cart-item').text(response.count);
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    }
                });
            });

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
        });
    </script>

    <script>
        $('.product-search').on('click', function() {
            var range =  $("input[type='radio']:checked").val();
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
                    range: range,
                },
                success: function(resp) {
                    $('#product-filter').html(resp.view);
                }
            });
        });
    </script>

    <script>
        $('.sort-by').on('change', function() {
            var range =  $("input[type='radio']:checked").val();
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
                    range: range,
                },
                success: function(respons) {

                    $('#product-filter').html(respons.view);
                }
            });
        });
    </script>

    <script>
       $(document).ready(function() {
            $('.range').on('click', function() {
              var range =  $("input[type='radio']:checked").val();
              var sort = $('.sort-by').val();
              var product = $('#filter_product').val();
              var category = (location.href.substring(location.href.lastIndexOf('/') + 1));

                $.ajax({
                    url: "{{ route('product.sorting')  }}",
                    type: 'GET',
                    data: {
                        sort: sort,
                        product: product,
                        category: category,
                        range: range,
                    },
                    success: function(res) {
                        // console.log(response);
                        $('#product-filter').html(res.view);
                    }
                });
            });
          });   
      </script>
@endpush
