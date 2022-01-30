@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
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
    <!-- features part end -->
    <section id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-sm-12">
                    <div class="about-text">
                        <div class="heading wow fadeInDown" data-wow-duration="2s">
                            <h1>Compatible - <span>just like you!</span></h1>
                        </div>
                        <p>the software is compatible to PC, Android and iOS so our services are accessible to one and all.
                        </p>
                        {{-- <a href="#" class="btn btn-add">Join Now</a> --}}
                    </div>

                </div>
                <div class="col-lg-7 offset-lg-1">
                    <div class="about-box">
                        <img src="{{ asset('frontend/images/about.jpg') }}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section id="latestNews">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sub-heading text-center wow fadeInDown" data-wow-duration="2s">
                        <h2>Latest News</h2>
                    </div>
                </div>
            </div>
            @if ($notices->count() > 0)
            <div class="row">
                <div class="col-sm-12">
                    <div id="testimonials-list" class="owl-carousel">
                        @foreach ($notices as $key => $notice)
                        <div class="item">
                            <div class="shadow-effect">
                                <div class="testimonial-name">{{ $notice->title }}</div>
                                <img class="imgPlaceholder img-fluid"
                                    src="
                                    @if ($key == 0)
                                        {{ asset('frontend/images/t1.png') }}
                                    @elseif ($key == 1)
                                        {{ asset('frontend/images/t2.png') }}
                                    @elseif ($key == 2)
                                        {{ asset('frontend/images/t3.png') }}
                                    @else
                                        {{ asset('frontend/images/t3.png') }}
                                    @endif
                                    " alt="" >
                                {!! $notice->desc !!}
                            </div>

                        </div>
                        @endforeach

                        {{-- <div class="item">
                            <div class="shadow-effect">
                                <div class="testimonial-name">Leading Lights!!!!!!!! Now at NAYABAD</div>
                                <img class="imgPlaceholder img-fluid" src="{{ asset('frontend/images/t2.png') }}" alt="">
                                <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum
                                    auctor, nisi elit consequat</p>
                            </div>

                        </div>


                        <div class="item">
                            <div class="shadow-effect">
                                <div class="testimonial-name">Leading Lights!!!!!!!! Now at NAYABAD</div>
                                <img class="imgPlaceholder img-fluid" src="{{ asset('frontend/images/t3.png') }}" alt="">
                                <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum
                                    auctor, nisi elit consequat</p>
                            </div>
                        </div> --}}


                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-lg-12 text-center mt-5">
                    <a href="#" class="btn btn-add">View All</a>
                </div>
            </div> --}}
            @else
                 <h4 class="text-center">No news available</h4>
            @endif
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sub-heading text-center wow fadeInDown" data-wow-duration="2s">
                        <h2>Popular Courses</h2>
                    </div>
                </div>
            </div>
            @if ($special_courses->count() > 0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-theme test-boxes">
                        @foreach ($special_courses as $course)
                            <div class="item">
                                <div class="features-box">
                                    <div class="">
                                        <img src="
                                                {{ asset($course->image) }}" class="img-fluid mx-auto">
                                    </div>
                                    <div class="features-text">
                                        <h6>{{ $course->title }}</h6>
                                        <p>{{ $course->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class="item">
                            <div class="features-box">
                                <div class="">
                                    <img src="
                                            {{ asset('frontend/images/course2.jpg') }} " class="   img-fluid mx-auto">
                                </div>
                                <div class="features-text">
                                    <h6>Abacus</h6>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum.Ipsum is simply dummy text of the printing.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="features-box">
                                <div class="">
                                    <img src="
                                            {{ asset('frontend/images/course3.jpg') }}" class="img-fluid mx-auto">
                                </div>
                                <div class="features-text">
                                    <h6>Online Coaching</h6>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum.Ipsum is simply dummy text of the printing.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="features-box">
                                <div class="">
                                    <img src="
                                            {{ asset('frontend/images/course1.jpg') }}" class="img-fluid mx-auto">
                                </div>
                                <div class="features-text">
                                    <h6>Drawing</h6>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum.Ipsum is simply dummy text of the printing.</p>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center mt-5">
                    <a href="{{ route('available_courses') }}" class="btn btn-add">View All</a>
                </div>
            </div>
            @else
                <p class="text-warning">No new courses available</p>
            @endif

        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sub-heading text-center wow fadeInDown" data-wow-duration="2s">
                        <h2>Flash Courses</h2>
                    </div>
                </div>
            </div>
            @if ($flash_courses->count() > 0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="row m-0">
                        @foreach ($flash_courses as $course)
                            <div class="col-12 col-lg-4 mb-3 pl-1 pr-1">
                                <a href="{{ route('flash_course_details',$course->id) }}">
                                    <div class="item">
                                        <div class="features-box">
                                            <div class="">
                                                <img src="
                                                        {{ asset($course->image) }}" class="img-fluid mx-auto">
                                            </div>
                                            <div class="features-text">
                                                <h6>{{ $course->title }}</h6>
                                                <p>{{ $course->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center mt-5">
                    <a href="{{ route('flash_courses') }}" class="btn btn-add">View All</a>
                </div>
            </div>
            @else
                <p class="text-warning">No flash courses available</p>
            @endif
        </div>
    </section>

    <!-- consulting part end -->
    <section id="gallery">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sub-heading text-center wow fadeInDown" data-wow-duration="2s">
                        <h2>Students Gallery</h2>
                    </div>
                </div>
            </div>
            <div class="row m-0 student_gallery">
                @if ($student_photos->count() > 0)
                    
                @foreach ($student_photos as $photo)
                    <div class="col-12 col-lg-3 p-1">
                        <div class="card item">
                            <a href="{{ asset($photo->image) }}" data-lightbox="photos">
                                <img src="{{ asset($photo->image) }}" class="card-img-top img-fluid">
                            </a>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="col-12 col-lg-3 p-1">
                    <div class="card item">
                        <a href="{{ asset('frontend/images/g2.jpg') }}" data-lightbox="photos">
                            <img src="{{ asset('frontend/images/g2.jpg') }}" class="card-img-top img-fluid">
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-3 p-1">
                    <div class="card item">
                        <a href="{{ asset('frontend/images/g3.jpg') }}" data-lightbox="photos">
                            <img src="{{ asset('frontend/images/g3.jpg') }}" class="card-img-top img-fluid">
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-3 p-1">
                    <div class="card item">
                        <a href="{{ asset('frontend/images/g4.jpg') }}" data-lightbox="photos">
                            <img src="{{ asset('frontend/images/g4.jpg') }}" class="card-img-top img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-12 col-lg-3 p-1">
                    <div class="card item">
                        <a href="{{ asset('frontend/images/g5.jpg') }}" data-lightbox="photos">
                            <img src="{{ asset('frontend/images/g5.jpg') }}" class="card-img-top img-fluid">
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-3 p-1">
                    <div class="card item">
                        <a href="{{ asset('frontend/images/g2.jpg') }}" data-lightbox="photos">
                            <img src="{{ asset('frontend/images/g2.jpg') }}" class="card-img-top img-fluid">
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-3 p-1">
                    <div class="card item">
                        <a href="{{ asset('frontend/images/g1.jpg') }}" data-lightbox="photos">
                            <img src="{{ asset('frontend/images/g1.jpg') }}" class="card-img-top img-fluid">
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-3 p-1">
                    <div class="card item">
                        <a href="{{ asset('frontend/images/g4.jpg') }}" data-lightbox="photos">
                            <img src="{{ asset('frontend/images/g4.jpg') }}" class="card-img-top img-fluid">
                        </a>
                    </div>
                </div> --}}

                <!--<div class="col-lg-6 d-none">
                    <ul class="gallery">
                        <li class="first"><img src="{{ asset('frontend/images/g1.jpg') }}"
                                class="img-fluid mx-auto w-100"></li>
                        <li><img src="{{ asset('frontend/images/g2.jpg') }}" class="img-fluid mx-auto w-100"></li>
                        <li><img src="{{ asset('frontend/images/g3.jpg') }}" class="img-fluid mx-auto w-100"></li>
                    </ul>
                </div>
                <div class="col-lg-6 d-none">
                    <ul class="gallery">
                        <li><img src="{{ asset('frontend/images/g4.jpg') }}" class="img-fluid mx-auto w-100"></li>
                        <li><img src="{{ asset('frontend/images/g5.jpg') }}" class="img-fluid mx-auto w-100"></li>
                        <li class="first"><img src="{{ asset('frontend/images/g6.jpg') }}"
                                class="img-fluid mx-auto w-100"></li>
                    </ul>
                </div>-->
            </div>
            <div class="row">
                <div class="col-lg-12 text-center mt-5">
                    <a href="{{ route('student-galary') }}" class="btn btn-add">View All</a>
                </div>
            </div>
            @else
            <h4 class="text-center">No photos available</h4>
       @endif
        </div>
    </section>
    {{-- <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sub-heading text-center wow fadeInDown" data-wow-duration="2s">
                        <h2>Student Galary</h2>
                    </div>
                </div>
            </div>
            @if ($student_photos->count() > 0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-theme test-boxes">
                        @foreach ($student_photos as $photo)
                            <div class="item">
                                <div class="features-box">
                                    <div class="">
                                        <img src="
                                                {{ asset($photo->image) }}" class="img-fluid mx-auto">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center mt-5">
                    <a href="{{ route('student-galary') }}" class="btn btn-add">View All</a>
                </div>
            </div>
            @else
                <p class="text-warning">No photos available</p>
            @endif
        </div>
    </section> --}}

    <!-- partner end -->



    <section id="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sub-heading text-center wow fadeInDown" data-wow-duration="2s">
                        <h2>Testimonials</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme testi-boxes">
                        @if ($testimonials->count() > 0)
                        @foreach ($testimonials as $testimonial)
                        <div class="item">
                            <div class="media p-3 align-items-center img">
                                <!-- <div class="quote">
                                             <img src="images/quote.png" class="img-fluid">
                                        </div> -->
                                @php
                                    if ($testimonial->user->image) {
                                        $profile_image_path = $testimonial->user->image;
                                    } else {
                                        $profile_image_path = 'frontend/images/img-1.jpg';
                                    }

                                @endphp
                                <img src="{{ $profile_image_path }}" alt="John Doe"
                                    class="img-fluid">
                                <div class="media-body">
                                    {!! $testimonial->content !!}
                                    <h4>{{ $testimonial->user->first_name }} {{ $testimonial->user->last_name }}</h4>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <h4 class="text-center">No testimonial available</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="events">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sub-heading text-center wow fadeInDown" data-wow-duration="2s">
                        <h2>Our Events</h2>
                    </div>
                </div>
            </div>
            @if ($events->count() > 0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="row m-0">
                        @foreach ($events as $event)
                        <div class="col-12 col-lg-4 mb-3 pl-1 pr-1">
                            <div class="item">
                                <div class="features-box">
                                    <div class="">
                                        <img src="
                                            {{ $event->image }}" class="img-fluid mx-auto" style="width: 343px;height:236px">
                                    </div>
                                    <div class="features-text">
                                        <h6>{{ $event->title }}</h6>
                                        <span class="text-success">{{ date('M d, Y', strtotime($event->start_date)) }}
                                            @if ($event->end_date)
                                                - {{ date('M d, Y', strtotime($event->end_date)) }}
                                            @endif
                                        </span>
                                        <br>
                                        <span class="text-success">{{ date('h:i A', strtotime($event->start_time)) }}
                                            @if ($event->end_time)
                                                - {{ date('h:i A', strtotime($event->end_time)) }}
                                            @endif
                                        </span>
                                        {!! $event->desc !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{-- <div class="item">
                            <div class="features-box">
                                <div class="">
                                    <img src="
                                        {{ asset('frontend/images/event2.jpg') }}" class="img-fluid mx-auto">
                                </div>
                                <div class="features-text">
                                    <h6>Annual Sports</h6>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum.Ipsum is simply dummy text of the printing.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="features-box">
                                <div class="">
                                    <img src="
                                        {{ asset('frontend/images/event3.jpg') }}" class="img-fluid mx-auto">
                                </div>
                                <div class="features-text">
                                    <h6>Parents Meeting</h6>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum.Ipsum is simply dummy text of the printing.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="features-box">
                                <div class="">
                                    <img src="
                                        {{ asset('frontend/images/event2.jpg') }}" class="img-fluid mx-auto">
                                </div>
                                <div class="features-text">
                                    <h6>Parents Meeting</h6>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum.Ipsum is simply dummy text of the printing.</p>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center mt-5">
                    <a href="{{ route('available_events') }}" class="btn btn-add">View All</a>
                </div>
            </div>
            @else
                <h4 class="text-center">No events available</h4>
            @endif
        </div>
        <div class='ripple-background'>
            <div class='circle xxlarge shade1'></div>
            <div class='circle xlarge shade2'></div>
            <div class='circle large shade3'></div>
            <div class='circle mediun shade4'></div>
            <div class='circle small shade5'></div>
        </div>
    </section>

    <section id="vlog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sub-heading text-center wow fadeInDown" data-wow-duration="2s">
                        <h2>Recent Vlog</h2>
                    </div>
                </div>
            </div>
            <div class="row m-0">
                @if ($vlogs->count() > 1)
                    @foreach ($vlogs as $vlog)
                    <div class="col-12 col-lg-4 mb-3 mb-lg-0">
                        <div class="card border-0 shadow-sm">
                            <a href="{{ route('vlogDetails',$vlog->id) }}">
                                @php
                                        $file_path = $vlog->file_path;
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
                                {{-- <div class="bl_img">
                                    <img src="{{ asset('frontend/images/blog1.jpg') }}" class="img-fluid mx-auto">

                                </div> --}}
                                <div class="card-body">
                                    <div class="date-sec">
                                        <i class="far fa-calendar-alt"></i>{{ date('M',strtotime($vlog->created_at)) }} <span>{{ date('d',strtotime($vlog->created_at)) }}</span>, {{ date('Y',strtotime($vlog->created_at)) }}
                                        {{-- <h5><i class="far fa-user"></i>By Admin</h5> --}}
                                    </div>
                                    <h2>{{ \Illuminate\Support\Str::limit($vlog->title,50) }}</h2>
                                    {!! \Illuminate\Support\Str::limit($vlog->description,350) !!}
                                    <span class="text-right">Read More <i class="fas fa-arrow-right ml-1"></i></span>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
               
                
            </div>
            <div class="row">
                <div class="col-lg-12 text-center mt-5">
                    <a href="{{ route('vlog') }}" class="btn btn-add">View All</a>
                </div>
            </div>
            @else
            <h4 class="text-center"> No Vlog Available</h4>
       @endif
        </div>
    </section>
    <section id="vlog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sub-heading text-center wow fadeInDown" data-wow-duration="2s">
                        <h2>Recent Video</h2>
                    </div>
                </div>
            </div>
            <div class="row m-0">
                @if ($videos->count() > 0)
                    @foreach ($videos as $video)
                        <div class="col-12 col-lg-4 mb-3 mb-lg-0">
                            <div class="card border-0 shadow-sm">
                                <a href="{{ route('video_details',$video->id) }}">
                                    @php
                                            $file_path = $video->video;
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
                                    {{-- <div class="bl_img">
                                        <img src="{{ asset('frontend/images/blog1.jpg') }}" class="img-fluid mx-auto">

                                    </div> --}}
                                    <div class="card-body">
                                        <div class="date-sec">
                                            <i class="far fa-calendar-alt"></i>{{ date('M',strtotime($video->created_at)) }} <span>{{ date('d',strtotime($video->created_at)) }}</span>, {{ date('Y',strtotime($video->created_at)) }}
                                            {{-- <h5><i class="far fa-user"></i>By Admin</h5> --}}
                                        </div>
                                        <h2>{{ \Illuminate\Support\Str::limit($video->title,50) }}</h2>
                                        {!! \Illuminate\Support\Str::limit($video->description,350) !!}
                                        <span class="text-right">Read More <i class="fas fa-arrow-right ml-1"></i></span>
                                    </div>
                                    @if ($video->video_type == 0)
                                        <div class="price_tag free_bg">
                                            Free
                                        </div>
                                    @else
                                        <div class="price_tag paid_bg">
                                            Paid
                                        </div>
                                    @endif
                                    
                                </a>
                            </div>
                        </div>
                    @endforeach
               
            </div>
            <div class="row">
                <div class="col-lg-12 text-center mt-5">
                    <a href="{{ route('video') }}" class="btn btn-add">View All</a>
                </div>
            </div>
            @else
            <h4 class="text-center">No video available</h4>
       @endif
        </div>
    </section>

    <!--<section id="vlog" class="d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sub-heading text-center wow fadeInDown" data-wow-duration="2s">
                        <h2>Recent Vlog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="d-sm-flex align-items-center justify-content-center">
                        <div class="blog-box">
                            <div class="dates">08</div>
                            <h4>AUG</h4>
                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum</p>
                            <a href="#">CONTINUE<span><i class="fa fa-long-arrow-right"></i></span></a>
                        </div>
                        <div class="blog-img">
                            <img src="{{ asset('frontend/images/blog1.jpg') }}" class="img-fluid mx-auto">
                        </div>
                    </div>
                    <div class="d-sm-flex align-items-center justify-content-center">
                        <div class="blog-box">
                            <div class="dates">08</div>
                            <h4>AUG</h4>
                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum</p>
                            <a href="#">CONTINUE<span><i class="fa fa-long-arrow-right"></i></span></a>
                        </div>
                        <div class="blog-img">
                            <img src="{{ asset('frontend/images/blog4.jpg') }}" class="img-fluid mx-auto">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-sm-flex flex-row-reverse align-items-center justify-content-center">
                        <div class="blog-box">
                            <div class="dates">08</div>
                            <h4>AUG</h4>
                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum</p>
                            <a href="#">CONTINUE<span><i class="fa fa-long-arrow-right"></i></span></a>
                        </div>
                        <div class="blog-img">
                            <img src="{{ asset('frontend/images/blog3.jpg') }}" class="img-fluid mx-auto">
                        </div>
                    </div>
                    <div class="d-sm-flex flex-row-reverse align-items-center justify-content-center">
                        <div class="blog-box">
                            <div class="dates">08</div>
                            <h4>AUG</h4>
                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum</p>
                            <a href="#">CONTINUE<span><i class="fa fa-long-arrow-right"></i></span></a>
                        </div>
                        <div class="blog-img">
                            <img src="{{ asset('frontend/images/blog2.jpg') }}" class="img-fluid mx-auto">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center mt-5">
                    <a href="{{ route('vlog') }}" class="btn btn-add">View All</a>
                </div>
            </div>
        </div>
    </section>-->

    <!-- testimonial end -->

    <!-- newsletter part end -->
@endsection
