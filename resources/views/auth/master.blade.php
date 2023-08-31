<!doctype html>
<html lang="en">
   @include('head')
   <body class="height bg-ofwhite">
      <header class="bg-grey height-81">
         <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
               <div class="container-fluid">
                  <a class="navbar-brand" href="{{ URL::to('/') }}">
                  <img src="{{ asset('frontend/assets/img/logo.png') }}" alt="logo" class="img-fluid">
                  </a>
               </div>
            </nav>
         </div>
      </header>
      <div class="{{ $box_center_class }}">
         <main>
            <section class="sec-login pt">
               <div class="container ">
                  <div class="row justify gx-0  pt-10">
                     <div class="col-12 col-xl-10  bg-ofwhite">
                        <div class="row align-items-center bg-white gx-0 box-shadow-center ">
                           <div class="col-12 col-md-4">
                              <div class="login-box ">
                                 <div class="login-sign-img">
                                    <img src="{{ asset('frontend/assets/img/banner-img.png') }}" alt="" class="img-fluid">
                                 </div>
                              </div>
                           </div>
                           @yield('content')
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </main>
      </div>
      <script src="{{ asset('frontend/assets/js/skylo.js') }}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
      <script src="{{ asset('frontend/assets/js/function.js') }}"></script>
      @stack('script')
      <script>
         $( document ).ready(function() {
             $(".toggle-password").click(function() {

                 $(this).toggleClass("fa-eye fa-eye-slash");
                 var input = $($(this).attr("toggle"));

                 if (input.attr("type") == "password") {
                    input.attr("type", "text");
                 } else {
                    input.attr("type", "password");
                 }
            });
            $('form').submit( function(e){
                $('button').attr('disabled','disabled');
                $('input[type="submit"]').attr('disabled','disabled');
                loaderBar();
            })
         });
      </script>
   </body>
</html>
