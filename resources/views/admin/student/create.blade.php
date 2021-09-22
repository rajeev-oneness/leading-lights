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
					<li><a href="{{ route('admin.students.index')}}">Student List</a></li>
					<li class="text-white"><i class="fa fa-chevron-right"></i></li>
					<li><a href="#" class="active">Add student</a></li>
				</ul>
			</div>
			<div class="col-lg-6">
				<div class="search-box-container">
					<!-- <div class="form-group search-box top-search-bar"> -->
					<!-- <input type="text" name="search-box"  placeholder="Search" -->
					<!-- > -->
					<!-- <button type="submit"> -->
					<!-- <i class="fa fa-search"></i> -->
					<!-- </button> -->
					<!-- </div> -->
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
			<h5>Add student</h5>
			<hr>
			<form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<h5 class="text-blue">Basic Information</h5>
				<div class="row m-0 pt-3">
					<div class="col-lg-6">
						<div class="form-group edit-box">
							<label for="first_name">First Name<span class="text-danger">*</span></label>
							<input type="text" name="first_name" class="form-control" id="first_name" value="{{ old('first_name') }}">
							@if ($errors->has('first_name'))
							<span style="color: red;">{{ $errors->first('first_name') }}</span>
							@endif
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group edit-box">
							<label for="last_name">Last Name<span class="text-danger">*</span></label>
							<input type="text" name="last_name" class="form-control" id="last_name" value="{{ old('last_name') }}">
							@if ($errors->has('last_name'))
							<span style="color: red;">{{ $errors->first('last_name') }}</span>
							@endif
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group edit-box">
							<label for="email">Email Address<span class="text-danger">*</span></label>
							<input type="text" id="email" class="form-control" name="email" value="{{ old('email') }}" >
							@if ($errors->has('email'))
							<span style="color: red;">{{ $errors->first('email') }}</span>
							@endif
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group edit-box">
							<label for="class">Class<span class="text-danger">*</span></label>
							<select name="class" id="class" class="form-control">
								<option value="">Please select class</option>
								@foreach ($classes as $class)
									<option value="{{ $class->name }}">{{ $class->name }}</option>
								@endforeach
							</select>
							@if ($errors->has('class'))
							<span style="color: red;">{{ $errors->first('class') }}</span>
							@endif
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group edit-box">
							<label for="password">Password<span class="text-danger">*</span></label>
							<input type="password" class="form-control" id="password" name="password">
							@if ($errors->has('password'))
							<span style="color: red;">{{ $errors->first('password') }}</span>
							@endif
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group edit-box">
							<label for="password_confirm">Confirm password<span class="text-danger">*</span></label>
							<input type="password" class="form-control" id="password_confirm"
							name="password_confirmation">
							@if ($errors->has('password_confirmation'))
							<span style="color: red;">{{ $errors->first('password_confirmation') }}</span>
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
@endsection