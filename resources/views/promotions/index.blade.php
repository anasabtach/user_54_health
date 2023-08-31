@extends('master') @section('content') <main>
    <div class="container">
        
      {{-- <div class="main_crd_box" style="margin-top:300px">
              <div class="row">
                      @foreach($promotions AS $promotion)
                          
                  <div class="col-sm-4">
                      <div class="card">
                          <img class="card-img-top" src="https://cloudinary.hbs.edu/hbsit/image/upload/s--O0PXWnT3--/f_auto,c_fill,h_375,w_750,/v20200101/BDD0688FF02068E5C427B0954F8A2297.jpg" alt="Card image cap">
                              <div class="card-body">
                                  <h5 class="card-title">{{ $promotion->name }}</h5>
      <p class="card-text">{{ $promotion->description }}</p>
    </div>
    <div class="rateit" data-rateit-value="3.5" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
    </div>
    </div> @endforeach </div>
    </div> --}} 
    <section class="sec-management">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div style="margin:10px 0;" id="_error_div" class="error_div"></div>
            <div style="margin:10px 0;" id="_success_dev" class="success_div"></div>
            <div class="on-going-deal d-flex align-items-center justify-content-between">
              <div class="deal-title">
                <h1>Promotions</h1>
              </div>
              <div class="deal-img">
                {{-- <a href="https://business.54health.org/deal/create">
                  <img src="https://business.54health.org/frontend/assets/img/deal-plus.png" alt="deal-img" class="img-fluid">
                </a> --}}
              </div>
            </div>
          </div>
        </div>
        <div id="deal-container" class="row deal-row">
            @foreach($promotions AS $promotion)
                <div class="col-md-3 pt-10">
                    <div class="deal-card">
                    <a href="{{ route('promotions.detail', ['id'=>base64_encode($promotion->id)]) }}">
                        <div class="card-deal-img">
                        <div class="img-card">
                            <img src="https://admin.54health.org/storage/deal/R8jQBBGnUKpPwOJJHU85hEaMWzDlCyedqi9943gw.jpg" title="Theodore Thomas" alt="Theodore Thomas" class="img-fluid">
                        </div>
                        <div class="deal-icon">
                            <img src="https://business.54health.org/frontend/assets/img/noun-fo0d-deal.png" alt="noun-food-and" class="img-fluid">
                        </div>
                        </div>
                        <div class="card-text">
                        <ul class="review-star d-flex align-items-center">
                            <li>
                                <div class="rateit" data-rateit-value="{{ $promotion->totalRating() }}" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                            </li>
                            <li class="ms-2 color-2e3336">({{ $promotion->ratings_count }} review)</li>
                        </ul>
                        <div class="card-title">
                            <p class="color-2e3336 font-18">Theodore Thomas</p>
                            <p class="color-333 font-14">Ad qui nisi quaerat</p>
                        </div>
                        </div>
                        <div class="deal-footer">
                        <ul class="d-flex align-items-center">
                            {{-- <li>
                            <img src="https://business.54health.org/frontend/assets/img/Location.png" alt="location" class="img-fluid">
                            </li>
                            <li class="footer-california ms-1"> Hyderabad, Pakistan </li> --}}
                        </ul>
                        </div>
                    </a>
                    </div>
                </div>
            @endforeach          
        </div>
      </div>
    </section>
    </div>
  </main> 

  @endsection 
  @push('stylesheet')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.rateit/1.1.5/rateit.min.css" integrity="sha512-VtezewVucCf4f8ZUJWzF1Pa0kLqPwpbLU/+6ocHmUWaoPqAH9F8gKmPkVYzu2wGWQs6DYuPxijbBfti7B+46FA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
  @endpush 
  @push('script') 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.rateit/1.1.5/jquery.rateit.min.js" integrity="sha512-ttBgr7TNuS+00BFNY+TkWU9chna3buySaRKoA9IMmk+ueesPbUfyEsWdn5mrXB+cG+ziRdEXMHmsJjGmzBZJYQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
  @endpush