@extends('auth.master')
@section('content')
<div class="col-12 col-md-7">
   <div class="subscription-text">
      @include('flash-message')
      <h1 class="font-50">Subscription</h1>
      <p class="font-20">To avail the amazing deal you need to subscribe first.</p>
      <div class="row">
         <div class="col-12 col-sm-6 col-md-6">
            <div class="suscribe-text">
               <h4 class="font-14">Half Yearly</h4>
               <h1 class="font-22">$99.00</h1>
               <h4 class="font-10">The perfect way to get started and get used to our features.</h4>
               <hr>
               <div class="form-check">
                  <input disabled checked class="form-check-input" type="checkbox" value="" id="Standard">
                  <label class="form-check-label font-10 text-696982" for="Standard">
                    All Features in Standard
                  </label>
               </div>
               <div class="form-check">
                  <input disabled checked class="form-check-input" type="checkbox" id="Amet">
                  <label class="form-check-label font-10 text-696982" for="Amet">
                    Amet cons deri dsei
                  </label>
               </div>
               <div class="form-check">
                  <input disabled checked class="form-check-input" type="checkbox" value="" id="Lorem">
                  <label class="form-check-label font-10 text-696982" for="Lorem">
                    Lorem Ipsum dolor sit
                  </label>
               </div>
               <div class="suscribes-btn text-center">
                  <button data-package='1' class="font-20 suscribe-btn _subscription_btn" id="suscribeButton">
                    Subscribe
                  </button>
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-6">
            <div class="suscribe-text">
               <h4 class="font-14">Yearly</h4>
               <h1 class="font-22">$179.00 <span class="font-10">Sale  20% off</span></h1>
               <h4 class="font-10">The perfect way to get started and get used to our features.</h4>
               <hr>
               <div class="form-check">
                  <input disabled checked class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                  <label class="form-check-label font-10 text-696982" for="flexCheckDefault">
                  All Features in Standard
                  </label>
               </div>
               <div class="form-check">
                  <input disabled checked class="form-check-input" type="checkbox" value="" id="cons">
                  <label class="form-check-label font-10 text-696982" for="cons">
                  Amet cons deri dsei
                  </label>
               </div>
               <div class="form-check">
                  <input disabled checked class="form-check-input" type="checkbox" value="" id="Ipsum">
                  <label class="form-check-label font-10 text-696982" for="Ipsum">
                  Lorem Ipsum dolor sit
                  </label>
               </div>
               <div class="suscribes-btn text-center">
                  <button data-package='2' class="font-20 suscribe-btn _subscription_btn" id="suscribeButtonHome">
                        Subscribe
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
@push('script')
  <script>
    var STRIPE_PUBLISHED_KEY = '{{ env("STRIPE_PUBLISHED_KEY") }}';
  </script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="{{ asset('frontend/assets/js/subscription.js') }}"></script>
@endpush
@endsection
