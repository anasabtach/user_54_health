@extends('master')
@section('content')
<main>
	<section class="participating-business mar-tops ">
		<div class="container ">
			<div class="row pt">
				<div class="col-12 d-flex align-items-center justify-content">
					<h3 class="font-36">Participating Businesses</h3>
					<div class="img-icon d-flex align-items-center">
						<div class="img" id="mapModal" onclick="window.location.href='{{ URL::to("brands/map ") }}'">
							<button class="border-none bg-fff location-dropdown"> <img src="{{ URL::to('frontend') }}/assets/img/location-1.png" alt="location" class="img-fluid"> </button>
						</div>
						<div class="dropdown participating-dropdown">
							<button class="btn btn-secondary dropdown-toggle border-none bg-fff location-dropdown" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"> <img src="{{ URL::to('frontend') }}/assets/img/setting.png" alt="setting" class="img-fluid"> </button>
							<ul class="dropdown-menu " aria-labelledby="dropdownMenuButton1">
								<li>
									<div class="category-text ">
										<h6 class="">
                                            Category
                                        </h6>
                                        @if( !empty($businessCategories) )
                                            @foreach( $businessCategories as $businessCategory )
                                                <div class="d-flex align-items-center justify-content-between border-3-solid pb-2 pt-2">
                                                    <p>{{ $businessCategory->title }}</p>
                                                    <div class="form-check">
                                                        <input class="form-check-input business_category" type="checkbox" id="check1" name="business_category" value="{{ $businessCategory->id }}">
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row pt-20 product-row" id="deal-container"> </div>
			<div class="row">
				<div class="col-12"></div>
			</div>
		</div>
	</section>
</main>
@push('script')
    <script>
        $('.business_category').prop('checked', true);

    </script>
    <script src="{{ asset('frontend/assets/js/brands.js') }}"></script>
@endpush
@endsection
