@if( !empty($data) )
    @foreach( $data as $record )
        <div class="col-12 col-sm-6 col-md-3 pt-20">
            <a href="{{ route('business-detail',['name' => $record->slug ]) }}">
            <div class="card card-shadow" >
                <div class="img-icon">
                    <img src="{{ $record->image_url }}" title="{{ $record->name }}" alt="{{ $record->name }}" class="card-img-top img-fluid">
                </div>
                <div class="icon">
                    @if(!empty($record->promote_category))
                        @if( $record->promote_category->slug == 'physical-health' )
                            <img src="{{ URL::to('frontend') }}/assets/img/noun-fo0d-deal.png" alt="noun-food-and" class="img-fluid">
                        @elseif( $record->promote_category->slug == 'mental-health' )
                            <img src="{{ URL::to('frontend') }}/assets/img/card-men-head.png" alt="noun-food-and" class="img-fluid">
                        @else
                            <img src="{{ URL::to('frontend') }}/assets/img/card-user-icon.png" alt="noun-food-and" class="img-fluid">
                        @endif
                    @endif
                </div>
                <div class="card-body">
                    <div class="card-review d-flex align-items-center">
                        <ul class="review-star d-flex align-items-center">
                            <li>
                                @for( $r=1; $r <= 5; $r++ )
                                    @if( $record->total_rating >= $r )
                                        <img src="{{ URL::to('frontend') }}/assets/img/Star.png" alt="star-img" class="img-fluid">
                                    @else
                                        <img src="{{ URL::to('frontend') }}/assets/img/Star-light.png" alt="star-img-light" class="img-fluid">
                                    @endif
                                @endfor
                            </li>
                            <li class="ms-2 color-2e3336">({{ $record->total_review > 1 ? "{$record->total_review} reviews" : "{$record->total_review} review" }})</li>
                        </ul>
                    </div>
                    <h5 class="card-title">{{ Str::limit($record->name,25,' ...') }}</h5>
                    <p class="card-text ">
                        {{ Str::limit($record->about, 100,' ...') }}
                    </p>
                </div>
                <hr>
                <div class="card-bottom">
                    <a href="#" class="">
                        <img src="{{ URL::to('frontend') }}/assets/img/Location.png" alt="location" class="img-fluid">
                    </a>
                    <a href="#" class="font-8">{{ Str::limit($record->address,20,'...') }}</a>
                </div>
            </div>
            </a>
        </div>
    @endforeach
@else
    <div class="col-12 col-sm-6 col-md-12 pt-20">
        <div class="alert alert-info">
            No data found
        </div>
    </div>
@endif
