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
							<li><a href="{{ route('admin.dashboard')}}">Home</a></li>
							<li class="text-white"><i class="fa fa-chevron-right"></i></li>
							<li><a href="{{ route('admin.video.index')}}">All Video List</a></li>
							<li class="text-white"><i class="fa fa-chevron-right"></i></li>
							<li><a href="#" class="active">Add Video</a></li>
						</ul>
					</div>
					<div class="col-lg-6">
						<div class="search-box-container">
							<div class="notification">
								<button class="notification-button">
									<i class="fa fa-bell"></i>
									<span class="badge-number">0</span>
								</button>
								<div class="user-wrapper mx-3">
									<!-- <img src="./assets/img/user.png" class="img-fluid user-img"> -->
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="dashboard-body-content">
						<h5>Add Video</h5>
						<hr>
						<form action="{{ route('admin.video.store') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="row m-0 pt-3">
								<div class="col-lg-12">
									<div class="form-group edit-box">
										<label for="title">Title<span class="text-danger">*</span></label>
										<input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
										@if ($errors->has('title'))
											<span style="color: red;">{{ $errors->first('title') }}</span>
										@endif
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group edit-box">
										<label for="video">Video<span class="text-danger">*</span></label>
										<input type="file" name="video" class="form-control" id="video" value="{{ old('video') }}">
										@if ($errors->has('video'))
											<span style="color: red;">{{ $errors->first('video') }}</span>
										@endif
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group edit-box">
										<label for="name">video type</label>
										<select class="form-control" name="video_type">
											<option value="1">Paid</option>
											<option value="0">Free</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group d-flex justify-content-end">
								<button type="submit" class="actionbutton">SAVE</button>
							</div>
						</form>
				</div>
				</div>
			</div>
<script>
	CKEDITOR.replace( 'video_content' );
</script>
@endsection