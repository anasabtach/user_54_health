@extends('master')
@section('content')
<main>
   <section class="map-sec">
      <div class="container-fluid gx-0">
         <div class="row gx-0">
            <div class="col-12 col-md-4 col-lg-3 relative" >
               <div class="search-map d-flex align-items-center ">
                  <div class="search-map-icon">
                     <button class="search-back-img" onclick="window.location.href='{{ URL::to("brands") }}'">
                        <img src="{{ URL::to('frontend') }}/assets/img/back-button.png" alt="back-button" class="img-fluid">
                     </button>
                  </div>
                  <div class="input-search ">
                     <input type="text" id="_map_search" placeholder="Search" class="search-input">
                     <img src="{{ URL::to('frontend') }}/assets/img/search-img-header.png" alt="search-img-header" style="cursor:pointer;" id="search-map" class="img-fluid img-of-search">
                     <img src="{{ URL::to('frontend') }}/assets/img/setting-img.png" alt="setting-img" class="img-fluid img-setting" id="settingModal">
                  </div>
               </div>
               <div class="category-text map-category-text">
                  <h6 class="">
                     Category
                  </h6>
                  @if( !empty($businessCategories) )
                    @foreach ( $businessCategories as $businessCategory )
                        <div class="d-flex align-items-center justify-content-between border-3-solid pb-2 pt-2">
                            <p>{{ $businessCategory->title }}</p>
                            <div class="form-check">
                                <input class="form-check-input business_category" type="checkbox" id="check1" name="business_category" value="{{ $businessCategory->id }}">
                            </div>
                        </div>
                    @endforeach
                  @endif
               </div>
               <div id="vendor_list_container" class="map-area"></div>
            </div>
            <div class="col-12 col-md-8 col-lg-9">
               <div class="map-img">
                <div style="height: 100%;" id="map"></div>
            </div>
         </div>
      </div>
      </div>
   </section>
</main>
@push('script')
    <script src="{{ asset('frontend/assets/js/vendor-map.js') }}"></script>
    <script defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&libraries=places,drawing&callback=initMap"></script>
@endpush
@endsection
