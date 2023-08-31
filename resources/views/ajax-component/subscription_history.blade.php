@if( !empty($data) )
    @foreach( $data as $subscriptionHistory )
        <div class=" display-flex d-flex align-items-center border-boottom ">
            <div class="package-box">
            <p class="font-14 color-3443e5a mb-2">Package</p>
            <p class="color-3443e5a">{{ $subscriptionHistory->package_id != 0 ? $subscriptionHistory->package->title : 'Reward' }}</p>
            </div>
            <div class="subscribed-date-box">
            <p class="font-14 color-3443e5a mb-2">Subscribed Date</p>
            <p class="color-3443e5a">{{ date( 'd M, Y', strtotime($subscriptionHistory->created_at) ) }}</p>
            </div>
            <div class="expiry-date-box">
            <p class="font-14 color-3443e5a mb-2">Expiry Date</p>
            <p class="color-3443e5a">{{ date( 'd M, Y', strtotime($subscriptionHistory->expiry_date) ) }}</p>
            </div>
        </div>
    @endforeach
@else
    <div style="margin: 10px 20px;" class="d-block alert alert-info">
        No Subscription found
    </div>
@endif
