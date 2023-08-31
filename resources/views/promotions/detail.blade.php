@extends('master') 
@section('content') 
<main>
    <section class="sec-single-managment mt-5">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-4 col-lg-4 col-xl-3">
            <div class="single-img">
              <img src="https://admin.54health.org/storage/deal/R8jQBBGnUKpPwOJJHU85hEaMWzDlCyedqi9943gw.jpg" alt="gym-weight" class="img-fluid">
            </div>
          </div>
          <div class="col-12 col-md-8 col-lg-8 col-xl-9">
            <div class="single-about-discription">
              <div class="single-about-text d-flex align-items-center justify-content-between">
                <div class="cardio-text">
                  <p class="sigle-detail">Details</p>
                  <div class="star-heading d-flex align-items-center">
                    <h1 class="single-tile">{{ $promotion->name }}</h1>
                    <div class="star-img ms-3">
                      <ul class="review-star d-flex align-items-center">
                        
                        <li>
                            <div class="rateit" data-rateit-value="{{ $promotion->totalRating() }}" data-rateit-ispreset="true" data-rateit-readonly="true"></div>

                        </li>
                        <li class="ms-2 color-2e3336">({{ $promotion->ratings_count }} review)</li>
                      </ul>
                    </div>
                  </div>
                </div>
                {{-- <div class="activiate-text">
                  <div class="active-img">
                    <a href="https://business.54health.org/deal/edit/3364d1742445a57">
                      <img src="https://business.54health.org/frontend/assets/img/pen-single-page.png" alt="pen-single-page" class="img-fluid me-4">
                    </a>
                  </div>
                </div> --}}
              </div>
              {{-- <div class="price-avtice-box d-flex align-items-center justify-content-between">
                <div class="active-checkbox d-flex align-items-center mt-2">
                  <div class="active-text">
                    <p class="me-3">Activate</p>
                  </div>
                  <div class="active-box">
                    <div class="form-check form-switch ">
                      <input class="form-check-input _deal_status" data-slug="3364d1742445a57" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked="">
                    </div>
                  </div>
                </div>
              </div> --}}
              <div class="description-text">
                <p class="font-18">Description</p>
                <p>{{ $promotion->description }}</p>
                {{-- <div class="remedem-text">
                  <p>Redeem Stats</p>
                  <div class="remded-text-box d-flex align-items-center">
                    <div class="remeded-hand ">
                      <div class="img-redem d-flex align-items-center">
                        <div class="redem-img">
                          <img src="https://business.54health.org/frontend/assets/img/user-remed.png" alt="remeded-hand" class="img-fluid">
                        </div>
                        <div class="redem-text  ms-1 ">
                          <span class="redeems-no ">No. of Redeemed:</span>
                          <span class="redeem-28 ms-3">0</span>
                        </div>
                      </div>
                    </div>
                    <div class="user-box-remed">
                      <div class="img-redem d-flex align-items-center">
                        <div class="redem-img">
                          <img src="https://business.54health.org/frontend/assets/img/user-remed.png" alt="remeded-hand" class="img-fluid">
                        </div>
                        <div class="redem-text  ms-1 ">
                          <span class="redeems-no ">No. of Users Redeemed:</span>
                          <span class="redeem-28 ms-3">0</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
          {{-- {{ dd($promotion->getUser(auth()->id(), $promotion->id)->first()) }} --}}
              @if(is_null($promotion->getUser(auth()->id(), $promotion->id)->first()))
  
              <form action="{{ route('promotions.rating') }}" method="POST" id="rating_form">
                  @csrf
                  
                <input type="range" value="0" step="0.25" id="backing5">
                <div class="rateit" data-rateit-backingfld="#backing5" data-rateit-resetable="false"  data-rateit-ispreset="true"
                    data-rateit-min="0" data-rateit-max="5" id="ratings">
                </div>
                  <textarea class="form-control add_field_btm_space" name="description" id="description" cols="30" rows="10"></textarea>
               
                  <input type="hidden" name="rating" id="rating" value="0">
                  <input type="hidden" name="promotion_id" value="{{ base64_encode($promotion->id) }}">
                  <input type="submit" class="btn btn-primary my_btn_style" value="Submit">
              </form>
              @endif
              @include('flash-message')
          </div>
        </div>
      </div>
     
      

      <section class="gradient-custom comments-sec">
        <div class="container my-5 py-5">
          <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-8">
              <div class="card">
                <div class="card-body p-4">
                  <h4 class="text-center mb-4 pb-2">Comments</h4>
                    @foreach($promotion->ratings->whereNUll('parent_id') As $rating)
                        <div class="row">
                            <div class="col">
                            <div class="d-flex flex-start">
                                <div class="flex-grow-1 flex-shrink-1">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-1">
                                        {{ $rating->user->name }}<span class="small">-{{ $rating->user->email }}
                                    </p>
                                    </div>
                                    <p class="small mb-0">
                                        {{ $rating->comment }}
                                    </p>
                                </div>
            
                                @if($rating->replies()->exists())
                                    @foreach($rating->replies AS $reply)
                                    <div class="d-flex flex-start mt-4">
                                        <a class="me-3" href="#">
                                        </a>
                                        <div class="flex-grow-1 flex-shrink-1">
                                        <div>
                                            <div class="d-flex justify-content-between align-items-center">
                                            <p class="mb-1">
                                                {{ $reply->user->name }} <span class="small">-{{ $reply->user->email }}</span>
                                            </p>
                                            </div>
                                            <p class="small mb-0">
                                            {{ $reply->comment }}
                                            </p>
                                        </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                                <form action="{{ route('promotions.reply') }}" method="POST">
                                    @csrf    
                                    <textarea class="form-control" name="reply" required></textarea>
                                    <input type="hidden" name="parent_id" value="{{ base64_encode($rating->id) }}">
                                    <input type="hidden" name="deal_id" value="{{ base64_encode($rating->deal_id) }}">
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </form>
                                </div>
                            </div>
                            </div>
                        </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </section> 

    @endsection
    @push('stylesheet')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.rateit/1.1.5/rateit.min.css" integrity="sha512-VtezewVucCf4f8ZUJWzF1Pa0kLqPwpbLU/+6ocHmUWaoPqAH9F8gKmPkVYzu2wGWQs6DYuPxijbBfti7B+46FA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <style>
      .add_field_btm_space {
          margin-bottom: 25px;
      }
      .my_btn_style {
        background: #ba8b00;
        padding: 12px 30px;
        border-color: #ba8b00;
    }
    </style>
    @endpush 
    @push('script') 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.rateit/1.1.5/jquery.rateit.min.js" integrity="sha512-ttBgr7TNuS+00BFNY+TkWU9chna3buySaRKoA9IMmk+ueesPbUfyEsWdn5mrXB+cG+ziRdEXMHmsJjGmzBZJYQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 

    <script>
        $('#ratings').click(function(){
            $('#rating').val($(this).rateit('value'));
            // $('#rating_form').submit();
        });
    </script>
    @endpush