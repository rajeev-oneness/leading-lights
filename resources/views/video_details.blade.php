@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

    <section id="services" class="all_corce_list">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sub-heading text-center wow fadeInDown" data-wow-duration="2s">
                        <h2>Video Details</h2>
                    </div>
                </div>
            </div>
            <div class="row m-0 mt-5">
                <div class="col-12 col-lg-8 leftpart_course">
                    <div class="course_titl">
                        <h4>{{ $videoDetails->title }}</h4>
                    </div>
                    <div class="course_image">
                        @php
                        $file_path = $videoDetails->video;
                        $file_extension= explode('.',$file_path)[1];
                    @endphp
                    @if ($file_extension === 'jpg' || $file_extension === 'jpeg' || $file_extension === 'png')
                    <div class="bl_img">
                        <img src="{{ asset($file_path) }}" alt="" class="img-fluid mx-auto">
                    </div>
                    @else
                    <div class="bl_img">
                        <video class="img-fluid mx-auto" controls>
                            <source src="{{ asset($file_path) }}" type="video/{{ $file_extension }}">
                        Your browser does not support the video tag.
                        </video>
                    </div>
                    @endif
                    </div>
                </div>
                <div class="col-12 col-lg-4 rightpart_course">
                    <div class="card shadow-sm">
                        <h5>Video Details</h5>
                        <div class="fea_list">
                            <p>
                                {!! $videoDetails->description !!}
                                <!--{{ $videoDetails->description }}-->
                            </p>
                        </div>
                        <div class="col-12 text-center mt-3 price_bg">
                                <h3>Price: <span>&#8377;{{ $videoDetails->amount }}</span></h3>
                                <a class="btn btn-add btn-radius" href="{{ route('video_subscription',$videoDetails->id) }}">SUBSCRIPTION</a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row d-none">
                <div class="col-lg-12">
                    <div class="row m-0">
                            <div class="col-12 col-lg-4 mb-3 pl-1 pr-1">
                                <a href="">
                                    <div class="item">
                                        <div class="features-box">
                                            <div class="">
                                                <img src="
                                                        {{ asset($videoDetails->image) }}" class="img-fluid mx-auto">
                                            </div>
                                            <div class="features-text">
                                                <span><span class="font-weight-bold"> Start date:</span> {{ date('d-F-y',strtotime($videoDetails->start_date)) }}</span><br>
                                                <span><span class="font-weight-bold"> Fees: &#8377;</span>{{ $videoDetails->fees }}</span>
                                                <h6>{{ $videoDetails->title }}</h6>
                                                <p>{{ $videoDetails->description }}</p>
                                                {!! $videoDetails->course_content !!}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
@endsection
