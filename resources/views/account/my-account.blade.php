@extends('master')
@section('content')

<main>
   <section class="my-account-sec d-none">
      <div class="d-flex align-items-start">
         <div class="nav account-tabs flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home"
               type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
            <img src="{{ URL::to('frontend') }}/assets/img/profile-bulk.png" alt="" class="img-fluid non-active-icon">
            <img src="{{ URL::to('frontend') }}/assets/img/profile-bulk-colorfuul.png" alt="" class="img-fluid active-icon">
            Profile
            </button>
            <button class="nav-link" id="v-pills-changepassword-tab" data-bs-toggle="pill"
                  data-bs-target="#v-pills-changepassword" type="button" role="tab" aria-controls="v-pills-changepassword-tab"
                  aria-selected="true">
                    <img src="{{ URL::to('frontend') }}/assets/img/profile-bulk.png" alt="profile-bulk"
                        class="img-fluid non-active me-2">
                    Change Password
            </button>
            <button class="nav-link " id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile"
               type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                <img src="{{ URL::to('frontend') }}/assets/img/share.png" alt="share" class="img-fluid non-active-icon">
                <img src="{{ URL::to('frontend') }}/assets/img/share-color-full.webp" alt="" class="img-fluid active-icon">
                <span> Referral Link </span>
            </button>
            <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages"
               type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                <img src="{{ URL::to('frontend') }}/assets/img/heart-black.png" alt="heart" class="img-fluid non-active-icon">
                <img src="{{ URL::to('frontend') }}/assets/img/heart-color-full.png" alt="heart" class="img-fluid active-icon">
                My Favorites
            </button>
            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings"
               type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                <img src="{{ URL::to('frontend') }}/assets/img/receipt-black.png" alt="receipt-black" class="img-fluid non-active-icon">
                <img src="{{ URL::to('frontend') }}/assets/img/receipt-color-full.png" alt="receipt-color-full" class="img-fluid active-icon">
                Membership
            </button>
            <button class="nav-link" id="v-pills-notifications-tab" data-bs-toggle="pill"
               data-bs-target="#v-pills-notifications" type="button" role="tab" aria-controls="v-pills-notifications"
               aria-selected="false">
                <img src="{{ URL::to('frontend') }}/assets/img/notification-bing.png" alt="notification-bing" class="img-fluid non-active-icon">
                <img src="{{ URL::to('frontend') }}/assets/img/notification-bing-color-full.png" alt="notification-bing-color-full" class="img-fluid active-icon">
                Notifications
            </button>
            <button class="nav-link" id="v-pills-terms-&-conditions-tab" data-bs-toggle="pill"
               data-bs-target="#v-pills-terms-conditions" type="button" role="tab" aria-controls="v-pills-terms-conditions"
               aria-selected="false">
                <img src="{{ URL::to('frontend') }}/assets/img/document-text.png" alt="document-text" class="img-fluid non-active-icon">
                <img src="{{ URL::to('frontend') }}/assets/img/document-text-color-full.png" alt="document-text-color-full" class="img-fluid active-icon">
                Terms & Conditions
            </button>
            <button class="nav-link" id="v-pills-privacy-policy-tab" data-bs-toggle="pill"
               data-bs-target="#v-pills-privacy-policy" type="button" role="tab" aria-controls="v-pills-privacy-policy"
               aria-selected="false">
                <img src="{{ URL::to('frontend') }}/assets/img/shield-tick.png" alt="" class="img-fluid non-active-icon">
                <img src="{{ URL::to('frontend') }}/assets/img/shield-tick-color-full.png" alt="share-color-full" class="img-fluid active-icon">
                Privacy Policy
            </button>
            <button class="nav-link" id="v-pills-faqs-tab" data-bs-toggle="pill" data-bs-target="#v-pills-faqs"
               type="button" role="tab" aria-controls="v-pills-privacy-policy" aria-selected="false">
                <img src="{{ URL::to('frontend') }}/assets/img/message-question.png" alt="message-question" class="img-fluid non-active-icon">
                <img src="{{ URL::to('frontend') }}/assets/img/message-question-color-full.png" alt="message-question-color-full " class="img-fluid active-icon">
                FAQs
            </button>
            <button class="nav-link d-none" id="v-pills-suscribe-tab" data-bs-toggle="pill" data-bs-target="#v-pills-suscribe"
               type="button" role="tab" aria-controls="v-pills-suscribe" aria-selected="false">
                <img src="{{ URL::to('frontend') }}/assets/img/receipt-black.png" alt="receipt-black" class="img-fluid non-active-icon">
                <img src="{{ URL::to('frontend') }}/assets/img/receipt-color-full.png" alt="receipt-color-full" class="img-fluid active-icon">
                Membership
            </button>
         </div>
         <div class="tab-content account-tabs-content" id="v-pills-tabContent">
            @include('flash-message')
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="tab-content-area">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('http-request') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="action" value="update-profile">
                            <div class="tab-content-box">
                                <div class="d-flex align-items-center justify-content-between profile-box">
                                <div class="grid-col">
                                    <h3>Profile</h3>
                                </div>
                                <div class="grid-col">
                                    <div style="position:relative;" class="img-box">
                                        <img src="{{ session('user')->image_url }}" id="_upload_image" alt="" class="_upload_image img-fluid paitent">
                                        <input type="file" class="d-none" id="image_url" name="image_url" accept="image/*">
                                        <div class="upload-icon">
                                            <img class="_upload_image" src="{{ asset('frontend/assets/img/plus-img.png') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="grid-col">
                                    <button class="edit-profile font-20">
                                        Update Profile
                                    </button>
                                </div>
                                </div>
                                <div class="row profile">
                                <div class="col-12 col-md-6">
                                    <div class="profile-form">
                                        <div class="form__group">
                                            <input type="text" id="name" class="form__field" name="name" value="{{ session('user')->name }}">
                                            <label for="name" class="form__label">Full Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="profile-form">
                                        <div class="form__group">
                                            <input type="text" data-toggle="tooltip" data-placement="top" title="+1-2344322123" id="phoneNumber" class="form__field" name="mobile_no" value="{{ session('user')->mobile_no }}">
                                            <label for="phoneNumber" class="form__label">Mobile Number</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="profile-form">
                                       <div class="form__group">
                                             <select id="profession" name="profession" class="form__field" required>
                                                <option value=""> -- Select Profession -- </option>
                                                <option {{ session('user')->profession == 'Teacher' ? 'selected' : '' }} value="Teacher">Teacher</option>
                                                <option {{ session('user')->profession == 'Health Care Professional' ? 'selected' : '' }} value="Health Care Professional">Health Care Professional</option>
                                                <option {{ session('user')->profession == 'Veteran' ? 'selected' : '' }} value="Veteran">Veteran</option>
                                                <option {{ session('user')->profession == 'First Responders' ? 'selected' : '' }} value="First Responders">First Responders</option>
                                             </select>
                                             <label for="Profession" class="form__label">Profession</label>
                                       </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="profile-form">
                                        <div class="form__group">
                                            <input type="email" id="Workprofession" class="form__field" value="{{ session('user')->email }}" disabled>
                                            <label for="Workprofession" class="form__label">Email Address</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                 <div class="profile-form">
                                     <div class="form__group">
                                         <input type="text" id="Workprofession" class="form__field" value="{{ (empty(session('user')->organization_name)) ? 'Regular Member' : 'Organization' }}" disabled>
                                         <label for="Workprofession" class="form__label">User Type</label>
                                     </div>
                                 </div>
                              </div>
                                @if( !empty(session('user')->organization_name) )
                                    <div class="col-6">
                                        <div class="profile-form">
                                            <div class="form__group">
                                                <input type="text" id="organization_name" class="form__field" value="{{ session('user')->organization_name }}">
                                                <label for="organization_name" class="form__label">Organization Name</label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-6">
                                 <div class="official-photo">
                                     <p>Official  Work ID*</p>
                                     <input type="file" name="id_card" class="form-control" accept="image/*">
                                     <img src="{{ session('user')->id_card }}" alt="" class="img-fluid">
                                 </div>
                             </div>
                                </div>
                            </div>
                    </form>
               </div>
            </div>
            <div class="tab-pane fade" id="v-pills-changepassword" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <div class="tab-content-area">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('http-request') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="action" value="change-password">
                            <div class="tab-content-box">
                                <div class="d-flex align-items-center justify-content-between profile-box">
                                    <div class="grid-col">
                                        <h3>Change Password</h3>
                                    </div>
                                    <div class="grid-col">
                                        <button style="width: 180px;" class="edit-profile font-20">
                                            Update Password
                                        </button>
                                    </div>
                                </div>
                                <div class="row profile">
                                    <div class="col-12 col-md-12">
                                        <div class="profile-form">
                                            <div class="form__group">
                                                <input type="password" id="current_password" class="form__field" name="current_password" required>
                                                <label for="current_password" class="form__label">Current Password</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="profile-form">
                                            <div class="form__group">
                                                <input type="password" class="form__field" name="new_password" required>
                                                <label for="new_password" class="form__label">New Password</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="profile-form">
                                            <div class="form__group">
                                                <input type="password" id="confirm_password" class="form__field" name="confirm_password">
                                                <label for="confirm_password" class="form__label">Confirm Password</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
               </div>
            </div>
            <div class="tab-pane fade account-tabs-content" id="v-pills-profile" role="tabpanel"
               aria-labelledby="v-pills-profile-tab">
               <div class="tab-content-area">
                  <div class="tab-content-box">
                     <div class="row">
                        <div class="col-12 col-md-8">
                           <div class="referral-history-text">
                              <h1 class="font-26">Share the Love!</h1>
                              <p class="font-14">Receive a free added month to your membership each time your referral code <br>
                                 is used! Valid for member or business referral. The more the merrier!
                              </p>
                              <div class="referral-input">
                                 <p class="font-12">Referral Link</p>
                                 <input type="text" id="referral_link" name="referral_link" value="{{ URL::to('become-member') . '?referral_code=' . session('user')->referral_id }}" readonly>
                                 <button data-bs-toggle="modal" data-bs-target="#share_referral_link_modal" class="share-link-btn font-14 ms-1">
                                    Share Link
                                 </button>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 col-md-4">
                           <div class="referral-history-img">
                              <img src="{{ URL::to('frontend') }}/assets/img/speaker.png" alt=" speaker" class="img-fluid">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-12">
                           <div class="referral-text">
                              <h1 class="font-26">Referral History</h1>
                           </div>
                           <div class="referral-table table-responsive">
                              <table class="table font-14 left-1">
                                 <thead>
                                    <tr class="bg-eff2f5 ">
                                       <th scope="col " class="border-right border-left padding-1">Name</th>
                                       <th scope="col" class="border-right padding-1">Email</th>
                                       <th scope="col" class="padding-1">Reward</th>
                                    </tr>
                                 </thead>
                                 <tbody id="referral_history"></tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab-pane fade account-tabs-content" id="v-pills-messages" role="tabpanel"
               aria-labelledby="v-pills-messages-tab">
               <div class="tab-content-area">
                  <div class="tab-content-box">
                     <div class="container-fluid">
                        <div class="row ">
                           <div class="col-12">
                              <div class="my-favorites">
                                 <h1 class="font-26">My Favorites </h1>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="overflow-autos">
                           <div class="row pt-20 gx-0" id="favourite_container"></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab-pane fade account-tabs-content" id="v-pills-settings" role="tabpanel"
               aria-labelledby="v-pills-settings-tab">
               <div class="tab-content-area">
                  <div class="tab-content-box suscribtion-user padding-100">
                     <div class="row ">
                        <div class="col-12">
                           <div class="suscription-text-box">
                              <div class="subscription-text d-flex align-items-center justify-content-between ">
                                 <h1 class="font-26">Membership</h1>
                                 <button class="history-btn font-14" id="historyBtn">
                                 History
                                 </button>
                              </div>
                              <!--<p class="font-14">Choose the right pricing and get started with your Plan</p>-->
                           </div>
                        </div>
                     </div>
                     <div class="row pt-20 suscribtion-text-box">
                        <div class="col-9 col-sm-10 col-md-6 col-lg-5 col-xl-4  " style="display: none">
                            <div class="bg-3b3b4d {{ !empty(session('user')->user_package->package_id) && session('user')->user_package->package_id == 1 && strtotime(session('user')->subscription_expiry_date) >= strtotime(date('Y-m-d')) ? 'active-bg-3b3b4d' : '' }}">
                                <div class="suscribe-text">
                                    <h4 class="font-14">Half Yearly</h4>
                                    <h1 class="font-22">$50.00</h1>
                                    <p class="font-10">The perfect way to get started and get used to our features.</p>
                                    <hr>
                                    <div class="form-check">
                                    <input disabled checked class="form-check-input" type="checkbox" value="" id="Standard">
                                    <label class="form-check-label font-10 text-696982" for="Standard">
                                        6-Month Membership
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <input disabled checked class="form-check-input" type="checkbox" id="Amet">
                                    <label class="form-check-label font-10 text-696982" for="Amet">
                                        Renew after 6 months
                                    </label>
                                    </div>
                                    <div class="suscribes-btn text-center">
                                    <button data-package='1' class="font-20 suscribe-btn _subscription_btn" id="suscribeButton">
                                        Join
                                    </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 col-sm-10 col-md-6 col-lg-5  col-xl-4  ">
                           <div class="bg-3b3b4d {{ !empty(session('user')->user_package->package_id) && session('user')->user_package->package_id == 2 && strtotime(session('user')->subscription_expiry_date) >= strtotime(date('Y-m-d')) ? 'active-bg-3b3b4d' : '' }}">
                            <div class="suscribe-text">
                                <h4 class="font-14">Yearly</h4>
                                <h1 class="font-22">$100.00 </h1>
                                <p class="font-10">First 1,000 members receive 2 years for the price of one</p>
                                <!--<p class="font-10">The perfect way to get started and get used to our features.</p>-->
                                <hr>
                                <div class="form-check">
                                   <input disabled checked class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                   <label class="form-check-label font-10 text-696982" for="flexCheckDefault">
                                    2-Year Membership
                                   </label>
                                </div>
                                <div class="form-check">
                                   <input disabled checked class="form-check-input" type="checkbox" value="" id="cons">
                                   <label class="form-check-label font-10 text-696982" for="cons">
                                    Renew after 2 years
                                   </label>
                                </div>
                                <div class="suscribes-btn text-center">
                                   <button data-package='2' class="font-20 suscribe-btn _subscription_btn" id="suscribeButtonHome">
                                         Join
                                   </button>
                                </div>
                             </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab-pane fade account-tabs-content" id="v-pills-notifications" role="tabpanel"
               aria-labelledby="v-pills-notifications-tab">
               <div class="tab-content-area">
                  <div class="tab-content-box padding-110 ">
                     <div class="row">
                        <div class="col-12">
                           <div class="notifications-text-box">
                              <div class="subscription-text">
                                 <h1 class="font-26">Notifications</h1>
                                 <p class="font-14">Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
                              </div>
                           </div>
                        </div>
                        <div class="col-12">
                           <div class="switch-notification d-flex align-items-center justify-content-between">
                              <p class="font-14 color-3b3b4d">  Notifications On / Off</p>
                              <div class="form-check form-switch">
                                 <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="notification_setting" value="1" {{ session('user')->notification_setting == 1 ? 'checked' : '' }}>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab-pane fade account-tabs-content" id="v-pills-terms-conditions" role="tabpanel"
               aria-labelledby="v-pills-terms-conditions-tab">
               <div class="tab-content-area">
                  <div class="tab-content-box padding-111">
                     <div class="row ">
                        <div class="col-12">
                           <div class="notifications-text-box">
                              <div id="_terms_conditions" class="term-text">
                                 <h1 class="font-26 mb-3">Terms & Conditions</h1>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab-pane fade account-tabs-content" id="v-pills-privacy-policy" role="tabpanel"
               aria-labelledby="v-pills-privacy-policy-tab">
               <div class="tab-content-area">
                  <div class="tab-content-box padding-111">
                     <div class="row ">
                        <div class="col-12">
                           <div class="notifications-text-box">
                              <div id="_privacy_policy" class="term-text">
                                 <h1 class="font-26 mb-3">Privacy Policy</h1>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab-pane fade account-tabs-content" id="v-pills-faqs" role="tabpanel"
               aria-labelledby="v-pills-faqs-tab">
               <div class="tab-content-area">
                  <div class="tab-content-box padding-111">
                     <div class="row ">
                        <div class="col-12">
                           <div class="notifications-text-box">
                              <div id="_faq_" class="term-text">
                                 <h1 class="font-26 mb-3">FAQs</h1>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab-pane fade account-tabs-content" id="v-pills-suscribe" role="tabpanel"
               aria-labelledby="v-pills-suscribe-tab">
               <div class="tab-content-area">
                  <div class="tab-content-box padding-100 padding-suscribed-section">
                     <div class="row ">
                        <div class="col-12">
                           <div id="_subscription_history_param" class="suscribed-text-box">
                              <div class="subscribed-text  ">
                                 <h1 class="font-26">History</h1>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</main>
