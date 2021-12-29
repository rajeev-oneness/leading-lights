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
                                <li><a href="{{ route('admin.vlog.index') }}" class="active">All VLOG List</a></li>
                                <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                                <li><a href="#" class="active">View VLOG</a></li>
                            </ul>
                        </div>
                        @include('admin.layouts.navbar')
                        </div>
				<hr>
				<div class="dashboard-body-content">
						<h5>View Vlog</h5>
						<hr>
						<form>
							<div class="row m-0 details-page">
                                <div class="col-12 pt-3 pb-3 pl-0 pr-0">
                                    <h5 class="text-blue">Basic details</h5>
                                </div>
								<div class="col-lg-12">
									<div class="form-group edit-box">
										<label for="name">Title</label>
										<input type="text" name="name" class="form-control" id="name" value="{{ $vlog_details->title }}" readonly>
									</div>
								</div>
                                <div class="col-lg-12">
									<div class="form-group edit-box">
										<label for="description">Description</label>
										{!! $vlog_details->description !!}
									</div>
								</div>

								<div class="col-lg-12">
									<div class="form-group edit-box">
										<label for="facebook_link">Facebook Link</label>
                                        <input type="text" name="facebook_link" class="form-control" id="facebook_link" value="{{ $vlog_details->facebook_link }}" readonly>
								    </div>
								</div>
							</div>
                            <div class="row m-0 details-page">
                                <div class="col-12 pt-3 pb-3 pl-0 pr-0">
                                    <h5 class="text-blue">Others</h5>
                                </div>
                                <div class="col-lg-6">
									<div class="form-group edit-box">
									<label for="image">Image</label>
                                    @php
                                        $file_path = $vlog_details->file_path;
                                        $file_extension= explode('.',$file_path)[1];
                                    @endphp
									@if ($file_extension === 'jpg' || $file_extension === 'jpeg' || $file_extension === 'png')
										<img src="{{ asset($file_path) }}" alt="" height="200" width="250">
                                    @else
                                        <video width="320" height="240" controls>
                                            <source src="{{ asset($file_path) }}" type="video/{{ $file_extension }}">
                                        Your browser does not support the video tag.
                                        </video>
									@endif
								</div>
								</div>
                            </div>
						</form>
				</div>
				</div>
			</div>
<script>
	CKEDITOR.replace( 'page_content' );
</script>
@endsection
