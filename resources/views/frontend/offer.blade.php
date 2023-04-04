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
              <h1>Offer</h1>
          </div>
        </div>
      </div>
    </div>
  </section>
<section class="blo_section section">
    <div class="container">
        <div class="row">
        <div class="offer_slider mt-4">
        <div class="offer_slid">
          <div class="offer_box">
            <div class="offer_img">
              <a href="">
                <img src="{{asset('frontend_assets/images/offers.jpg')}}" alt=""/>
              </a>
            </div>                  
            <div class="offer_text">
              <h4><a href="">This month’s discount - 50%</a></h4>                    
            </div>
          </div>
        </div>
        <div class="offer_slid">
          <div class="offer_box">
            <div class="offer_img">
              <a href="">
                <img src="{{asset('frontend_assets/images/offers.jpg')}}" alt=""/>
              </a>
            </div>                  
            <div class="offer_text">
              <h4><a href="">This month’s discount - 30%</a></h4>                    
            </div>
          </div>
        </div>
        <div class="offer_slid">
          <div class="offer_box">
            <div class="offer_img">
              <a href="">
                <img src="{{asset('frontend_assets/images/offers.jpg')}}" alt=""/>
              </a>
            </div>                  
            <div class="offer_text">
              <h4><a href="">This month’s discount - 20%</a></h4>                    
            </div>
          </div>
        </div>              
      </div>
        </div>
    </div>

</section>

@endsection