@extends('auth.master')
@section('content')
<div class="col-12 col-md-7">
    <form method="post" action="">
        {{ csrf_field() }}
        <div class="forget-text">
            @include('flash-message')
            <h1 class="font-45">Reset Password</h1>
            <div class="from-box forms-box">
                <div class="form__group">
                    <input type="password" id="new_password" name="new_password" class="form__field">
                    <label for="new_password" class="form__label">New Password</label>
                </div>
                <div class="form-icon">
                    <i class="fa-solid fa-eye hide-icon toggle-password" toggle="#PasswordSing"></i>
                </div>
            </div>
            <div class="from-box forms-box">
                <div class="form__group">
                    <input type="password" id="confirm_password" name="confirm_password" class="form__field">
                    <label for="new_password" class="form__label">Confirm Password</label>
                </div>
                <div class="form-icon">
                    <i class="fa-solid fa-eye hide-icon toggle-password" toggle="#PasswordSing"></i>
                </div>
            </div>
            <div class="forget-btn">
                <button class="reset font-22" id="resetPassword">
                    Submit
                </button>
            </div>
        </div>
    </form>
</div>
@push('script')
    <script>
        $('form').submit( function(){
            $('button').attr('disabled','disabled');
            $('input[type="submit"]').attr('disabled','disabled');
            loaderBar()
        })
    </script>
@endpush
@endsection
