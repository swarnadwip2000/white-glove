@extends('frontend.layouts.master')
@section('meta')
@endsection
@section('title')
    {{ env('APP_NAME') }} | Shipping and Billing Page
@endsection
@push('styles')
    <style>
        .myClass {
            color: red;
        }

        .error {
            color: #F00 !important;
            background-color: #FFF !important;
        }
    </style>
@endpush
@php
    use Illuminate\Support\Facades\Storage;
    use App\Helpers\Wish;
@endphp

@section('content')
    <section class="inner_banner_sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner_banner_ontent">
                        <h2>Shipping and Billing</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cart_sec">
        <div class="container">
            <form role="form" action="{{ route('place.order') }}" method="post" class="require-validation"
                data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="payment-form">
                @csrf
                <div class="holder">
                    <div class="container">

                        <div class="row align-items-start">
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h2>Shipping Address</h2>
                                        {{-- <p><a href="account-create.html">Login</a> or <a href="account-create.html">Register</a> for faster payment.</p> --}}
                                        <div class="row mt-4">
                                            <div class="col-sm-6">
                                                <label>Full Name:</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control--sm"
                                                        placeholder="Enter name" name="shipping_name"
                                                        @if ($address == null) value="{{ Auth::user()->name }}" @else value="{{ $address['name'] }}" @endif
                                                        id="shipping_name">

                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Phone Number:</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control--sm"
                                                        placeholder="Enter a phone number" name="shipping_phone"
                                                        @if ($address == null) value="{{ Auth::user()->phone }}" @else value="{{ $address['phone'] }}" @endif
                                                        id="shipping_phone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4"></div>
                                        <label>Country:</label>
                                        <div class="form-group select-wrapper">
                                            <input class="form-control form-control--sm" name="shipping_country"
                                                placeholder="Country" id="shipping_country"
                                                @if ($address != null) value="{{ $address['country'] }}" @endif>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>State:</label>
                                                <div class="form-group select-wrapper">
                                                    <input class="form-control form-control--sm" name="shipping_state"
                                                        placeholder="State" id="shipping_state"
                                                        @if ($address != null) value="{{ $address['state'] }}" @endif>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>zip/postal code:</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control--sm"
                                                        placeholder="Enter zipcode" name="shipping_zipcode"
                                                        id="shipping_zipcode"
                                                        @if ($address != null) value="{{ $address['zipcode'] }}" @endif>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4"></div>
                                        <label>Address 1:</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control--sm"
                                                placeholder="Enter address" name="shipping_address" id="shipping_address"
                                                @if ($address != null) value="{{ $address['address'] }}" @endif>
                                        </div>
                                        <div class="clearfix">
                                            <input id="formcheckoutCheckbox1" name="checkbox1" type="checkbox"
                                                @if ($address != null) checked @endif>
                                            <label for="formcheckoutCheckbox1">Save address to my account</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h2>Billing Address</h2>
                                        <div class="clearfix">
                                            <input id="formcheckoutCheckbox2" name="checkbox2" type="checkbox">
                                            <label for="formcheckoutCheckbox2">The same as shipping address</label>
                                        </div>
                                        <div class="mt-4"></div>
                                        <label>Country:</label>
                                        <div class="form-group select-wrapper">
                                            <input class="form-control form-control--sm" name="billing_country"
                                                placeholder="Country" id="billing_country">
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>State:</label>
                                                <div class="form-group select-wrapper">
                                                    <input class="form-control form-control--sm" name="billing_state"
                                                        placeholder="State" id="billing_state">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>zip/postal code:</label>
                                                <div class="form-group">
                                                    <input type="text" name="billing_zipcode"
                                                        class="form-control form-control--sm" placeholder="Enter zipcode"
                                                        id="billing_zipcode">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4"></div>
                                        <label>Address 1:</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control--sm"
                                                name="billing_address" placeholder="Enter address" id="billing_address">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        @if ($from == 'cart')
                            <div class="row justify-content-between">
                                <div class="col-md-5 mt-4 mt-md-0">

                                    {{-- <div class="mt-4"></div> --}}
                                    <div class="card">
                                        <div class="card-body">
                                            <h2>Payment Methods</h2>
                                            <div class="clearfix">
                                                <input id="formcheckoutRadio4" value="stripe" name="payment_method"
                                                    type="radio" class="radio" checked="checked">
                                                <label for="formcheckoutRadio4">Credit Card</label>
                                            </div>
                                            <div class="clearfix">
                                                <input id="formcheckoutRadio5" value="paypal" name="payment_method"
                                                    type="radio" class="radio">
                                                <label for="formcheckoutRadio5">Paypal</label>
                                            </div>
                                            <div class="mt-4"></div>
                                            <div>
                                                <label>Card Number</label>
                                                <div class="form-group card required" style="border:none;">
                                                    <input type="text"
                                                        class="form-control form-control--sm card-number"
                                                        name="card-number" id="card-number"
                                                        placeholder="xxxx xxxx xxxx xxxx" autocomplete='off'
                                                        size='20'>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label>Month:</label>
                                                        <div class="form-group select-wrapper expiration required">
                                                            <select class="form-control form-control--sm card-expiry-month"
                                                                name="card-expiry-month" id="card-expiry-month">
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
                                                        <div class="form-group  expiration required">
                                                            <input class="form-control form-control--sm card-expiry-year"
                                                                name="card-expiry-year" placeholder='YYYY'
                                                                id="card-expiry-year">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4  ">
                                                    <label>CVV Code</label>
                                                    <div class="form-group cvc required">
                                                        <input type="text"
                                                            class="form-control form-control--sm card-cvv" id="card-cvv"
                                                            name="card-cvv" placeholder='ex. 311'>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4"></div>

                                </div>
                                <div class="col-md-7">
                                    <div class="mt-1"></div>
                                    <h2 class="custom-color">Order Summary</h2>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($userCarts as $userCart)
                                        <input type="hidden" name="product_id[]" value="{{ $userCart['product_id'] }}">
                                        <input type="hidden" name="quantity[]" value="{{ $userCart['quantity'] }}">
                                        <input type="hidden" name="price[]"
                                            value="{{ $userCart['product']['price'] }}">
                                        @php
                                            $total += $userCart['product']['discounted_price'] * $userCart['quantity'];
                                        @endphp
                                        <div class="d-block d-lg-flex justify-content-between align-items-center mb-4">
                                          
                                            <div class="left_img_text">
                                                <div class="cart_small_img">
                                                  <a href="{{ route('product-detail',['slug' => $userCart['product']['slug'], 'id' => encrypt($userCart['product']['id'])]) }}">
                                                    <img src="{{ storage::url($userCart['product']['image']) }}"
                                                        alt="" />
                                                  </a>
                                                </div>
                                                <div class="img_left_text">
                                                    <h5>{!! Str::limit($userCart['product']['name'], 30, ' ...') !!}</h5>
                                                    <span>{!! Str::limit($userCart['product']['description'], 40, ' ...') !!}</span>
                                                </div>
                                            </div>
                                          </a>
                                            <div class="right_text">
                                                <div class="price my-2">${{ $userCart['product']['discounted_price'] }}
                                                    <strike
                                                        class="original-price">${{ $userCart['product']['price'] }}</strike>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-md-4 mt-4 mt-md-0">

                                    <div class="mt-4"></div>
                                    <input type="hidden" name="total_amount" value="{{ $total }}">
                                    <div class="cart-total-sm">
                                      <span><strong>Subtotal:</strong></span>
                                        <span class="card-total-price">${{ $total }}</span>
                                    </div>
                                    <div class="clearfix mt-4">
                                        <button type="submit" class="shopnow place_order">Place Order</button>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-5 mt-4 mt-md-0">

                                    {{-- <div class="mt-4"></div> --}}
                                    <div class="card">
                                        <div class="card-body">
                                            <h2>Payment Methods</h2>
                                            <div class="clearfix">
                                                <input id="formcheckoutRadio4" value="stripe" name="payment_method"
                                                    type="radio" class="radio" checked="checked">
                                                <label for="formcheckoutRadio4">Credit Card</label>
                                            </div>
                                            <div class="clearfix">
                                                <input id="formcheckoutRadio5" value="paypal" name="payment_method"
                                                    type="radio" class="radio">
                                                <label for="formcheckoutRadio5">Paypal</label>
                                            </div>
                                            <div class="mt-4"></div>
                                            <div>
                                                <label>Card Number</label>
                                                <div class="form-group card required" style="border:none;">
                                                    <input type="text"
                                                        class="form-control form-control--sm card-number"
                                                        name="card-number" id="card-number"
                                                        placeholder="xxxx xxxx xxxx xxxx" autocomplete='off'
                                                        size='20'>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label>Month:</label>
                                                        <div class="form-group select-wrapper expiration required">
                                                            <select class="form-control form-control--sm card-expiry-month"
                                                                name="card-expiry-month" id="card-expiry-month">
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
                                                        <div class="form-group  expiration required">
                                                            <input class="form-control form-control--sm card-expiry-year"
                                                                name="card-expiry-year" placeholder='YYYY'
                                                                id="card-expiry-year">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4  ">
                                                    <label>CVV Code</label>
                                                    <div class="form-group cvc required">
                                                        <input type="text"
                                                            class="form-control form-control--sm card-cvv" id="card-cvv"
                                                            name="card-cvv" placeholder='ex. 311'>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4"></div>

                                </div>
                                <div class="col-md-7">
                                    <div class="mt-1"></div>
                                    <h2 class="custom-color">Order Summary</h2>
                                    <input type="hidden" name="product_id[]" value="{{ $product['id'] }}">
                                    <input type="hidden" name="quantity[]" value="1">
                                    <input type="hidden" name="price[]" value="{{ $product['discounted_price'] }}">
                                    <input type="hidden" name="total_amount"
                                        value="{{ $product['discounted_price'] }}">
                                    <div class="d-block d-lg-flex justify-content-between align-items-center mb-4">
                                      
                                        <div class="left_img_text">
                                            <div class="cart_small_img">
                                              <a href="{{ route('product-detail',['slug' => $product['slug'], 'id' => encrypt($product['id'])]) }}">
                                                <img src="{{ storage::url($product['image']) }}"
                                                    alt="" />
                                              </a>
                                            </div>
                                            <div class="img_left_text">
                                                <h5>
                                                  {!! Str::limit($product['name'], 30, ' ...') !!}
                                                </h5>
                                                <span>{!! Str::limit($product['description'], 40, ' ...') !!}</span>
                                            </div>
                                        </div>
                                      
                                        <div class="right_text">
                                            <div class="price my-2">${{ $product['discounted_price'] }}
                                                <strike class="original-price">${{ $product['price'] }}</strike>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-4 mt-md-0">

                                    <div class="mt-4"></div>
                                    <div class="cart-total-sm">
                                        <span><strong>Subtotal:</strong></span>
                                        <span class="card-total-price">${{ $product['discounted_price'] }}</span>
                                    </div>
                                    <div class="clearfix mt-4">
                                        <button type="submit" class="shopnow">Place Order</button>
                                    </div>
                                </div>


                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#formcheckoutCheckbox2').on('change', function() {
                if ($(this).is(':checked')) {
                    var shipping_country = $('#shipping_country').val();
                    var shipping_state = $('#shipping_state').val();
                    var shipping_zipcode = $('#shipping_zipcode').val();
                    var shipping_address = $('#shipping_address').val();
                    $('#billing_country').val(shipping_country);
                    $('#billing_state').val(shipping_state);
                    $('#billing_zipcode').val(shipping_zipcode);
                    $('#billing_address').val(shipping_address);
                    $('#billing_country').removeClass('error');
                    $('#billing_state').removeClass('error');
                    $('#billing_zipcode').removeClass('error');
                    $('#billing_address').removeClass('error');
                    $('#billing_country-error').css('display','none');
                    $('#billing_state-error').css('display','none');
                    $('#billing_zipcode-error').css('display','none');
                    $('#billing_address-error').css('display','none');

                }else{
                   
                    $('#billing_country').val('');
                    $('#billing_state').val('');
                    $('#billing_zipcode').val('');
                    $('#billing_address').val('');
                }
            });

            // save address my account ajax
            $('#formcheckoutCheckbox1').on('change', function() {
                if ($(this).is(':checked')) {
                    var shipping_country = $('#shipping_country').val();
                    var shipping_state = $('#shipping_state').val();
                    var shipping_zipcode = $('#shipping_zipcode').val();
                    var shipping_address = $('#shipping_address').val();
                    var shipping_name = $('#shipping_name').val();
                    var shipping_phone = $('#shipping_phone').val();
                    $.ajax({
                        url: "{{ route('save.address') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "country": shipping_country,
                            "state": shipping_state,
                            "zipcode": shipping_zipcode,
                            "address": shipping_address,
                            "name": shipping_name,
                            "phone": shipping_phone,
                        },
                        success: function(data) {
                            toastr.success('Address saved successfully');
                        }
                    });
                }
            });
        });
    </script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
        $(function() {

            /*------------------------------------------
            --------------------------------------------
            Stripe Payment Code
            --------------------------------------------
            --------------------------------------------*/

            var $form = $(".require-validation");

            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvv').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            /*------------------------------------------
            --------------------------------------------
            Stripe Response Handler
            --------------------------------------------
            --------------------------------------------*/
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    // console.log(response.error);
                    toastr.error(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];

                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
    </script>
    <script>
        $('.require-validation').validate({
            rules: {
                'card-number': {
                    required: true,
                    minlength: 19,
                    maxlength: 19
                },
                'card-cvv': {
                    required: true,
                    number: true,
                    minlength: 3,
                    maxlength: 4,

                },
                'card-expiry-month': {
                    required: true,
                    // minlength: 2,
                    // maxlength: 2
                },
                'card-expiry-year': {
                    required: true,
                    number: true,
                    minlength: 4,
                    maxlength: 4,
                },

                'shipping_name': {
                    required: true,
                    minlength: 2,
                    maxlength: 50
                },
                'shipping_phone': {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    number: true,

                },
                'shipping_address': {
                    required: true,
                    minlength: 2,
                    maxlength: 100
                },
                'shipping_zipcode': {
                    required: true,
                    minlength: 2,
                    maxlength: 10
                },
                'shipping_state': {
                    required: true,
                    minlength: 2,
                    maxlength: 50
                },
                'shipping_country': {
                    required: true,
                    minlength: 2,
                    maxlength: 50
                },

                'billing_address': {
                    required: true,
                    minlength: 2,
                    maxlength: 100
                },
                'billing_zipcode': {
                    required: true,
                    minlength: 2,
                    maxlength: 10
                },
                'billing_state': {
                    required: true,
                    minlength: 2,
                    maxlength: 50
                },
                'billing_country': {
                    required: true,
                    minlength: 2,
                    maxlength: 50
                },
            },


            messages: {

                shipping_name: {
                    required: "Please enter your name",
                    minlength: "Please enter a valid name",
                    maxlength: "Please enter a valid name"
                },
                shipping_phone: {
                    required: "Please enter your phone number",
                    minlength: "Please enter a valid phone number",
                    maxlength: "Please enter a valid phone number"
                },
                shipping_address: {
                    required: "Please enter your shipping address",
                    minlength: "Please enter a valid shipping address",
                    maxlength: "Please enter a valid shipping address"
                },
                shipping_zipcode: {
                    required: "Please enter your shipping zipcode",
                    minlength: "Please enter a valid shipping zipcode",
                    maxlength: "Please enter a valid shipping zipcode"
                },
                shipping_state: {
                    required: "Please enter your shipping state",
                    minlength: "Please enter a valid shipping state",
                    maxlength: "Please enter a valid shipping state"
                },
                shipping_country: {
                    required: "Please enter your shipping country",
                    minlength: "Please enter a valid shipping country",
                    maxlength: "Please enter a valid shipping country"
                },

                billing_address: {
                    required: "Please enter your billing address",
                    minlength: "Please enter a valid billing address",
                    maxlength: "Please enter a valid billing address"
                },
                billing_zipcode: {
                    required: "Please enter your billing zipcode",
                    minlength: "Please enter a valid billing zipcode",
                    maxlength: "Please enter a valid billing zipcode"
                },
                billing_state: {
                    required: "Please enter your billing state",
                    minlength: "Please enter a valid billing state",
                    maxlength: "Please enter a valid billing state"
                },
                billing_country: {
                    required: "Please enter your billing country",
                    minlength: "Please enter a valid billing country",
                    maxlength: "Please enter a valid billing country"
                },


            }
        });
    </script>
    <script>
        $('#card-number').on('input propertychange paste', function() {
            var value = $('#card-number').val();
            var formattedValue = formatCardNumber(value);
            $('#card-number').val(formattedValue);
        });

        function formatCardNumber(value) {
            var value = value.replace(/\D/g, '');
            var formattedValue;
            var maxLength;
            // american express, 15 digits
            if ((/^3[47]\d{0,13}$/).test(value)) {
                formattedValue = value.replace(/(\d{4})/, '$1 ').replace(/(\d{4}) (\d{6})/, '$1 $2 ');
                maxLength = 17;
            } else if ((/^3(?:0[0-5]|[68]\d)\d{0,11}$/).test(value)) { // diner's club, 14 digits
                formattedValue = value.replace(/(\d{4})/, '$1 ').replace(/(\d{4}) (\d{6})/, '$1 $2 ');
                maxLength = 16;
            } else if ((/^\d{0,16}$/).test(value)) { // regular cc number, 16 digits
                formattedValue = value.replace(/(\d{4})/, '$1 ').replace(/(\d{4}) (\d{4})/, '$1 $2 ').replace(
                    /(\d{4}) (\d{4}) (\d{4})/, '$1 $2 $3 ');
                maxLength = 19;
            }

            $('#card-number').attr('maxlength', maxLength);
            return formattedValue;
        }
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
