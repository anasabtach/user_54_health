@extends('auth.master')
@section('content')
    <div class="col-12 col-md-7">
        <form method="post" action="{{ route('http-request') }}">
            {{ csrf_field() }}
            <input type="hidden" name="action" value="login">
            <input type="hidden" name="device_type" value="web">
            <input type="hidden" name="device_token" value="1234567890">
            <input type="hidden" name="user_group_id" value="3">
            <div class="login-text-box">
                @include('flash-message')
                @if( Request::input('email-verify') == true )
                    <div class="alert alert-success">
                        Your account has been verified successfully
                    </div>
                @endif
                <div class="login-text">
                    <p class="font-20">Login to your existing account</p>
                    <h1 class="font-45">Welcome to <br> Five Four Health</h1>
                </div>
                <div class="from-box forms-box">
                    <div class="form__group">
                        <input type="email" id="Email" name="email" class="form__field" placeholder="Your Email">
                        <label for="Email" class="form__label">Email</label>
                    </div>
                    <div class="form-icon">
                        <i class="fa-solid fa-envelope message-icon "></i>
                    </div>
                </div>
                <div class="from-box">
                    <div class="form__group">
                        <input type="password" id="loginPassword" name="password" class="form__field" placeholder="Your Email">
                        <label for="loginPassword" class="form__label">Password</label>
                    </div>
                    <div class="form-icon">
                        <i class="fa-solid fa-eye-slash hide-icon toggle-password" toggle="#loginPassword"></i>
                    </div>
                </div>
                <div class="sign-btns">
                    <button class="sign-btn font-22" id="signIn">
                        Sign in
                    </button>
                </div>
                <div class="forget-pass text-center">
                    <p>
                        <a href="{{ URL::to('forgot-password') }}" class="font-18 become">Forgot Password?</a>
                    </p>
                    <p>
                        <a href="{{ URL::to('become-member') }}" class="font-18 forget">Become a Member</a>
                    </p>
                </div>
            </div>
        </form>
     </div>
@endsection
