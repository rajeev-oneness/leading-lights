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
							<li><a href="{{ route('admin.holidays.index')}}">All Holidays List</a></li>
							<li class="text-white"><i class="fa fa-chevron-right"></i></li>
							<li><a href="#" class="active">Add holidays</a></li>
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
						<h5>Add Holiday</h5>
						<hr>
						<form action="{{ route('admin.holidays.store') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="row m-0 pt-3">
								<div class="col-lg-6">
									<div class="form-group edit-box">
										<label for="name">Holiday Name</label>
										<input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
										@if ($errors->has('name'))
											<span style="color: red;">{{ $errors->first('name') }}</span>
										@endif
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group edit-box">
									<label for="date">Date</label>
									<input type="date" id="date" class="form-control" name="date" value="{{ old('date') }}">
									@if ($errors->has('date'))
										<span style="color: red;">{{ $errors->first('date') }}</span>
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