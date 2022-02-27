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

                                        {{-- <img src="{{ asset('frontend/images/banner1.png') }}" class="img-fluid"> --}}

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
                                                            {{ asset('frontend/images/light.png') }}"
                                                class="img-fluid">
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
                        <h2>Student Galary</h2>
                    </div>
                </div>
            </div>
            @if ($student_photos->count() > 0)
                <div class="row student_gallery">
                    @foreach ($student_photos as $photo)
                        <div class="col-12 col-lg-3 p-1">
                            <div class="card item">
                                <a href="{{ asset($photo->image) }}" data-lightbox="photos">
                                    <img src="{{ asset($photo->image) }}" class="card-img-top img-fluid">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row justify-content-end mt-2">
                    {{ $student_photos->links() }}
                </div>
            @else
                <h5 class="text-center">No photos available</h5>
            @endif
        </div>
        </div>
    </section>
@endsection
