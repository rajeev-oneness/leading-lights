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
                                <li><a href="{{ route('admin.vlog.index') }}">All VLOG List</a></li>
                                <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                                <li><a href="#" class="active">View VLOG</a></li>
                            </ul>
                        </div>
                        @include('admin.layouts.navbar')
                        </div>
				<hr>
                <section class="all_corce_list blog_det">
                    <div class="container">
                        <div class="row m-0 justify-content-center">
                            <div class="col-12 col-lg-8 mt-5">
                                <h2 class="font-weight-bold">{{ $vlog_details->title }}</h2>
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
                                <h6 class="pt-3 pb-3 font-weight-bold">
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
				</div>
			</div>
<script>
	CKEDITOR.replace( 'page_content' );
</script>
@endsection
