@extends('master')
@section('content')
<main>
   <section class="participating-businesses-single ">
      <div class="container-fluid mt-10 ">
         <div class="row ">
            <div class="col-12  gx-0">
               <div class="single-card">
                  <div class="card-img">
                    <img style="width:100%; height:100%; object-fit:cover;" src="{{ $record->banner_image_url }}" title="{{ $record->name }}" alt="{{ $record->name }}" class="img-fluid">
                  </div>
               </div>
            </div>
         </div>
         <div class="row card-shadow">
            <div class="col-12">
               <button class="back-button d-none d-xxl-block butn-none" onclick="window.location.href='{{ URL::to("brands") }}'">
                 <img src="{{ URL::to('frontend') }}/assets/img/back-button.png" alt="back-button" class="img-fluid m3-1">
                 <span class="text-Back">Back</span>
               </button>
               <div class="container">
                  <div class="row justify-betweens">
                     <div class="col-12 col-md-11">
                        <button class="d-block d-xxl-none butn-none" id="Button-none" onclick="window.location.href='{{ URL::to("brands") }}'">
                        <img src="{{ URL::to('frontend') }}/assets/img/back-button.png" alt="back-button" class="img-fluid m3-1">
                        <span class="text-Back">Back</span>
                        </button>
                        <div class="single-text">
                           <h1 class="font-26">{{ $record->name }}</h1>
                           <div class="d-flex align-items-center">
                              @if( !empty($record->business_category->title) )
                                <p class="me-4 single-location">
                                    <img src="{{ URL::to('frontend') }}/assets/img/noun-food.png" alt="noun-food" class="img-fluid">
                                    <span class="font-12">{{ !empty($record->business_category->title) ? $record->business_category->title : '' }}</span>
                                </p>
                              @endif
                              <p class=" single-location">
                                 <img src="{{ URL::to('frontend') }}/assets/img/Location.png" alt="Loction" class="img-fluid">
                                 <span class="font-12">{{ $record->address }}</span>
                              </p>
                           </div>
                           <p class="single-star">
                                <ul class="review-star d-flex align-items-center">
                                    <li>
                                        @for( $r=1; $r <= 5; $r++ )
                                            @if( $record->total_rating >= $r )
                                                <img style="width:15px;" src="{{ URL::to('frontend') }}/assets/img/Star.png" alt="star-img" class="img-fluid">
                                            @else
                                                <img style="width:15px;" src="{{ URL::to('frontend') }}/assets/img/Star-light.png" alt="star-img-light" class="img-fluid">
                                            @endif
                                        @endfor
                                    </li>
                                    <li class="ms-2 color-2e3336">({{ $record->total_review > 1 ? "{$record->total_review} reviews" : "{$record->total_review} review" }})</li>
                                </ul>
                           </p>
                        </div>
                     </div>
                     <div class="col-12 col-md-1 ">
                        <div class="btn-about">
                           <button class="about-btn" data-bs-toggle="modal" data-bs-target="#aboutIdModal">
                                About
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section class="participating-businesse ">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
         <div class="container">
            <li class="nav-item" role="presentation">
               <button class="nav-link active font-10 color-3333 text-left" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                  role="tab" aria-controls="home" aria-selected="true">
                PROMOTIONAL DEALS
               </button>
            </li>
         </div>
      </ul>
      <div class="tab-content businesses-tab-content" id="myTabContent">
         <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="container ">
               <div class="row pt">
                  <div class="col-12 ">
                     <h3 class="font-22 color-202124">Promotional Deals</h3>
                  </div>
               </div>
               <div id="deal-container" class="row pt-20"></div>
            </div>
         </div>
      </div>
   </section>
</main>
<div class="review-modal">
    <div class="modal fade officail-code-modal" id="aboutIdModal" data-bs-backdrop="static" data-bs-keyboard="false"
       tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered ">
          <div class="modal-content modal-wid">
             <div class="modal-header">
                <button type="button close-button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                <div class="modal-bottom-border">
                   <div class="single-text-modal text-center">
                      <h1 class="font-26">{{ $record->name }}</h1>
                      <div class="d-flex align-items-center text-center modal-img-text">
                         @if( !empty($record->business_category->title) )
                            <div class="modal-text food-text ">
                                <img src="{{ URL::to('frontend') }}/assets/img/noun-food.png" alt="noun-food" class="img-fluid font-20">
                                <span class="font-12">{{ !empty($record->business_category->title) ? $record->business_category->title : '' }}</span>
                            </div>
                         @endif
                         <div class="modal-img california-text ">
                            <img src="{{ URL::to('frontend') }}/assets/img/Location.png" alt="Location" class="img-fluid font-10">
                            <span class="font-12">{{ $record->address }}</span>
                         </div>
                      </div>
                      <p class="single-star">
                         @if( $record->total_rating > 0 )
                             <img src="{{ URL::to('frontend') }}/assets/img/star-heading.png" alt="star " class="img-fluid me-1">
                         @else
                             <img width="20px" src="{{ URL::to('frontend') }}/assets/img/Star-light.png" alt="star " class="img-fluid me-1">
                         @endif
                         <span class=" me-1">{{ $record->total_rating }}</span>
                         <span class="color-2e3336 me-1"> {{ $record->total_review > 1 ? '('.$record->total_review.' reviews)' : '('.$record->total_review.' review)' }}</span>
                      </p>
                   </div>
                </div>
                <div class="modal-tabs">
                   <nav>
                      <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                         <button class="nav-link active font-10" id="nav-about-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-about" type="button" role="tab" aria-controls="nav-about" aria-selected="true">
                         ABOUT
                         </button>
                         <button class="nav-link font-10" id="nav-profile-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                            aria-selected="false">
                         REVIEWS
                         </button>
                      </div>
                   </nav>
                   <div class="tab-content" id="nav-tabContent">
                      <div class="tab-pane fade show active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                         <div class="tab-content-about">
                            <div class="d-flex  justify-content-between">
                               <div class="tab-text">
                                   @if($record->working_days != null)
                                   @php $workingDays = json_decode($record->working_days); @endphp
                                   
                                   <p class="font-500">Working Days: </p>
                                  
                                        <p class="font-12 color-333">
                                             @foreach($workingDays as $day)
                                            {{ $day }}{{ (!$loop->last)?',':'' }}
                                            @endforeach
                                        <br></p>
                                   
                                   @endif
                                  <p class="font-500">Working Hours</p>
{{--                                  <p class="font-12 color-333">Mon - Sun<br>--}}
                                     {{ date('h:i A',strtotime($record->open_time)) }} - {{ date('h:i A',strtotime($record->close_time)) }}
                                  </p>
                                  <p class="font-500 top-1">Address</p>
                                  <p class="font-12 color-333">{{ $record->address }}</p>
                               </div>
                               <div class="tab-img">
                                 <div style="height:300px; width:420px;" id="map"></div>
                               </div>
                            </div>
                         </div>
                      </div>
                      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                         <div class="tab-content-review">
                            <div class="review-text">
                               <p class="font-500 review-bottom">{{ $record->total_review > 1 ? $record->total_review.' reviews' :  $record->total_review.' review' }}</p>
                               <span id="review_container"></span>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
 @push('script')
    <script>
        let deal_user_id     = '{{ $record->id }}';
        let vendor_name = '{{ $record->name }}';
        let vendor_lat  = '{{ $record->latitude }}';
        let vendot_lng  = '{{ $record->longitude }}';
    </script>
    <script src="{{ asset('frontend/assets/js/vendor-detail.js') }}"></script>
    <script defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&libraries=places,drawing&callback=initMap"></script>
@endpush
@endsection
