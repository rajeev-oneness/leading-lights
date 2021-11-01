@extends('teacher.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-play"></i>
                        </div>
                        <div>Arrange video call
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabs-animation">
                <div class="video-box">
                    <img src="{{ asset('frontend/images/video.png') }}" class="img-fluid mx-auto d-block">
                    <h4>Let’s Arrange a Quick </h4>
                    <h2>Video Call</h2>
                    <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean
                        sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.
                        Duis sed odio sit amet </p>
                    <button class="btn-pill btn btn-dark btn-lg">SCHEDULE NOW</button>
                </div>
            </div>
        </div>
        @include('teacher.layouts.static_footer')
    </div>

@endsection
