@php
    use Illuminate\Support\Facades\Storage;
    use App\Helpers\Wish;
    use App\Helpers\AddToCart;
@endphp

@if ($products->count() > 0)
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

    @if (count($products) > 0)
        <div class="row row-cols-1 row-cols-xxl-5 row-cols-xl-4 row-cols-lg-2">
            @foreach ($products as $product)
                <div class="col mb-4 mb-xl-5">
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
                                    href="{{ route('product-detail', ['slug' => $product['slug'], 'id' => encrypt($product['id'])]) }}">{{ $product['name'] }}</a>
                            </h4>
                            <div class="card_star">
                                <ul>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                </ul>
                            </div>
                            <div class="price my-2">Price: ${{ $product['discounted_price'] }} <strike
                                    class="original-price">${{ $product['price'] }}</strike></div>

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
    @else
        <div class="row justify-content-between align-items-center mb-3">
            <div class="col-xl-9 col-lg-6">

                <h3>No product is available right now....</h3>
            </div>
        </div>

    @endif


    <div class="">
        {!! $products->links() !!}
    </div>
@else
    <div>
        <h4>No Product Found</h4>
    </div>
@endif



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
 
