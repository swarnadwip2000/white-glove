<footer class="footer_sec">
    <div class="container-fluid">
      <div class="copyright">
        <div class="row mb-4">
          <div class="col-lg-12">
            <div class="ftr_logo_sec text-center">
              <a href="" class="ftr_logo">
                <img src="{{ asset('frontend_assets/images/logo.png')}}" alt=""/>
              </a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3">
            <div class="quick_links">
              <h5>Quick Links</h5>
            </div>
            <div class="quick_links_ul culmans_2">
              <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About us</a></li>
                <li><a href="{{ route('product',['slug'=> 'all-products']) }}">SHOP</a></li>
                <li><a href="{{ route('contact') }}">CONTACT </a></li>
                <li><a href="{{ route('offer') }}">offer</a></li>
                <li><a href="{{ route('blogs') }}">BLOG</a></li>
                <li><a href="">GALLERY</a></li>
                <li><a href="">STORE POLICY</a></li>
                <li><a href="">FAQ</a></li>
                <li><a href="">SHIPPING & RETURNS</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row">
              <div class="col">
                <div class="quick_links">
                  <h5>Help</h5>
                </div>
                <div class="quick_links_ul">
                  <ul>
                    <li><a href="">Subscription instructions</a></li>
                    <li><a href="">Help Center</a></li>
                    <li><a href="">problem with the site</a></li>
                  </ul>
                </div>
              </div>
              <div class="col">
                <div class="quick_links">
                  <h5>User</h5>
                </div>
                <div class="quick_links_ul">
                  <ul>
                    <li><a href="{{ route('register') }}">Registration</a></li>
                    <li><a href="{{ route('cart') }}">basket</a></li>
                    @if (Auth::check() && Auth::user()->hasRole('CUSTOMER'))
                    <li><a href="{{ route('wishlist') }}">wish list</a></li>
                    @endif
                  </ul>
                </div>
              </div>
              <div class="col">
                <div class="quick_links">
                  <h5>Follow Us</h5>
                </div>
                <div class="quick_links_ul">
                  <ul>
                    <li><a href="">Instagram</a></li>
                    <li><a href="">twitter</a></li>
                    <li><a href="">facebook</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="quick_links">
              <h5>Contact Us</h5>
            </div>
            <div class="enter_mail">
              <form>
                <div class="email_text">
                  <div class="email_text_text">
                    <input type="search" class="form-control" id="gsearch" placeholder="Enter email here" name="gsearch">                        
                  </div>
                  <div class="email_button">
                    <input type="submit" class="email_btn" value="send">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="copy_1">
        <p>Copyright © 2023 White Glove Comics. All Rights Reserved. design & development by <a href="">excellis it</a>·</p>
      </div>
    </div>
  </footer>