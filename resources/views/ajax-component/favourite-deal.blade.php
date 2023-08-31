@if( !empty($data) )
    @foreach( $data as $record )
        <div class="col-12 col-sm-6 col-md-4 pt-20">
            <a href="{{ route('recipe-detail',['name' => $record->slug]) }}">
            <div class="card card-shadow" style="margin: 0 10px;">
                <div class="img-icon">
                    <img src="{{ $record->image_url }}" class="card-img-top img-fluid" title="{{ $record->name }}" alt="{{ $record->name }}">
                </div>
                <div class="card-body">
                    <h5 class="card-title font-12">{{ Str::limit($record->name,25,' ...') }}</h5>
                    <p class="card-text font-10">{{ Str::limit($record->description, 100,' ...') }}</p>
                </div>
                <hr>
                <div class="card-bottom">
                    <p class="font-14 color-ba8b00">
                        <ul class="d-flex align-items-center">
                            @if(  $record->price_type == 'special_price' )
                                <li class="footer-ralated color-ba8b00">
                                    ${{ $record->price }}
                                </li>
                            @elseif( $record->price_type == 'off' )
                                <li class="footer-ralated color-ba8b00">
                                    <s>${{ $record->price }}</s>  ${{ $record->sale_price }}
                                </li>
                            @else
                                <li class="footer-ralated color-ba8b00">
                                    Free
                                </li>
                            @endif
                        </ul>
                    </p>
                </div>
            </div>
            </a>
        </div>
    @endforeach
@else
    <div class="col-12">
        <div class="alert alert-info d-block">
            No data found
        </div>
    </div>
@endif
