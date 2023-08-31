@extends('master')
@section('content')
<form method="POST" action="{{ route('http-request') }}">
    <input type="hidden" name="action" value="contact-us">
    {{ csrf_field() }}
    <main>
    <section class="sec-contact pt">
        <div class="container">
            <div class="row ">
                <div class="col-12">
                @include('flash-message')
                <div class="contact-text">
                    <h1 class="font-26 ">Contact Us</h1>
                    <div class="btn-infos">
                        <div class="btn-theme">
                            Get In Touch
                        </div>
                    </div>
                    <p class="font-14">Want more information? Send us an e-mail below!</p>
                </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12 col-md-6">
                <div class="form-groups">
                    <div class="form__group">
                        <input type="text" required name="name" id="name" class="form__field" placeholder="Your Name">
                        <label for="name" class="form__label">Name</label>
                    </div>
                </div>
                </div>
                <div class="col-12 col-md-6">
                <div class="form-groups">
                    <div class="form__group">
                        <input type="email" required name="email" id="email" class="form__field" placeholder="Your Email">
                        <label for="emai" class="form__label">Email</label>
                    </div>
                </div>
                </div>
                <div class="col-12">
                <div class="form-groups">
                    <div class="form__group">
                        <input type="text" required id="message" name="message" class="form__field" placeholder="Your Message">
                        <label for="message" class="form__label">Message</label>
                    </div>
                </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-12">
                    <div class="tab-content-box">
                        <button class="edit-profile font-20">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </main>
</form>
@push('script')
    <script>
        $('form').submit( function(){
            $('#overlay').show();
            $('button').attr('disabled','disabled');
        })
    </script>
@endpush
@endsection
