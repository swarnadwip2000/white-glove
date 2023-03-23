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
            <a href="{{ route('product',$category['id']) }}">
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
          <div class="row justify-content-center align-items-center mb-3">
            <div class="col-xl-12 col-lg-12 text-center">
              <div class="silver_age">
                <h4>{{ $single_category['name'] }}</h4>
                <p>Showing 1 – 9 Packages of {{$products->count()}} results for “{{$single_category['name']}}”</p>
                
              </div>
            </div>
          </div>
          <div class="row row-cols-1 row-cols-xxl-5 row-cols-xl-4 row-cols-lg-2">
            @foreach($products as $product)
            <div class="col mb-4 mb-xl-5">
              <div class="card_box">
                <div class="wish_cart">
                  <div class="wish">
                    <a href="{{ route('product-detail',$product['id']) }}"><i class="fa-solid fa-heart"></i></a>
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
                  <h3>Price ${{ $product['price'] }}</h3>
                  <div class="cart">
                    <a href=""><i class="fa-solid fa-bag-shopping"></i> Add</a>
                  </div>
                </div>
              </div>
            </div>
           @endforeach 
          </div>
          <div class="">
            {!! $products->links() !!}
          </div>
        </div>
      </div>
    </div>
  </section>

  @endsection