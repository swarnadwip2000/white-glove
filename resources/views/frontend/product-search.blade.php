@php
    use Illuminate\Support\Facades\Storage;
    use App\Helpers\Wish;
    use App\Helpers\AddToCart;
@endphp

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
          <a href="{{ route('product-detail',['slug' => $product['slug'], 'id' => encrypt($product['id'])]) }}">
            <img src="{{ Storage::url($product['image']) }}" alt=""/>
          </a>
        </div>                  
        <div class="card_text">
          <h4><a href="{{ route('product-detail',['slug' => $product['slug'], 'id' => encrypt($product['id'])]) }}">{{ $product['name'] }}</a></h4>
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