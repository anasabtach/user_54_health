<!doctype html>
<html lang="en">
   @include('head')
   <body class="height bg-ofwhite">
      <header class="bg-grey height-81">
         <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
               <div class="container-fluid">
                  <a class="navbar-brand" href="{{ URL::to('/') }}">
                  <img src="{{ URL::to('frontend/assets/img/logo.png') }}" alt="logo" class="img-fluid">
                  </a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item">
                           <a class="nav-link font-14 color" href="{{ URL::to('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link font-14 color-grey {{ Request::route()->getName() == 'about' ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                        </li>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link font-14 color-grey {{ Request::route()->getName() == 'participating-businesses' ? 'active' : '' }}" href="{{ route('participating-businesses') }}" >Participating Businesses</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link font-14 color-grey {{ Request::route()->getName() == 'membership' ? 'active' : '' }}" href="{{ route('membership') }}" > Membership</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link font-14 color-grey {{ Request::input('tab') == 'referral-link' ? 'active' : '' }}" href="{{ URL::to('my-account?tab=referral-link') }}" > Referrals</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link font-14 color-grey {{ Request::route()->getName() == 'contact' ? 'active' : '' }}" href="{{ route('contact') }}" >Contact</a>
                        </li>
                        @if( !Auth::check() )
                            <li class="nav-item bg-yellow">
                                <a class="nav-link font-14 bg-yellow hover-white" href="{{ route('login') }}" >Sign in</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-14 text-yellow" href="{{ route('login') }}" >Become a member</a>
                            </li>
                        @endif
                        @if( Auth::check() )
                            <li class="nav-item">
                                <div class="dropdown notification-dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-bell  height-24"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('welcome') }}">
                                               <div class="d-flex align-items-center">
                                                  <div class="icon-box2">
                                                     <img style="object-fit: contain;width: 100%;height: 100%;" src="{{ URL::to('frontend/assets/img/logo.png') }}" alt="" class="img-fluid">
                                                  </div>
                                                  <div class="text-box2">
                                                    <p>Welcome to 54 Health,</p>
                                                    <Date class="date">{{ Auth::user()->created_at->format('m-d-Y h:i A') }}</Date>
                                                  </div>
                                               </div>
                                            </a>
                                         </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="dropdown logout-dropdown">
                                    <a class=" dropdown-toggle pt-0 font-14 " href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ session('user')->image_url }}" style="width: 50px;height: 50px;border-radius: 50%;">
                                        <span>{{ session('user')->name }}</span>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li>
                                            <a class="dropdown-item" href="{{ URL::to('my-account') }}">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-1">
                                                    <img src="{{ asset('frontend/assets/img/setting-logout-1.png') }}" alt="setting-logout-1" class="">
                                                </div>
                                                <div class="text-1 ms-3" >
                                                    My Account
                                                </div>
                                            </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ URL::to('user/logout') }}">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-1">
                                                    <img src="{{ asset('frontend/assets/img/logout-settimg-1.png') }}" alt="logout-settimg-1" class="img-fluid">
                                                </div>
                                                <div class="text-1 ms-3" >
                                                    Logout
                                                </div>
                                            </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif
                     </ul>
                  </div>
               </div>
            </nav>
         </div>
      </header>
      <div class="{{ $box_center_class }} p-none">
         <main>
            <section class="sec-login pt notification-sec">
               <div class="container ">
                  <div class="row justify gx-0  pt-10">
                     <div class="col-12 col-xl-10  bg-ofwhite">
                        <div class="row align-items-center bg-white gx-0 box-shadow-center ">
                           <div class="col-12 col-md-12">
                                <img class="img-fluid" src="{{ URL::to('images/welcome.png') }}">
                                <!--<div class="noti-box">
                                    <div class="noti-img">
                                        <img style="object-fit: contain;height: 100px;" class="img-fluid" src="{{ URL::to('frontend/assets/img/slider-home.png') }}">
                                    </div>
                                    <div style="margin-top: -40px;" class="noti-text">
                                            <p>Thank you for joining our community of local businesses dedicated to supporting teachers, veterans, healthcare professionals and first responders.</p>
                                            <p>Our platform was designed to create opportunities for local businesses to support local heroes by providing them with access to exclusive discounts and complimentary services. </p>
                                            <p>Please feel free to reach out to me directly at (469) 866-4140 or carlosnavarro@54health.org with any questions, comments, concerns or feedback. </p>
                                            <p>Thank you for supporting our mission, Carlos Navarro </p>
                                    </div>
                            </div> -->
                            </div>
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
   </body>
</html>

