<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
   
    <title>{{ env('APP_NAME') }} | Register Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('frontend_assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="{{ asset('frontend_assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend_assets/css/responsive.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('styles')
</head>

<body>
    <main>

        <section class="login_page_bnr pdding_3">
            <div class="login_page_bnr_f">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="inner_bnr_right_img">
                            <img src="{{ asset('frontend_assets/images/book_online.png') }}" alt="" />
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="login_banner_left_text">
                            <h2>Register to Explore Exciting Things</h2>
                            <form action="{{ route('register.store') }}" method="post">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-md-12">
                                        <div class="login_input">
                                            <div class="input-group flex-nowrap">
                                                <span class="input-group-text" id=""><i
                                                        class="fa-solid fa-user"></i></span>
                                                <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                                    placeholder="Full Name" aria-label="Username" aria-describedby="">
                                            </div>
                                            @if ($errors->has('name'))
                                                <div class="error" style="color:red;">{{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="login_input">
                                            <div class="input-group flex-nowrap">
                                                <span class="input-group-text" id=""><i
                                                        class="fa-solid fa-envelope"></i></span>
                                                <input type="text" class="form-control" name="email" value="{{ old('email') }}"
                                                    placeholder="Email" aria-label="email" aria-describedby="">
                                            </div>
                                            @if ($errors->has('email'))
                                                <div class="error" style="color:red;">{{ $errors->first('email') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="login_input password_in">
                                            <div class="input-group flex-nowrap">
                                                <span class="input-group-text" id=""><i
                                                        class="fa-solid fa-key"></i></span>
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="Password" id="password-field1" aria-label="Username"
                                                    aria-describedby="" value="{{ old('password') }}">
                                                <a href="javascript:void(0);" id="btnToggle"
                                                    class="input-group-text eye_slash toggle"><i id="eyeIcon"
                                                        toggle="#password-field1" class="fa fa-eye-slash"></i></a>
                                            </div>
                                            @if ($errors->has('password'))
                                                <div class="error" style="color:red;">{{ $errors->first('password') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="login_input password_in">
                                            <div class="input-group flex-nowrap">
                                                <span class="input-group-text" id=""><i
                                                        class="fa-solid fa-key"></i></span>
                                                <input type="password" name="confirm_password" class="form-control"
                                                    id="password-field" placeholder="Confirm Password"
                                                    aria-label="Username" aria-describedby="" value="{{ old('confirm_password') }}">
                                                <a href="javascript:void(0);" id="btnToggle1"
                                                    class="input-group-text eye_slash toggle"><i id="eyeIcon1"
                                                        toggle="#password-field" class="fa fa-eye-slash"></i></a>
                                            </div>
                                            @if ($errors->has('confirm_password'))
                                                <div class="error" style="color:red;">
                                                    {{ $errors->first('confirm_password') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="login_btn w-100" type="submit">Register</button>
                                    </div>
                                    <div class="col-md-12 dont_acc text-center">
                                        <p>Already Have an Account? <a href="{{ route('login') }}">LOGIN</a> Or
                                            register with</p>
                                    </div>
                                    <div class="social_bnr">
                                        <ul>
                                            {{-- <li><a href=""><i class="fa-brands fa-apple"></i></a></li> --}}
                                            <li><a href="{{ route('social.login', ['provider' => 'google']) }}"><i class="fa-brands fa-google"></i></a></li>
                                            <li><a href="{{ route('social.login', ['provider' => 'facebook']) }}"><i class="fa-brands fa-facebook-f"></i></a></li>
                                            {{-- <li><a href=""><i class="fa-brands fa-twitter"></i></a></li> --}}
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
        <script src="https://alexandrebuffet.fr/codepen/slider/slick-animation.min.js"></script>
        <script src="{{ asset('frontend_assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="{{ asset('frontend_assets/js/custom.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script>
            @if (Session::has('message'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.success("{{ session('message') }}");
            @endif

            @if (Session::has('error'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.error("{{ session('error') }}");
            @endif

            @if (Session::has('info'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.info("{{ session('info') }}");
            @endif

            @if (Session::has('warning'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.warning("{{ session('warning') }}");
            @endif
        </script>
        <script>
            $("#eyeIcon").click(function() {
                // alert('d')
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        </script>
        <script>
            $("#eyeIcon1").click(function() {
                // alert('d')
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        </script>
        <script>
            $(document).ready(function() {
                toastr.options = {
                'positionClass': 'toast-top-right',
                // 'preventDuplicates': false,
                'showDuration': '10',
                'hideDuration': '10',
                'timeOut': '800',
                'extendedTimeOut': '800',
                }
                });
        </script>
        @stack('scripts')
