<div class="main_menu_hdr">
    <div class="container-fluid">
      <div class="navigation navbar">
        <div class="left_top">
          <div class="hdr_manu_nav">
            <input type="checkbox" id="navcheck" role="button" title="menu">
            <label for="navcheck" aria-hidden="true" title="menu">
              <span class="burger">
                <span class="bar">
                  <span class="visuallyhidden">Menu</span>
                </span>
              </span>
            </label>
            <nav id="menu">
              <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                <li><a href="{{ route('product',['slug'=> 'all-products']) }}">Products</a></li>
              </ul>
            </nav>              
          </div> 
          <div class="logo pe-0 pe-md-5">
            <a href="{{ route('home') }}" class="">
              <img src="{{ asset('frontend_assets/images/logo.png')}}" alt=""/>
            </a>
          </div>
        </div>
        <div class="right_top">
          <div class="d-none d-lg-block">
            <div class="search_box">
              <div class="search_field">                    
                <button type="submit"><i class="fas fa-search"></i></button>
                <input type="text" class="input" placeholder="search here products">
              </div>
            </div>
          </div> 
          <div class="right_login">
            <div class="d-flex align-items-center justify-content-between">
              <div class="icon_c ms-2">
                <a href="{{ route('wishlist') }}" class="add_cart_active"><i class="fa-solid fa-heart"></i></a>
              </div>
              <div class="icon_c ms-2">
                <a href="{{ route('cart') }}" class="add_cart_active"><i class="fa-solid fa-bag-shopping"></i></a>
              </div>
              
              <div class="login">
                @if(Auth::check())
                @if(Auth::user()->hasRole('CUSTOMER'))
                <span><a href="{{route('logout')}}"><i class="fa-solid fa-user"></i></a> <a href="{{route('logout')}}">Log out</a></span>
                @else
                <span><a href="{{ route('login') }}"><i class="fa-solid fa-user"></i></a> <a href="{{ route('login') }}">Sign in</a></span>
                @endif
                @else
                <span><a href="{{ route('login') }}"><i class="fa-solid fa-user"></i></a> <a href="{{ route('login') }}">Sign in</a></span>
                @endif
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>