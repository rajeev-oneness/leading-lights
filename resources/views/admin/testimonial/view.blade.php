@extends('admin.layouts.master')
@section('content')
    <div class="dashboard-body" id="content">
        <div class="dashboard-content">
            <div class="row m-0 dashboard-content-header">
                <div class="col-lg-6 d-flex">
                    <a id="sidebarCollapse" href="javascript:void(0);">
                        <i class="fas fa-bars"></i>
                    </a>
                    <ul class="breadcrumb p-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="{{ route('admin.testimonial.index') }}">All Testimonial</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">View testimonial</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5>View Testimonial</h5>
                <hr>
                    <div class="row">
                        <div class="col-md-4">
                            @php
                                if ($testimonial->user->image) {
                                    $profile_image_path = $testimonial->user->image;
                                } else {
                                    $profile_image_path = 'frontend/images/img-1.jpg';
                                }

                            @endphp
                            <img src="{{ asset($profile_image_path) }}" alt="John Doe"
                                class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            {!! $testimonial->content !!}
                            <h4 class="mt-5">Name: {{ $testimonial->user->first_name }} {{ $testimonial->user->last_name }}</h4>
                            <h5>Id: {{ $testimonial->user->id_no }}</h5>
                            <h6>Address: {{ $testimonial->user->address ? $testimonial->user->address : 'N/A' }}</h6>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
