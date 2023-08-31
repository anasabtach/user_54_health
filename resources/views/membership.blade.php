@extends('master')
@section('content')
<main>
    <section class="sec-membership">
        <div class="container">
            <div class="row ">
                <div class="col-12">
                    <div class="membership-text d-flex align-items-center justify-content ">
                        <h1 class="font-26 ">   Official ID</h1>
                        <div class="btns-group">
                            <button class="btn-theme btn-group font-20" data-bs-toggle="modal"
                                data-bs-target="#memberShip">
                                Membership Card
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="member-annual-img annual-img">
            <div class="row">
                <div class="col-12 ">
                    <div class="member-ship-img">
                        <img src="{{ session('user')->id_card }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
 </main>
 <div class="modal fade" id="memberShip" data-bs-backdrop="static" tabindex="-1" aria-labelledby="memberShipModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered member_ship_modal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="annual-member-ship">
                        <div class="row">
                            <div class="col-12 col-sm-5 col-md-6">
                                <div class="member-ship-54-img">
                                    <img src="{{ asset('frontend/assets/img/member-ship-54.png') }}" alt="" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-12 col-sm-7  col-md-6">
                                <div class="member-ship-text">
                                    <h2>{{ session('user')->name }}</h2>
                                    @if( !empty(session('user')->subscription_expiry_date ) )
                                        <h1>
                                            {{ session('user')->user_package->package_id == 1 ? 'Half Yearly Subscription' : 'Yearly Subscription' }}
                                        </h1>
                                    @endif
                                    <h4>ID : {{ session('user')->id }}</h4>
                                    <p>Expiry Date : {{ !empty(session('user')->subscription_expiry_date) ? date('d F Y',strtotime(session('user')->subscription_expiry_date)) : '' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

