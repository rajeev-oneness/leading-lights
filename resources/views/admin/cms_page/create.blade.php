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
							<li><a href="{{ route('admin.cms.index')}}">All Page List</a></li>
							<li class="text-white"><i class="fa fa-chevron-right"></i></li>
							<li><a href="#" class="active">Add teacher</a></li>
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
						<h5>Add Page</h5>
						<hr>
						<form action="{{ route('admin.cms.store') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="row m-0 pt-3">
								<div class="col-lg-12">
									<div class="form-group edit-box">
										<label for="page_title">Page title<span class="text-danger">*</span></label>
										<input type="text" name="page_title" class="form-control" id="page_title" value="{{ old('page_title') }}">
										@if ($errors->has('page_title'))
											<span style="color: red;">{{ $errors->first('page_title') }}</span>
										@endif
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group edit-box">
										<label for="page_content">Page content<span class="text-danger">*</span></label>
										<textarea name="page_content">{{ old('page_content') }}</textarea>
										@if ($errors->has('page_content'))
											<span style="color: red;">{{ $errors->first('page_content') }}</span>
										@endif
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group edit-box">
									<label for="image">Image</label>
									<input type="file" id="image" class="form-control" name="image" value="{{ old('image') }}" >
									@if ($errors->has('image'))
										<span style="color: red;">{{ $errors->first('image') }}</span>
									@endif
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
	CKEDITOR.replace( 'page_content' );
</script>
@endsection