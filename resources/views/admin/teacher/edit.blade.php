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
							<li><a href="{{ route('admin.teachers.index')}}">Teacher List</a></li>
							<li class="text-white"><i class="fa fa-chevron-right"></i></li>
							<li><a href="{{ route('admin.teachers.edit',$teacher->id) }}" class="active">Edit teacher</a></li>
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
						<h5>Edit Teacher</h5>
						<hr>
						<form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<h5 class="text-blue">Basic Information</h5>
							<div class="row m-0 pt-3">
								<div class="col-lg-6">
									<div class="form-group edit-box">
										<label for="first_name">First Name</label>
										<input type="text" name="first_name" class="form-control" id="first_name" value="{{ $teacher->first_name }}">
										@if ($errors->has('first_name'))
											<span style="color: red;">{{ $errors->first('first_name') }}</span>
										@endif
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group edit-box">
										<label for="last_name">Last Name</label>
										<input type="text" name="last_name" class="form-control" id="last_name" value="{{ $teacher->last_name }}">
										@if ($errors->has('last_name'))
											<span style="color: red;">{{ $errors->first('last_name') }}</span>
										@endif
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group edit-box">
									<label for="email">Email Address</label>
									<input type="text" id="email" class="form-control" name="email" value="{{ $teacher->email }}" readonly>
									@if ($errors->has('email'))
											<span style="color: red;">{{ $errors->first('email') }}</span>
									@endif
								</div>
								</div>
								<div class="col-lg-6 form-group edit-box">
									<label for="mobile">Mobile No</label>
									<input type="number" id="mobile" class="form-control" value="{{ $teacher->mobile }}" name="mobile">
									@if ($errors->has('mobile'))
										<span style="color: red;">{{ $errors->first('mobile') }}</span>
									@endif
								</div>
							</div>
							<div class="row m-0">
								<div class="col-lg-6 form-group edit-box">
									<label for="exampleInputEmail1">Date Of Birth</label>
									<input type="date" class="form-control" id="exampleInputEmail1" placeholder="Enter date of birth" name="dob"
									value="{{ $teacher->dob }}">
									@if ($errors->has('dob'))
									   <span style="color: red;">{{ $errors->first('dob') }}</span>
									@endif
								  </div>
								<div class="col-lg-6">
									<div class="form-group edit-box">
										<label for="father_name">Father's Name</label>
										<input type="text" value="{{ $teacher->fathers_name }}" class="form-control" name="fathers_name">
										@if ($errors->has('dob'))
									   		<span style="color: red;">{{ $errors->first('fathers_name') }}</span>
										@endif
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group edit-box">
										<label for="gender">Gender</label>
										<select class="custom-select" id="gender" name="gender">
										  <option disabled value="">Choose...</option>
										  <option value="Male" @if($teacher->gender == 'male') selected @endif>Male</option>
										  <option value="Female" @if($teacher->gender == 'female') selected @endif>Female</option>
										  <option value="others" @if($teacher->gender == 'others') selected @endif>Others</option>
										</select>
										@if ($errors->has('gender'))
											<span style="color: red;">{{ $errors->first('gender') }}</span>
										@endif
									  </div>
								</div>
					
							</div>
							<h5 class="text-blue">Status</h5>
							<div class="row m-0 pt-3">
								<div class="form-group edit-box col-lg-6">
									<label for="name">Status</label>
									<select class="form-control" name="status">
										<option value="1" @if($teacher->status == 1) selected @endif>Active</option>
										<option value="0" @if($teacher->status == 0) selected @endif>Inactive</option>
									</select>
								</div>
							</div>
							<h5 class="text-blue">Address</h5>
							<div class="row m-0 pt-3">
								<div class="col-lg-4">
									<div class="form-group edit-box">
										<label for="address">Address</label>
										<input type="text" class="form-control" id="address" value="{{ $teacher->address }}">
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