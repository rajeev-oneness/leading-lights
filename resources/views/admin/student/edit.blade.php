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
							<li><a href="{{ route('admin.students.edit',$student->id) }}" class="active">Edit student</a></li>
						</ul>
					</div>
					@include('admin.layouts.navbar')
				</div>
				<hr>
				<div class="dashboard-body-content">
						<h5>Edit student</h5>
						<hr>
						<form action="{{ route('admin.students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<h5 class="text-blue">Basic Information</h5>
							<div class="row m-0 pt-3">
								<div class="col-lg-6">
									<div class="form-group edit-box">
										<label for="first_name">First Name</label>
										<input type="text" name="first_name" class="form-control" id="first_name" value="{{ $student->first_name }}">
										@if ($errors->has('first_name'))
											<span style="color: red;">{{ $errors->first('first_name') }}</span>
										@endif
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group edit-box">
										<label for="last_name">Last Name</label>
										<input type="text" name="last_name" class="form-control" id="last_name" value="{{ $student->last_name }}">
										@if ($errors->has('last_name'))
											<span style="color: red;">{{ $errors->first('last_name') }}</span>
										@endif
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group edit-box">
									<label for="email">Email Address</label>
									<input type="text" id="email" class="form-control" name="email" value="{{ $student->email }}" readonly>
									@if ($errors->has('email'))
											<span style="color: red;">{{ $errors->first('email') }}</span>
									@endif
								</div>
								</div>
								<div class="col-lg-6 form-group edit-box">
									<label for="mobile">Mobile No</label>
									<input type="number" id="mobile" class="form-control" value="{{ $student->mobile }}" name="mobile">
									@if ($errors->has('mobile'))
										<span style="color: red;">{{ $errors->first('mobile') }}</span>
									@endif
								</div>
							</div>
							<div class="row m-0">
								<div class="col-lg-6 form-group edit-box">
									<label for="image">Date Of Birth</label>
									<input type="date" class="form-control" id="exampleInputEmail1" placeholder="Enter date of birth" name="dob"
									value="{{ $student->dob }}">
									@if ($errors->has('dob'))
									   <span style="color: red;">{{ $errors->first('dob') }}</span>
									@endif
								  </div>
								{{-- <div class="col-lg-6">
									<div class="form-group edit-box">
										<label for="father_name">Father's Name</label>
										<input type="text" value="{{ $student->fathers_name }}" class="form-control" name="fathers_name">
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
										  <option value="Male" @if($student->gender == 'male') selected @endif>Male</option>
										  <option value="Female" @if($student->gender == 'female') selected @endif>Female</option>
										  <option value="others" @if($student->gender == 'others') selected @endif>Others</option>
										</select>
										@if ($errors->has('gender'))
											<span style="color: red;">{{ $errors->first('gender') }}</span>
										@endif
									  </div>
								</div>
								<div class="col-lg-6">
									<div class="form-group edit-box">
										<label for="class">Class</label>
										<select name="class" id="class" class="form-control">
											<option value="">Please select class</option>
											@foreach ($classes as $class)
												<option value="{{ $class->id }}" @if ($student->class === $class->id)
													selected
												@endif>{{ $class->name }}</option>
											@endforeach
										</select>
										@if ($errors->has('class'))
										<span style="color: red;">{{ $errors->first('class') }}</span>
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
										<option value="1" @if($student->status == 1) selected @endif>Active</option>
										<option value="0" @if($student->status == 0) selected @endif>Inactive</option>
									</select>
								</div>
							</div> --}}
							<h5 class="text-blue">Address</h5>
							<div class="row m-0 pt-3">
								<div class="col-lg-6">
									<div class="form-group edit-box">
										<label for="address">Address</label>
										<input type="text" class="form-control" id="address" value="{{ $student->address }}">
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