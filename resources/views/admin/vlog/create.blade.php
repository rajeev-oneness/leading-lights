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
							<li><a href="{{ route('admin.vlog.index')}}">All Vlog List</a></li>
							<li class="text-white"><i class="fa fa-chevron-right"></i></li>
							<li><a href="#" class="active">Add Vlog</a></li>
						</ul>
					</div>
					@include('admin.layouts.navbar')
				</div>
				<hr>
				<div class="dashboard-body-content">
						<h5>Add Vlog</h5>
						<hr>
						<form action="{{ route('admin.vlog.store') }}" method="POST" enctype="multipart/form-data">
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
								<div class="col-lg-12">
									<div class="form-group edit-box">
									<label for="description">Description<span class="text-danger">*</span></label>
									<textarea name="description">{{ old('description') }}</textarea>
									@if ($errors->has('description'))
										<span style="color: red;">{{ $errors->first('description') }}</span>
									@endif
								</div>
								</div>
                                <div class="col-lg-12">
									<div class="form-group edit-box">
									<label for="content">Upload image/video<span class="text-danger">*</span></label>
									<input type="file" name="image" class="form-control" id="image" value="{{ old('image') }}">
									@if ($errors->has('image'))
										<span style="color: red;">{{ $errors->first('image') }}</span>
									@endif
								</div>
								</div>
                                <div class="col-lg-12">
									<div class="form-group edit-box">
									<label for="content">Facebook Link<span class="text-danger">*</span></label>
									<input type="text" name="facebook_link" class="form-control" id="facebook_link" value="{{ old('facebook_link') }}">
									@if ($errors->has('facebook_link'))
										<span style="color: red;">{{ $errors->first('facebook_link') }}</span>
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
	CKEDITOR.replace( 'description' );
</script>
@endsection
