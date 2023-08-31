<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="token" content="{{ encryptData(config('constants.CLIENT_ID')) }}">
      <link rel="stylesheet" href="{{ asset('frontend/assets/bootstrap-5/css/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('frontend/assets/fontawesome/css/all.min.css') }}">
      <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
      <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
      <link rel="stylesheet" href="{{ asset('frontend/assets/css/custom.css') }}">
      <link rel="stylesheet" href="{{ asset('frontend/assets/slick-slider/slick/slick.css') }}">
      <link rel="stylesheet" href="{{ asset('frontend/assets/slick-slider/slick/slick-theme.css') }}">
      <title>{{ env('APP_NAME') }}</title>
      <script>
            let base_url     = '{{ URL::to("/") }}';
            let api_base_url = '{{ env("API_URL") }}';
      </script>
   </head>
   <body>
      <header class="d-none d-md-block">
         <div class="container">
            <nav class="navbar navbar-expand-md ">
               <div class="container-fluid">
                  <a class="navbar-brand" href="{{ URL::to('/') }}">
                  <img src="{{ asset('frontend/assets/img/logo.png') }}" alt="logo" class="img-fluid">
                  </a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item">
                           <a class="nav-link font-14 color active" href="{{ URL::to('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link font-14 color-grey " href="{{ route('about') }}">About</a>
                        </li>
                        </li>
                         @if( Auth::check() )
                             @if(!empty(session('user')->user_package->package_id) &&  strtotime(session('user')->subscription_expiry_date) >= strtotime(date('Y-m-d')))
                                 <li class="nav-item">
                                     <a class="nav-link font-14 color-grey {{ Request::route()->getName() == 'participating-businesses' ? 'active' : '' }}" href="{{ route('participating-businesses') }}" >Participating Businesses</a>
                                 </li>
                             @endif
                         @endif
                        <li class="nav-item">
                           <a class="nav-link font-14 color-grey" href="{{ route('membership') }}" > Membership</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link font-14 color-grey {{ Request::input('tab') == 'referral-link' ? 'active' : '' }}" href="{{ URL::to('my-account?tab=referral-link') }}" > Referrals </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link font-14 color-grey" href="{{ route('contact') }}" >Contact</a>
                        </li>
                        @if( !Auth::check() )
                            <li class="nav-item bg-yellow">
                                <a class="nav-link font-14 bg-yellow hover-white" href="{{ route('login') }}" >Sign in</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-14 text-yellow" href="{{ route('become-member') }}" >Become a member</a>
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
                                                    <p>Welcome to 54 Health</p>
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
                                                    <img src="{{ URL::to('frontend/assets/img/setting-logout-1.png') }}" alt="setting-logout-1" class="">
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
                                                    <img src="{{ URL::to('frontend/assets/img/logout-settimg-1.png') }}" alt="logout-settimg-1" class="img-fluid">
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
      @if( Auth::check() )

        <header class="d-block d-md-none">
         <div class="d-flex align-items-center justify-content-between">
            <div class="logo">
               <a class="navbar-brand" href="{{ URL::to('/') }}">
               <img src="{{ URL::to('frontend/assets/img/logo.png') }}" alt="logo" class="img-fluid">
               </a>
            </div>
            <div class="user-profile d-flex align-items-center">
               <div class="dropdown notification-dropdown">
                  <a class="dropdown-toggle " href="#" role="button" id="dropdownMenuLink"
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
                                <p>Welcome to 54 Health</p>
                                <Date class="date">{{ Auth::user()->created_at->format('m-d-Y h:i A') }}</Date>
                              </div>
                           </div>
                        </a>
                     </li>
                  </ul>
               </div>
               <div class="dropdown logout-dropdown">
                  <a class=" dropdown-toggle pt-0 font-14 " href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa-solid fa-user font-2 me-2 aligns-centers"></i> <span>Jessica</span>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                     <li>
                        <a class="dropdown-item" href="{{ URL::to('my-account') }}">
                           <div class="d-flex align-items-center">
                              <div class="icon-1">
                                 <img src="{{ URL::to('frontend/assets/img/setting-logout-1.png') }}" alt="setting-logout-1">
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
                                 <img src="{{ URL::to('frontend/assets/img/logout-settimg-1.png') }}" alt="logout-settimg-1" class="img-fluid">
                              </div>
                              <div class="text-1 ms-3" >
                                 Logout
                              </div>
                           </div>
                        </a>
                     </li>
                  </ul>
               </div>
               <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-bars"></i></button>
            </div>
         </div>
      </header>
      @endif
      <main>
          @if(Session::has('LoginError'))
              <p class="alert alert-danger">{!! Session::get('LoginError') !!}</p>
          @endif
          @if(Session::has('error'))
              <p class="alert alert-danger">{!! Session::get('error') !!} <a href="{{ route('my-account',['tab' => 'v-pills-settings']) }}" class="btn btn-danger" style="color: white !important;line-height: 2;">Subscribe Now</a></p>
          @endif
         <div class="benner-section">
            <div class="container">
               <div class="row">
                  <div class="col-12">
                      <div class="banner-slider">
                           <!--1. About  -->
                           <div class="slider-item">
                              <div class="row">
                                 <div class="col-12 col-md-5">
                                    <div class="slider-first-img">
                                       <img src="{{ URL::to('frontend/assets/img/slider-home.png') }}" alt="benner-img" class="img-fluid" >
                                    </div>
                                 </div>
                                 <div class="col-12 col-md-7">
                                    <div class="slider-title">
                                          <p>
                                             Five Four Health was founded in memory of Manuel A. Navarro. A dedicated educator who spent his final moments grading student’s work.
                                          </p>
                                          <p>
                                             We are dedicated to providing opportunities for our everyday heroes to invest in their physical, mental and social health.
                                          </p>
                                          <p>
                                             We value and appreciate everyday heroes by uniting local businesses in support of local heroes who dedicate their lives in service to their communities.
                                          </p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!--2. Local businesses supporting local heroes  -->
                           <div class="slider-item">
                              <div class="row">
                                    <div class="col-12">
                                       <div class="img-box text-center pt third-img">
                                          <img src="{{ URL::to('frontend/assets/img/slider-six-img.png') }}" alt="benner-img" class="img-fluid" >
                                       </div>
                                       <div class="benner-text-box pt text-center ">
                                          <h4 class="font-22">
                                             Local businesses supporting local heroes.
                                          </h4>
                                       </div>
                                    </div>
                              </div>
                           </div>
                           <!--3. Social health  -->
                           <div class="slider-item">
                              <div class="row">
                                    <div class="col-12">
                                       <div class="img-box text-center pt">
                                          <img src="{{ URL::to('frontend/assets/img/slider-third-img.png') }}" alt="benner-img" class="img-fluid" >
                                       </div>
                                       <div class="benner-text-box pt text-center ">
                                          <h4 class="font-22">
                                             Humans are inherently social. Whether with friends, family or strangers, we all  deserve  human connection.
                                          </h4>
                                       </div>
                                    </div>
                              </div>
                           </div>
                           <!--4. Mental health  -->
                           <div class="slider-item">
                              <div class="row">
                                    <div class="col-12">
                                       <div class="img-box text-center pt third-img">
                                          <img src="{{ URL::to('frontend/assets/img/slider-fourth-img.png') }}" alt="benner-img" class="img-fluid" >
                                       </div>
                                       <div class="benner-text-box pt text-center ">
                                          <h4 class="font-22">
                                             The mind controls our thoughts, feelings and actions. Take a proactive approach to mental health.
                                          </h4>
                                       </div>
                                    </div>
                              </div>
                           </div>
                           <!-- 5. Physical -health. -->
                           <div class="slider-item">
                              <div class="row">
                                    <div class="col-12">
                                       <div class="img-box text-center pt third-img">
                                          <img src="{{ URL::to('frontend/assets/img/slider-five.png') }}" alt="benner-img" class="img-fluid" >
                                       </div>
                                       <div class="benner-text-box pt text-center ">
                                          <h4 class="font-22">
                                          Move, improve and recover. Take control of your physical health one activity at a time.
                                          </h4>
                                       </div>
                                    </div>
                              </div>
                           </div>
                        </div>

                  </div>
               </div>
            </div>
         </div>
         <!-- benner-section End  -->
         <!-- section feature-brand  -->
         <section class="feature-brand">
            <div class="container pt">
               <div class="row">
                  <div class="col-12">
                     <h4 id="_quote_container" class="text-center feature-text-box"></h4>
                  </div>
               </div>
               {{-- <div class="row pt align-items-center gx-0 pb ">
                  <div class="col-12 col-md-4">
                     <div class="text-box">
                        <h5>Featured Brands</h5>
                        <p>The best deals, sales, coupons & more than <br> 100k offers you can find here.</p>
                        <div class="btn-area">
                           <button onclick="window.location.href='{{ URL::to("brands") }}'" class="btn-theme">
                                View All brands
                           </button>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 col-md-8">
                     <div class="img-row  ">
                        <div id="_vendor_container_1" class="img-col d-flex align-items-center"></div>
                        <div id="_vendor_container_2" class="img-col d-flex align-items-center"></div>
                     </div>
                  </div>
               </div> --}}
            </div>
         </section>
      </main>
      @include('footer')
      @include('mobile-menu-bar')
      @if( Session::has('auth_error') )
        <script>
            alert('{{ Session::get("auth_error") }}')

        </script>
      @endif
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
      <script src="{{ asset('frontend/assets/slick-slider/slick/slick.min.js') }}"></script>
      <script src="{{ asset('frontend/assets/bootstrap-5/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('frontend/assets/js/skylo.js') }}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
      <script src="{{ asset('frontend/assets/js/function.js') }}"></script>
      <script src="{{ asset('frontend/assets/js/home.js') }}"></script>
      <script>
            $(document).ready(function(){
               $('.banner-slider').slick({
                  dots: true,
                  infinite: true,
                  slidesToShow: 1,
                  slidesToScroll: 1 ,
                  arrows: true,
                  autoplay:true,
               });
             });
        </script>
   </body>
</html>