<div class="modal fade officail-code-modal" id="forgetdModal" data-bs-backdrop="static" data-bs-keyboard="false"
   tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button close-button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body ">
            <h5 class=" Official-id font-26 text-center" id="staticBackdropLabel">Change Password</h5>
            <div class="officail-img text-center">
               <div class="profile-form">
                  <div class="from-box forms-box">
                     <div class="form__group">
                        <input type="password" id="currentName" class="form__field" placeholder="Your Email">
                        <label for="currentName" class="form__label">Current Password</label>
                     </div>
                     <div class="form-icon">
                        <i class="fa-solid fa-eye-slash message-icon toggle-password" toggle="#currentName"></i>
                        <div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="profile-form">
                  <div class="from-box forms-box">
                     <div class="form__group">
                        <input type="password" id="newPassword" class="form__field" placeholder="Your Email">
                        <label for="newPassword" class="form__label">New Password</label>
                     </div>
                     <div class="form-icon">
                        <i class="fa-solid fa-eye-slash message-icon toggle-password" toggle="#newPassword"></i>
                        <div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="profile-form">
                  <div class="from-box forms-box">
                     <div class="form__group">
                        <input type="password" id="confrimPassword" class="form__field" placeholder="Your Email">
                        <label for="confrimPassword" class="form__label">Confirm Password</label>
                     </div>
                     <div class="form-icon">
                        <i class="fa-solid fa-eye-slash message-icon toggle-password" toggle="#confrimPassword"></i>
                        <div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="submit-btns text-center">
                  <button class="submit-btn font-20">
                  Submit
                  </button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="subscription_modal" tabindex="-1" aria-labelledby="subscription_modal" aria-hidden="true">
    <div class="modal-dialog">
        <form id="payment-form" method="post" action="{{ route('http-request') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="action" value="subscription">
            <input type="hidden" name="package_id" value="">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="subscription_modalLabel">Debit/Credit Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form__group">
                        <div id="card-element"></div>
                        <p id="card-errors" role="alert"></p>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
  </div>
  <div class="modal fade" id="share_referral_link_modal" tabindex="-1" aria-labelledby="share_referral_link_modal" aria-hidden="true">
    <div class="modal-dialog">
        <form id="payment-form" method="post" action="{{ route('http-request') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="action" value="share_referral_link">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="subscription_modalLabel">Share Referral Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form__group">
                        <p>Email Address</p>
                        <input type="email" class="form__field" name="email" required>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
  </div>
@push('script')
    @if( !empty(Request::input('tab')) )
       <script>
          $('[data-bs-target="#{{ Request::input('tab') }}"]').trigger('click')
       </script>
    @endif
    @if( Session::has('tab') )
        <script>
            $('[data-bs-target="{{ Session::get("tab") }}"]').trigger('click')
        </script>
    @endif
    <script>
        var STRIPE_PUBLISHED_KEY = '{{ env("STRIPE_KEY") }}';
    </script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&libraries=places" defer></script>
    <script src="{{ asset('frontend/assets/js/my-account.js') }}"></script>
@endpush
@endsection
