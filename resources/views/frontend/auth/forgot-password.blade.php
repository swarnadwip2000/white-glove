<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.84.0">
        <title>{{ env('APP_NAME') }} | Forget Password Page</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
        <!-- Bootstrap core CSS -->
        <link href="{{asset('frontend_assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css"/>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link href="{{asset('frontend_assets/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('frontend_assets/css/responsive.css')}}" rel="stylesheet">
         <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
      </head>
  <body>    
    <main>      
      <section class="login_page_bnr pdding_3">
        <div class="login_page_bnr_f">
          <div class="row align-items-center justify-content-between">
            <div class="col-md-12 col-lg-6 col-xl-7">
              <div class="inner_bnr_right_img">
                <img src="{{asset('frontend_assets/images/book_online.png')}}" alt=""/>
              </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xl-5">
              <div class="login_banner_left_text">
                <h2>FORGET YOUR PASSWORD</h2>
                <form action="{{ route('forget.password.check') }}" method="post">
                  @csrf
                  <div class="row g-4">
                    <div class="col-md-12 text-center">
                        <p class="forgot_pass">Please enter your email address for reset your password.</p>
                      </div>
                    <div class="col-md-12">
                      <div class="login_input">
                        <div class="input-group flex-nowrap">
                          <span class="input-group-text" id=""><i class="fa-solid fa-envelope"></i></span>
                          <input type="text" name="email" class="form-control" placeholder="User Email" aria-label="Username" aria-describedby="">
                        </div>
                        @if ($errors->has('email'))
                        <div class="error" style="color:red;">{{ $errors->first('email') }}
                        </div>
                    @endif
                      </div>
                    </div>
                    
                    
                    <div class="col-12">
                      <button class="login_btn w-100" type="submit">Send</button>
                    </div>
                    <div class="col-md-12 dont_acc text-center">
                      <p>Don't Have an Account? <a href="{{ route('register') }}">SIGNUP NOW</a></p>
                    </div>
                   
                  </div>
                </form>
              </div>
            </div>            
          </div>
        </div>
      </section>      
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script src="https://alexandrebuffet.fr/codepen/slider/slick-animation.min.js"></script>  
    <script src="{{asset('frontend_assets/js/bootstrap.bundle.min.js')}}"></script> 
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> 
    <script src="{{asset('frontend_assets/js/custom.js')}}"></script>
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
  </body>
</html>
