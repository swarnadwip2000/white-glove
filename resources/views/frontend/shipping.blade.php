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
    use App\Helpers\AddToCart;
    use App\Helpers\Wish;
@endphp

@section('content')
<section class="inner_banner_sec">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="inner_banner_ontent">
              <h1>Shipping and Billing</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="cart_sec">          
    <div class="container">            
      <div class="holder">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h2>Shipping Address</h2>
                 
                  <div class="row mt-4">
                    <div class="col-sm-6">
                      <label>First Name:</label>
                      <div class="form-group">
                        <input type="text" class="form-control form-control--sm">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <label>Last Name:</label>
                      <div class="form-group">
                        <input type="text" class="form-control form-control--sm">
                      </div>
                    </div>
                  </div>
                  <div class="mt-4"></div>
                  <label>Country:</label>
                  <div class="form-group select-wrapper">
                    <select class="form-control form-control--sm">
                      <option value="United States">United States</option>
                      <option value="Canada">Canada</option>
                      <option value="China">China</option>
                      <option value="India">India</option>
                      <option value="Italy">Italy</option>
                      <option value="Mexico">Mexico</option>
                    </select>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label>State:</label>
                      <div class="form-group select-wrapper">
                        <select class="form-control form-control--sm">
                          <option value="AL">Alabama</option>
                          <option value="AK">Alaska</option>
                          <option value="AZ">Arizona</option>
                          <option value="AR">Arkansas</option>
                          <option value="CA">California</option>
                          <option value="CO">Colorado</option>
                          <option value="CT">Connecticut</option>
                          <option value="DE">Delaware</option>
                          <option value="DC">District Of Columbia</option>
                          <option value="FL">Florida</option>
                          <option value="GA">Georgia</option>
                          <option value="HI">Hawaii</option>
                          <option value="ID">Idaho</option>
                          <option value="IL">Illinois</option>
                          <option value="IN">Indiana</option>
                          <option value="IA">Iowa</option>
                          <option value="KS">Kansas</option>
                          <option value="KY">Kentucky</option>
                          <option value="LA">Louisiana</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <label>zip/postal code:</label>
                      <div class="form-group">
                        <input type="text" class="form-control form-control--sm">
                      </div>
                    </div>
                  </div>
                  <div class="mt-4"></div>
                  <label>Address 1:</label>
                  <div class="form-group">
                    <input type="text" class="form-control form-control--sm">
                  </div>
                  <div class="clearfix">
                    <input id="formcheckoutCheckbox1" name="checkbox1" type="checkbox">
                    <label for="formcheckoutCheckbox1">Save address to my account</label>
                  </div>
                </div>
              </div>
              <div class="card mt-4">
                <div class="card-body">
                  <h2>Billing Address</h2>
                  <div class="clearfix">
                    <input id="formcheckoutCheckbox2" name="checkbox2" type="checkbox">
                    <label for="formcheckoutCheckbox2">The same as shipping address</label>
                  </div>
                  <div class="mt-4"></div>
                  <label>Country:</label>
                  <div class="form-group select-wrapper">
                    <select class="form-control form-control--sm">
                      <option value="United States">United States</option>
                      <option value="Canada">Canada</option>
                      <option value="China">China</option>
                      <option value="India">India</option>
                      <option value="Italy">Italy</option>
                      <option value="Mexico">Mexico</option>
                    </select>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label>State:</label>
                      <div class="form-group select-wrapper">
                        <select class="form-control form-control--sm">
                          <option value="AL">Alabama</option>
                          <option value="AK">Alaska</option>
                          <option value="AZ">Arizona</option>
                          <option value="AR">Arkansas</option>
                          <option value="CA">California</option>
                          <option value="CO">Colorado</option>
                          <option value="CT">Connecticut</option>
                          <option value="DE">Delaware</option>
                          <option value="DC">District Of Columbia</option>
                          <option value="FL">Florida</option>
                          <option value="GA">Georgia</option>
                          <option value="HI">Hawaii</option>
                          <option value="ID">Idaho</option>
                          <option value="IL">Illinois</option>
                          <option value="IN">Indiana</option>
                          <option value="IA">Iowa</option>
                          <option value="KS">Kansas</option>
                          <option value="KY">Kentucky</option>
                          <option value="LA">Louisiana</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <label>zip/postal code:</label>
                      <div class="form-group">
                        <input type="text" class="form-control form-control--sm">
                      </div>
                    </div>
                  </div>
                  <div class="mt-4"></div>
                  <label>Address 1:</label>
                  <div class="form-group">
                    <input type="text" class="form-control form-control--sm">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 mt-4 mt-md-0">
              {{-- <div class="card">
                <div class="card-body">
                  <h2>Devivery Methods</h2>
                  <div class="clearfix">
                    <input id="formcheckoutRadio1" value="" name="radio1" type="radio" class="radio" checked="checked">
                    <label for="formcheckoutRadio1">Standard Delivery $2.99 (3-5 days)</label>
                  </div>
                  <div class="clearfix">
                    <input id="formcheckoutRadio2" value="" name="radio1" type="radio" class="radio">
                    <label for="formcheckoutRadio2">Express Delivery $10.99 (1-2 days)</label>
                  </div>
                  <div class="clearfix">
                    <input id="formcheckoutRadio3" value="" name="radio1" type="radio" class="radio">
                    <label for="formcheckoutRadio3">Same-Day $20.00 (Evening Delivery)</label>
                  </div>
                </div>
              </div> --}}
              <div class="mt-4"></div>
              <div class="card">
                <div class="card-body">
                  <h2>Payment Methods</h2>
                  <div class="clearfix">
                    <input id="formcheckoutRadio4" value="" name="radio2" type="radio" class="radio" checked="checked">
                    <label for="formcheckoutRadio4">Credit Card</label>
                  </div>
                  <div class="clearfix">
                    <input id="formcheckoutRadio5" value="" name="radio2" type="radio" class="radio">
                    <label for="formcheckoutRadio5">Paypal</label>
                  </div>
                  <div class="mt-4"></div>
                  <label>Cart Number</label>
                  <div class="form-group">
                    <input type="text" class="form-control form-control--sm">
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label>Month:</label>
                      <div class="form-group select-wrapper">
                        <select class="form-control form-control--sm">
                          <option selected="" value="1">January</option>
                          <option value="2">February</option>
                          <option value="3">March</option>
                          <option value="4">April</option>
                          <option value="5">May</option>
                          <option value="6">June</option>
                          <option value="7">July</option>
                          <option value="8">August</option>
                          <option value="9">September</option>
                          <option value="10">October</option>
                          <option value="11">November</option>
                          <option value="12">December</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <label>Year:</label>
                      <div class="form-group select-wrapper">
                        <select class="form-control form-control--sm">
                          <option value="2019">2019</option>
                          <option value="2020">2020</option>
                          <option value="2021">2021</option>
                          <option value="2022">2022</option>
                          <option value="2023">2023</option>
                          <option value="2024">2024</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="mt-4">
                      <label>CVV Code</label>
                      <div class="form-group">
                        <input type="text" class="form-control form-control--sm">
                      </div>
                  </div>
                </div>
              </div>
              <div class="mt-4"></div>
              <div class="card">
                <div class="card-body">
                  <h3>Order Comment</h3>
                  <textarea class="form-control form-control--sm textarea--height-200" placeholder="Place your comment here"></textarea>
                  <div class="card-text-info mt-4">
                    <p>*Savings include promotions, coupons, rueBUCKS, and shipping (if applicable).</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-3"></div>
          <h2 class="custom-color">Order Summary</h2>
          <div class="row justify-content-between">
            <div class="col-md-7">
            @php
            $total=0;
             @endphp           
            @foreach($userCarts as $cartItem)
            @php
                $total += $cartItem['product']['discounted_price'] * $cartItem['quantity'];
            @endphp
              <div class="d-block d-lg-flex justify-content-between align-items-center mb-4">
                <div class="left_img_text">
                  <div class="cart_small_img">
                    <img src="{{ Storage::url($cartItem['product']['image']) }}" alt=""/>
                  </div>
                  <div class="img_left_text">
                    <h5>{!! Str::limit($cartItem['product']['name'], 30, ' ...') !!}</h5>
                    
                  </div>
                </div>
                <div class="right_text">                        
                  <div class="price my-2">${{ $cartItem['product']['discounted_price'] }} <strike class="original-price">${{ $cartItem['product']['price'] }}</strike></div>
                </div>
              </div>
            @endforeach
              {{-- <div class="d-block d-lg-flex justify-content-between align-items-center mb-4">
                <div class="left_img_text">
                  <div class="cart_small_img">
                    <img src="assets/images/featured_product1.jpg" alt=""/>
                  </div>
                  <div class="img_left_text">
                    <h5>Lorem ipsum dolor</h5>
                    <span>27% THC</span>
                  </div>
                </div>
                <div class="right_text">                        
                  <div class="price my-2">$100.00 <strike class="original-price">$120.00</strike></div>
                </div>
              </div> --}}
            </div>
            <div class="col-md-4 mt-4 mt-md-0">
              
              <div class="mt-4"></div>
              <div class="cart-total-sm">
                <span>Subtotal</span>
                <span class="card-total-price">$ 494.00</span>
              </div>
              <div class="clearfix mt-4">
                <button type="submit" class="shopnow">Place Order</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @endsection