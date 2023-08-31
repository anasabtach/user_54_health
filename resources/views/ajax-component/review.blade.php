@if( !empty($data) )
    @foreach( $data as $record )
        <div class="reviews">
            <div class="d-flex justify-content-between">
            <p class="font-14 ">
                {{ $record->user->name }}
                <span class="text-left"><img src="{{ URL::to('frontend') }}/assets/img/Star.png" alt="star"></span>
                <span class="font-12">{{ $record->rating }}/5</span>
            </p>
                <p class="font-10 color-333">{{ date('d-m-Y',strtotime($record->created_at)) }}</p>
            </div>
            <p class="font-10 color-333 border-1-solid bottom-2">
                {{ $record->review }}
            </p>
        </div>
    @endforeach
 @else
    <div class="alert alert-info">
        No Review Found
    </div>
 @endif
