@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">


    {{-- <section id="services" class="all_corce_list d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sub-heading text-center wow fadeInDown" data-wow-duration="2s">
                        <h2>Vlog Details Page</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row m-0">
                        @foreach ($photos as $photo)
                            <div class="col-12 col-lg-4 mb-3 pl-1 pr-1">
                                <a href="#">
                                    <div class="item card border-0 cou_list">
                                        <div class="features-box">
                                            <div class="">
                                                <img src="
                                                        {{ asset($photo->image) }}" class="img-fluid mx-auto">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="all_corce_list blog_det">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sub-heading text-center wow fadeInDown" data-wow-duration="2s">
                        <h2>Vlog Details</h2>
                    </div>
                </div>
            </div>
            <div class="row m-0 justify-content-center">
                <div class="col-12 col-lg-8">
                    <h1>{{ $vlog_details->title }}</h1>
                    @php
                        $file_path = $vlog_details->file_path;
                        $file_extension= explode('.',$file_path)[1];
                    @endphp
                    @if ($file_extension === 'jpg' || $file_extension === 'jpeg' || $file_extension === 'png')
                    <div class="blog_detimg">
                        <img src="{{ asset($file_path) }}" alt="" class="img-fluid mx-auto">
                    </div>
                    @else
                    <div class="blog_detimg">
                        <video class="img-fluid mx-auto" controls>
                            <source src="{{ asset($file_path) }}" type="video/{{ $file_extension }}">
                        Your browser does not support the video tag.
                        </video>
                    </div>
                    @endif
                    {{-- <div class="blog_detimg">
                        <img src="{{ asset($photo->image) }}" class="img-fluid mx-auto">
                    </div> --}}
                    <h6 class="pt-3 pb-3">
						<span>BY ADMIN </span> |  <span>{{ date('d M Y',strtotime($vlog_details->created_at)) }}</span>
					</h6>
					{!! $vlog_details->description !!}
					<ul class="social_link">
						{{-- <li><a href=""><i class="fas fa-share-alt"></i> &nbsp; | &nbsp; Share</a></li> --}}
						<li><a href="{{ $vlog_details->facebook_link }}" target=”_blank” ><i class="fab fa-facebook-f"></i></a></li>
						{{-- <li><a href=""><i class="fab fa-twitter"></i></a></li>
						<li><a href=""><i class="fab fa-pinterest-p"></i></a></li> --}}
					</ul>
                </div>
            </div>
        </div>
    </section>
@endsection
