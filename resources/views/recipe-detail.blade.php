@extends('master')
@section('content')
<main>
   <section class="participating-businessea pariatur-bussiness">
      <div class="container  ">
         <div class="row top-1  ">
            <div class="col-12 col-md-4 pt">
               <button class="back-button pb-4" onclick="window.location.href='{{ route('business-detail',['name' => $record->user->slug ]) }}'">
               <img src="{{ URL::to('frontend') }}/assets/img/back-button.png" alt="back-button"  class="img-fluid m3-1">
               <span class="text-Back">Back</span>
               </button>
               <div class="description-img">
                  <img style="width:100%; object-fit:cover;" src="{{ $record->image_url }}" title="{{ $record->name }}" alt="{{ $record->name }}" class="img-fluid">
               </div>
            </div>
            <div class="col-12 col-md-8 pt">
               <div class="discription-text-box ">
                  <div class="discription-text-icon  discription-botoom pt">
                     <div class="discription-text">
                        <h1 class="font-22">
                            {{ $record->name }}
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
                        </h1>
                     </div>
                     <div id="_make_favourite" data-id="{{ $record->id }}" class="discription-icon {{ !empty($record->is_favourite) ? 'active' : '' }}">
                        <i class="fa-solid fa-heart"></i>
                     </div>
                  </div>
                    @if( $record->price_type == 'special_price' )
                        <p class="font-26 ">
                            ${{ $record->price }}
                        </p>
                    @endif
                    @if( $record->price_type == 'off' )
                        <p class="font-26 ">
                            <s>${{ $record->price }}</s>  ${{ $record->sale_price }}
                        </p>
                    @endif
                  <hr>

                  @if( empty($record->is_redeem) || $record->redeem_type == 'multiple' )
                   @include('flash-message')
                     <div class="redeemed-btn gx-0 d-flex align-items-center">
                        <!--<button class="btn-redeemed" data-bs-toggle="modal" data-bs-target="#redeemedModal">-->
                         <button data-id="{{ $record->id }}" class="btn-redeemed" id="redeemedModal">
                           Redeem
                        </button>
                     </div>
                  @else
                     <div class="redeemed-btn gx-0 d-flex align-items-center">
                           <a class="text-info" href="javascript:void(0);">
                              Redeemed
                           </a>
                     </div>
                  @endif
                  @if( !empty($record->how_to_redeem) )
                    <div class="redem-text">
                    <h3 class="font-18">How to redeem? <br/>  <span class="smallLabel">Show 54health membership</span></h3>
                        <h4 class="font-12 howToRedeemBox">{{ $record->how_to_redeem }}</h4>
                    </div>
                 @endif
                 <div class="redem-text">
                 <h3 class="font-18">Description</h3>
                  <h4 class="font-12 ">{{ $record->description }}</h4>
                 </div>


               </div>
            </div>
         </div>
		 
		 <div id="reviews-recipe">
				<h1 class="font-18">Reviews</h1>
			   @auth
				  <form method="post" action="/action">
					  @csrf
					  <input type="hidden" value="addRating" name="action">
					  <input type="hidden" value="deals" name="module">
					  <input type="hidden" value="{{ $record->id }}" name="module_id">
					 <!-- <select name="rating" class="form-control">
						  <option value="1">1</option>
						  <option value="2">2</option>
						  <option value="3">3</option>
						  <option value="4">4</option>
						  <option value="5">5</option>
					  </select> -->
					  
					  <select name="rating" id="rating_simple" class="form-control" style="opacity:0">
							<option value="0" selected="selected"></option>
							<option value="1">Poor</option>
							<option value="2">Below Average</option>
							<option value="3">Average</option>
							<option value="4">Good</option>
							<option value="5">Excellent</option>
						</select>

					  <textarea name="review" class="form-control"></textarea>
					  <input type="submit" value="Submit" id="submitReview" class="btn btn-primary btn-redeemed">
				  </form>
					@if(count($record->rating))
					  <ul class="review-loop">
					  @foreach($record->rating as $rating)
							<li>
								
								<span class="user">{{ $rating->name }}</span>
								<div class="review-content-user">
								<span class="review">{{ $rating->review }}</span> <br/>
								</div>
								<span class="rating">Rating: {{ $rating->rating }}/5</span>
								

							</li>
					  @endforeach
					  </ul>
					@endif
				  @endauth
		 </div>
		 
         <span id="related_deal_section">
            <div class="row pt margin-000">
                <div class="col-12">
                   <h1 class="font-18">Related Products</h1>
                </div>
             </div>
             <div id="deal-container" class="row pt-20"></div>
         </span>

     


      </div>
   </section>
