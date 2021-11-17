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
							<li><a href="{{ route('admin.hr.index')}}">HR List</a></li>
							<li class="text-white"><i class="fa fa-chevron-right"></i></li>
							<li><a href="#" class="active">Edit HR details</a></li>
						</ul>
					</div>
					@include('admin.layouts.navbar')
				</div>
				<hr>
				<div class="dashboard-body-content">
						<h5>Edit HR Details</h5>
						<hr>
						<form action="{{ route('admin.hr.update', $hr_details['id']) }}" method="POST" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<h5 class="text-blue">Basic Information</h5>
							<div class="row m-0 pt-3">
								<div class="col-lg-6">
									<div class="form-group edit-box">
										<label for="first_name">First Name</label>
										<input type="text" name="first_name" class="form-control" id="first_name" value="{{ $hr_details->first_name }}">
										@if ($errors->has('first_name'))
											<span style="color: red;">{{ $errors->first('first_name') }}</span>
										@endif
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group edit-box">
										<label for="last_name">Last Name</label>
										<input type="text" name="last_name" class="form-control" id="last_name" value="{{ $hr_details->last_name }}">
										@if ($errors->has('last_name'))
											<span style="color: red;">{{ $errors->first('last_name') }}</span>
										@endif
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group edit-box">
									<label for="email">Email Address</label>
									<input type="text" id="email" class="form-control" name="email" value="{{ $hr_details->email }}" readonly>
									@if ($errors->has('email'))
											<span style="color: red;">{{ $errors->first('email') }}</span>
									@endif
								</div>
								</div>
								<div class="col-lg-6 form-group edit-box">
									<label for="mobile">Mobile No</label>
									<input type="number" id="mobile" class="form-control" value="{{ $hr_details->mobile }}" name="mobile">
									@if ($errors->has('mobile'))
										<span style="color: red;">{{ $errors->first('mobile') }}</span>
									@endif
								</div>
							</div>
							<div class="row m-0">
								<div class="col-lg-6 form-group edit-box">
									<label for="exampleInputEmail1">Date Of Joining</label>
									<input type="date" class="form-control" id="exampleInputEmail1" placeholder="Enter date of birth" name="doj"
									value="{{ $hr_details->doj }}">
									@if ($errors->has('doj'))
									   <span style="color: red;">{{ $errors->first('doj') }}</span>
									@endif
								  </div>
								{{-- <div class="col-lg-6">
									<div class="form-group edit-box">
										<label for="father_name">Father's Name</label>
										<input type="text" value="{{ $hr_details->fathers_name }}" class="form-control" name="fathers_name">
										@if ($errors->has('dob'))
									   		<span style="color: red;">{{ $errors->first('fathers_name') }}</span>
										@endif
									</div>
								</div> --}}
								<div class="col-lg-6">
									<div class="form-group edit-box">
										<label for="gender">Gender</label>
										<select class="custom-select" id="gender" name="gender">
										  <option disabled value="">Choose...</option>
										  <option value="Male" @if($hr_details->gender == 'male') selected @endif>Male</option>
										  <option value="Female" @if($hr_details->gender == 'female') selected @endif>Female</option>
										  <option value="others" @if($hr_details->gender == 'others') selected @endif>Others</option>
										</select>
										@if ($errors->has('gender'))
											<span style="color: red;">{{ $errors->first('gender') }}</span>
										@endif
									  </div>
								</div>
								<div class="col-lg-6 form-group edit-box">
									<label for="exampleInputEmail1">Upload picture</label>
									<input type="file" class="form-control" id="image" name="image">
									@if ($errors->has('image'))
									   <span style="color: red;">{{ $errors->first('image') }}</span>
									@endif
								</div>
					
							</div>
							{{-- <h5 class="text-blue">Status</h5>
							<div class="row m-0 pt-3">
								<div class="form-group edit-box col-lg-6">
									<label for="name">Status</label>
									<select class="form-control" name="status">
										<option value="1" @if($hr_details->status == 1) selected @endif>Active</option>
										<option value="0" @if($hr_details->status == 0) selected @endif>Inactive</option>
									</select>
								</div>
							</div> --}}
							<h5 class="text-blue">Address</h5>
							<div class="row m-0 pt-3">
								<div class="col-lg-4">
									<div class="form-group edit-box">
										<label for="address">Address</label>
										<input type="text" class="form-control" id="address" value="{{ $hr_details->address }}">
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