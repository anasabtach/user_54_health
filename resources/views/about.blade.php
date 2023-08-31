@extends('master')
@section('content')
    <main>
        <section class="sec-about ">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="about-text-box">
                    <h2 class="font-26">About</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- <div class="col-12">
                    <div class="video-box ">
                    <div class="images-box">
                        <img src="{{ asset('frontend/assets/img/modal-video-img.jpg') }}" alt="paitent" class="img-fluid">
                    </div>
                    </div>
                </div> -->
                <div class="col-12">
                    <div class="video-box ">
                    <div class="slider-item">
                              <div class="row">
                                 <div class="col-12 col-md-5">
                                    <div class="slider-first-img">
                                       <img src="{{ URL::to('frontend/assets/img/slider-home.png') }}" alt="benner-img" class="img-fluid" >
                                    </div>
                                 </div>
                                 <div class="col-12 col-md-7">
                                    <div class="slider-title">
                                          <p>
                                             Five Four Health was founded in memory of Manuel A. Navarro. A dedicated educator who spent his final moments grading student’s work.
                                          </p>
                                          <p>
                                             We are dedicated to providing opportunities for our everyday heroes to invest in their physical, mental and social health.
                                          </p>
                                          <p>
                                             We value and appreciate everyday heroes by uniting local businesses in support of local heroes who dedicate their lives in service to their communities.
                                          </p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 pt-50">
                    <div class="about-text">
                    <div class="about-text-box">
                        <h3 >What We Do</h3>
                        <p class="font-14">Five Four Health partners with local businesses to provide complimentary and discounted services for educators, healthcare professionals, veterans and first responders.</p>
                    </div>
                    </div>
                    <div class="about-text">
                    <div class="about-text-box">
                        <h3>OUR COMMUNITY</h3>
                        <p class="font-14">The Five Four Health Community is a community of local businesses dedicated to improving the health and well-being of our everyday heroes.</p>
                    </div>
                    </div>
                    <div class="about-text">
                    <div class="about-text-box">
                        <h3>OUR Goal</h3>
                        <p class="font-14">To unite local businesses in support of educators, healthcare professionals, veterans and first responders. </p>
                    </div>
                    </div>
                    <div class="about-text">
                    <div class="about-text-box">
                        <h3>OUR Vision</h3>
                        <p class="font-14">For everyday heroes to feel supported, valued and appreciated by the communities they serve.</p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
    </main>
@endsection
