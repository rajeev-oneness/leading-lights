@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <div id="myCarousel" class="carousel slide carousel-fade d-none" data-ride="carousel">
        <div class="container">
            <ol class="carousel-indicators carousel-indicators-numbers">
                <li data-target="#myCarousel" data-slide-to="0" class="active">01</li>
                <li data-target="#myCarousel" data-slide-to="1">02</li>
            </ol>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="mask flex-center">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-12 order-md-1 order-2">
                                    <div class="banner-text">
                                        <div class="">
                                            {{-- <img src="
                                                    {{ asset('frontend/images/light.png') }}" class="img-fluid"> --}}
                                            <p class="head">QUALITY <span class="bold">EARLY
                                                    EDUCATION</span> IS NOT
                                                A LUXURY, BUT A <span class="color">NECESSITY</span> <span
                                                    class="bold">FOR EVERY CHILD.</span></p>
                                            <p class="sub-head">Lorem Ipsum is simply dummy text of the printing and
                                                typesetting industry. </p>
                                            <a href="#">Take trial</a>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-12 order-md-2 order-1">
                                    <div class="banner-imgs">

                                         {{-- <img src="{{ asset('frontend/images/banner1.png') }}" class="img-fluid">  --}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="mask flex-center">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-12 order-md-1 order-2">
                                    <div class="banner-text">
                                        <div class="">
                                            <img src="
                                                    {{ asset('frontend/images/light.png') }}" class="img-fluid">
                                            <p class="head">QUALITY <span class="bold">EARLY
                                                    EDUCATION</span> IS NOT
                                                A LUXURY, BUT A <span class="color">NECESSITY</span> <span
                                                    class="bold">FOR EVERY CHILD.</span></p>
                                            <p class="sub-head">Lorem Ipsum is simply dummy text of the printing and
                                                typesetting industry. </p>
                                            <a href="#">Take trial</a>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-12 order-md-2 order-1">
                                    <div class="banner-imgs">

                                        <!-- <img src="images/banner1.png" class="img-fluid"> -->
                                        <!-- <div class="ripple" style="animation-delay: 0s"></div> -->
                                    </div>
                                    <!-- <div class="banner-img">
                                         <img src="images/1.png" class="img-fluid mx-auto pos-ab">
                                         <img src="images/2.png" class="img-fluid mx-auto pos-ab">
                                         <img src="images/3.png" class="img-fluid mx-auto pos-ab">

                                   </div>   -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> -->
        </div>

        <div class="banner-imgss">
            <img src="{{ asset('frontend/images/banner1.png') }}" class="img-fluid">
        </div>
        <img src="{{ asset('frontend/images/dot2.png') }}" class="img-fluid post-img">
        <img src="{{ asset('frontend/images/dot2.png') }}" class="img-fluid post-img2">
        <div class="star-box">
            <div class="d-sm-flex">
                <i class="fa fa-star"></i>
                <div>
                    <p><span>+ 500k</span><br />
                        People have participate to <br />
                        study at Leading Lights</p>
                </div>
            </div>
        </div>
        <div class="star-box2">
            <p><span>IDR 10,000</span><br />

                Get Your First <br />
                Private Class</p>
        </div>
        <div class="ripple" style="animation-delay: 0s"></div>
        <div class="ttt">
        </div>
        <div class="phone">
            <a href=""><i class="fa fa-phone"></i></a>
        </div>
    </div>

    <section id="services" class="all_corce_list">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sub-heading text-center wow fadeInDown" data-wow-duration="2s">
                        <h2>Course Details</h2>
                    </div>
                </div>
            </div>
            <div class="row m-0 mt-5">
                <div class="col-12 col-lg-8 leftpart_course">
                    <div class="course_titl">
                        <h4>{{ $course_details->title }}</h4>
                    </div>
                    <div class="course_image">
                        <img src="{{ asset($course_details->image) }}" class="img-fluid mx-auto">
                    </div>
                    <p class="font-weight-bold">This course includes</p>
                    <div style="border: 1px">
                        {!! $course_details->course_content !!}
                    </div>

                </div>
                <div class="col-12 col-lg-4 rightpart_course">
                    <div class="card shadow-sm">
                        <h5>Course Features</h5>
                        <div class="fea_list">
                            <p>
                                {{ $course_details->description }}
                            </p>
                            <p><span><i class="fa fa-clipboard"></i> No of sessions :</span>  {{ $course_details->sessions }}</p>
                            <p><span><i class="fas fa-calendar-alt"></i> Start Date :</span>{{ date('d-F-y',strtotime($course_details->start_date)) }}</p>
                        </div>
                        <div class="col-12 text-center mt-3 price_bg">
                                <h3>Price: <span>&#8377;{{ $course_details->fees }}</span></h3>
                                <a class="btn btn-add btn-radius" href="javascript:void(0);">ENROLL COURSE</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-none">
                <div class="col-lg-12">
                    <div class="row m-0">
                            <div class="col-12 col-lg-4 mb-3 pl-1 pr-1">
                                <a href="">
                                    <div class="item">
                                        <div class="features-box">
                                            <div class="">
                                                <img src="
                                                        {{ asset($course_details->image) }}" class="img-fluid mx-auto">
                                            </div>
                                            <div class="features-text">
                                                <span><span class="font-weight-bold"> Start date:</span> {{ date('d-F-y',strtotime($course_details->start_date)) }}</span><br>
                                                <span><span class="font-weight-bold"> Fees: &#8377;</span>{{ $course_details->fees }}</span>
                                                <h6>{{ $course_details->title }}</h6>
                                                <p>{{ $course_details->description }}</p>
                                                {!! $course_details->course_content !!}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
