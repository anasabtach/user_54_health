@extends('auth.master')
@section('content')
<div class="col-12 col-md-6 col-lg-7 col-xxl-8">
   <div class="sing-text become-a-member">
      <h1 class="font-50">Become a Member</h1>
      <form method="POST" action="{{ route('http-request') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="action" value="registration">
        <input type="hidden" name="device_type" value="web">
        <input type="hidden" name="device_token" value="1234567890">
        <div class="row">
            @include('flash-message')
            <div class="col-12 col-md-12 col-lg-6">
                <div class="from-box forms-box">
                <div class="form__group">
                    <input type="text" id="name" value="{{ old('name') }}" name="name" class="form__field" required>
                    <label for="name" class="form__label">Your Name</label>
                </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6 phonebefore">
                <div class="from-box forms-box">
                <div class="form__group">
                    <input type="text" id="phone" data-toggle="tooltip" data-placement="top" title="+1-2344322123" value="{{ !empty(old('mobile_no')) ? old('mobile_no') : '' }}" name="mobile_no" class="form__field" required>
                    <label for="phone" class="form__label">Mobile Number</label>
                </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6">
                <div class="from-box forms-box">
                    <div class="form__group">
                        <select id="profession" name="profession" class="form__field" required>
                            <option value=""> -- Select Profession -- </option>
                            <option {{ old('profession') == 'Teacher' ? 'selected' : '' }} value="Teacher">Teacher</option>
                            <option {{ old('profession') == 'Health Care Professional' ? 'selected' : '' }} value="Health Care Professional">Health Care Professional</option>
                            <option {{ old('profession') == 'Veteran' ? 'selected' : '' }} value="Veteran">Veteran</option>
                            <option {{ old('profession') == 'First Responders' ? 'selected' : '' }} value="First Responders">First Responders</option>
                        </select>
                        <label for="Profession" class="form__label">Profession</label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6">
                <div class="from-box forms-box">
                <div class="form__group">
                    <input type="text" id="Professionemail" value="{{ old('email') }}" name="email" class="form__field">
                    <label for="Professionemail" class="form__label">Email Address</label>
                </div>
                </div>
            </div>
            <div class="col-12 col-md-12 mb-5 col-lg-6">
                <p class="font-20 pb-3 work_id">Work ID</p>
                <div class="img-text d-flex align-items-center">
                <div class="img">
                    <img style="width:150px;height:100px;object-fit:contain; cursor:pointer;" src="{{ URL::to('frontend/assets/img/gallery.png') }}" alt="" id="_upload_image" alt="gallery" class="img-fluid" >
                    <input type="file" class="d-none" id="image_url" name="id_card" accept="image/*">
                </div>
                <p class="ms-2">Upload</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-6">
                <div class="from-box">
                <div class="form__group">
                    <input type="password" data-toggle="tooltip" data-placement="top" title="Password should be one uppercase letter, one lowercase letter, one digit, one special character and minimum of length should be an eight characters" id="PasswordSing" name="password" class="form__field">
                    <label for="PasswordSing" class="form__label">Password</label>
                </div>
                <div class="form-icon">
                    <i class="fa-solid fa-eye hide-icon toggle-password" toggle="#PasswordSing"></i>
                </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6">
                <div class="from-box">
                <div class="form__group">
                    <input type="password" id="PasswordConfrim" name="confirm_password" class="form__field">
                    <label for="PasswordConfrim" class="form__label">Confirm Password</label>
                </div>
                <div class="form-icon">
                    <i class="fa-solid fa-eye hide-icon toggle-password" toggle="#PasswordConfrim"></i>
                </div>
                </div>
            </div>
            <div class="row pt-50">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="from-box">
                        <div class="form__group">
                            <input type="text" id="referral_code" name="referral_code" class="form__field" value="{{ Request::input('referral_code') }}">
                            <label for="referral_code" class="form__label">Referral Code</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="from-box">
                        <div style="padding-top: 10px;" class="form_group">
                            <label>Member Type</label>
                            <span>
                                <input required type="radio" id="member_type" name="member_type" value="regular_member">
                                <span style="cursor: pointer;" class="member_radio_btn">Individual Sign-Up</span>
                            </span>
                            <span style="margin-left: 25px;">
                                <input required type="radio" id="member_type" name="member_type" value="organization">
                                <span style="cursor: pointer;" class="member_radio_btn">Signing Up Through An Organization</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-50 d-none" id="organization_name_div">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="from-box">
                        <div class="form__group">
                            <input type="text" id="organization_name" name="organization_name" class="form__field" value="{{ Request::input('organization_name') }}">
                            <label for="organization_name" class="form__label">Organization Name</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-50">
            <div class="col-12 col-md-12 col-lg-6">
                <p class="account font-18">
                <span> Already have an account? </span>
                <a href="{{ URL::to('login') }}"><span class="text-b28b37">Sign in</span></a>
                </p>
            </div>
            <div class="col-12 col-md-12 col-lg-6">
                <div class="submit-button ">
                <button class="submit-btn font-22" id="formSubmit">Submit Membership</button>
                </div>
            </div>
        </div>
      </form>
   </div>
</div>
@push('script')
    <script src="{{ asset('frontend/assets/js/signup.js') }}"></script>
    <script>
         $('[data-toggle="tooltip"]').tooltip()
         $('.member_radio_btn').click( function(){
            $(this).parent().find('input[type="radio"]').prop('checked',true)
         })
         $('input[name="member_type"], .member_radio_btn').click(function(){
            var value = $('input[name="member_type"]:checked').val();
            if( value == 'organization'  ){
                $('#organization_name_div').removeClass('d-none');
            } else {
                $('#organization_name_div').addClass('d-none');
            }
         })
		 
		 $('#phone').on('keypress', function (event) {
			var regex = new RegExp("^[a-zA-Z0-9]+$");
			var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			if (!regex.test(key)) {
			   event.preventDefault();
			   return false;
			}
		});

        $('#profession').change(function(){
            
            if($(this).val() == 'Veteran'){
                $('.work_id').text('Military ID, VA issued ID, DD214 or other document providing proof of service.');
            }else{
                $('.work_id').html('Work ID');
            }
        });
    </script>
@endpush
@endsection
