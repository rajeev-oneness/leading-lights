@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

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
                    <h5><b>This course includes</b></h5>
                    <div class="includ_text">
                        {{-- <ul>
                            <li><i class="far fa-arrow-alt-circle-right mr-2"></i>Pencil Sketch</li>
                            <li><i class="far fa-arrow-alt-circle-right mr-2"></i>Color Pencil Sketch</li>
                            <li><i class="far fa-arrow-alt-circle-right mr-2"></i>Use of water Color</li>
                            <li><i class="far fa-arrow-alt-circle-right mr-2"></i>Concepts of light and shadow</li>
                            <li><i class="far fa-arrow-alt-circle-right mr-2"></i>Concept of Perspective</li>
                        </ul> --}}
                        {!! $course_details->course_content !!}
                    </div>

                </div>
                <div class="col-12 col-lg-4 rightpart_course">
                    <div class="card shadow-sm">
                        <h5>Course Features</h5>
                        <div class="fea_list">
                            <p>
                                {!! $course_details->course_content !!}
                                <!--{{ $course_details->description }}-->
                            </p>
                            <p><span><i class="fa fa-clipboard"></i> No of sessions :</span>  {{ $course_details->sessions }}</p>
                            <p><span><i class="fas fa-calendar-alt"></i> Start Date :</span>{{ date('d-F-y',strtotime($course_details->start_date)) }}</p>
                        </div>
                        <div class="col-12 text-center mt-3 price_bg">
                                <h3>Price: <span>&#8377;{{ $course_details->fees }}</span></h3>
                                <a class="btn btn-add btn-radius" href="{{ route('student_flash_course_register',$course_details->id) }}">ENROLL COURSE</a>
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
