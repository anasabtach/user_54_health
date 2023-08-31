<!doctype html>
<html lang="en">
   @include('head')
   <body class="{{ $body_class }}">
      <div id="overlay"></div>
      <header class=" d-none d-md-block {{ $header_class }} fixed-top top-fixed">
         <div class="container">
            <nav class="navbar navbar-expand-md ">
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
                        {{-- <li class="nav-item">
                           <a class="nav-link font-14 color-grey {{ Request::route()->getName() == 'promotions.index' ? 'active' : '' }}" href="{{ route('promotions.index') }}">Promotions</a>
                        </li> --}}
                        </li>
                         @if( Auth::check() )
                         @if(!empty(session('user')->user_package->package_id) &&  strtotime(session('user')->subscription_expiry_date) >= strtotime(date('Y-m-d')))
                        <li class="nav-item">
                           <a class="nav-link font-14 color-grey {{ Request::route()->getName() == 'participating-businesses' ? 'active' : '' }}" href="{{ route('participating-businesses') }}" >Participating Businesses</a>
                        </li>
                         @endif
                         @endif
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
      @if( Auth::check() )
        <header class="d-block d-md-none">
         <div class="d-flex align-items-center justify-content-between">
            <div class="logo">
               <a class="navbar-brand" href="{{ URL::to('/') }}">
               <img src="{{ asset('frontend/assets/img/logo.png') }}" alt="logo" class="img-fluid">
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
                                <p>Welcome to 54 Health,</p>
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
                                 <img src="{{ asset('frontend/assets/img/setting-logout-1.png') }}" alt="setting-logout-1">
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
               <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-bars"></i></button>
            </div>
         </div>
      </header>
      @endif
      @yield('content')
      @if( $is_show_footer )
        @include('footer')
      @endif
      @include('mobile-menu-bar')
      @stack('script')
      @if( !empty(session('user')) )
        <script>
            let user_id = '{{ session("user")->id }}';
        </script>
      @endif
      @if( Session::has('auth_error') )
        <script>
            alert('{{ Session::get("auth_error") }}')
        </script>
      @endif
      <script src="{{ asset('frontend/assets/js/skylo.js') }}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
      <script src="{{ asset('frontend/assets/js/function.js') }}"></script>
    </body>
</html>