</main>
@if( empty($record->is_redeem) || $record->redeem_type == 'multiple' )
   <div class="modal fade discount-code-modal" id="redeemedModal">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button close-button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
               @include('flash-message')
               <h5 class="text-center  font-26" id="staticBackdropLabel">Code</h5>
               <input type="text" name="deal_code" id="deal_code" placeholder="Redeem Code">
               <button id="_deal_redeem" data-id="{{ $record->id }}" class="btn-submit font-20 ">
                  Submit
               </button>
            </div>
         </div>
      </div>
   </div>
@endif
 @push('script')
    <script>
        let deal_user_id = '{{ $record->user->id }}';
        let deal_type    = '{{ $record->paid_promotion }}';
        let auth         = '{{ Auth::check() ? json_encode(session("user")) : NULL }}';
    </script>
    <script src="{{ asset('frontend/assets/js/recipe-detail.js') }}"></script>
	<script>
		(function (a) {
			a.fn.webwidget_rating_simple = function (p) {
				var p = p || {};
				var b = p && p.rating_star_length ? p.rating_star_length : "5";
				var c = p && p.rating_function_name ? p.rating_function_name : "";
				var e = p && p.rating_initial_value ? p.rating_initial_value : "";
				var d = p && p.directory ? p.directory : "images";
				var f = "";
				var g = a(this);
				b = parseInt(b);
				init();
				g.next("ul").children("li").hover(function () {
					$(this).parent().children("li").css('background-image', 'url(/frontend/assets/img/star-blank.png)');
					var a = $(this).parent().children("li").index($(this));
					$(this).parent().children("li").slice(0, a + 1).css('background-image', 'url(/frontend/assets/img/star-filled.png)')
				}, function () {});
				g.next("ul").children("li").click(function () {
					var a = $(this).parent().children("li").index($(this));
					f = a + 1;
					g.val(f);
					if (c != "") {
						eval(c + "(" + g.val() + ")")
					}
				});
				g.next("ul").hover(function () {}, function () {
					if (f == "") {
						$(this).children("li").css('background-image', 'url(/frontend/assets/img/star-blank.png)')
					} else {
						$(this).children("li").css('background-image', 'url(/frontend/assets/img/star-blank.png)');
						$(this).children("li").slice(0, f).css('background-image', 'url(/frontend/assets/img/star-filled.png)')
					}
				});

				function init() {
					$('<div style="clear:both;"></div>').insertAfter(g);
					g.css("float", "left");
					var a = $("<ul>");
					a.attr("class", "webwidget_rating_simple");
					for (var i = 1; i <= b; i++) {
						a.append('<li style="background-image:url(/frontend/assets/img/star-blank.png)"><span>' + i + '</span></li>')
					}
					a.insertAfter(g);
					if (e != "") {
						f = e;
						g.val(e);
						g.next("ul").children("li").slice(0, f).css('background-image', 'url(/frontend/assets/img/star-filled.png)')
					}
				}
			}
		})(jQuery);

		$(function () {

			$("#rating_simple").webwidget_rating_simple({

				rating_star_length: '5',

				rating_initial_value: '',

				rating_function_name: ''

			});

			$('#rating_simple').change(function () {
		$(".webwidget_rating_simple > li").css('background-image', 'url(/frontend/assets/img/star-blank.png)')

		$(".webwidget_rating_simple > li").slice(0,this.value).css('background-image', 'url(/frontend/assets/img/star-filled.png)')

			});

		});
		$('ul.webwidget_rating_simple li').click(function(){
			$('ul.webwidget_rating_simple li').removeClass('active');
			$(this).addClass('active');
		});
	</script>
 @endpush
@endsection
