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
							<li><a href="{{ route('admin.special-courses.index')}}">All Courses List</a></li>
							<li class="text-white"><i class="fa fa-chevron-right"></i></li>
							<li><a href="#" class="active">Edit Course</a></li>
						</ul>
					</div>
					@include('admin.layouts.navbar')
				</div>
				<hr>
				<div class="dashboard-body-content">
						<h5>Edit Course</h5>
						<hr>
						<form action="{{ route('admin.special-courses.update',$course_details->id) }}" method="POST" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div class="row m-0 pt-3">
								<div class="col-lg-6">
									<div class="form-group edit-box">
										{{-- <label for="title">Course title</label> --}}
										<label for="review">Course title<span class="text-danger">*</span></label>
										<input type="text" name="title" class="form-control" id="title" value="{{ $course_details->title }}">
										@if ($errors->has('title'))
											<span style="color: red;">{{ $errors->first('title') }}</span>
										@endif
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group edit-box">
										{{-- <label for="class_id">Class</label> --}}
										<label for="review">Class<span class="text-danger">*</span></label>
										<select class="form-control" name="class_id" id="class_id">
											<option value="">Select Class</option>
											@foreach ($classes as $class)
												<option value="{{ $class->id }}" @if ($class->id === $course_details->class_id)
													selected
												@endif>{{ $class->name }}</option>
											@endforeach
										</select>
										@if ($errors->has('class_id'))
											<span style="color: red;">{{ $errors->first('class_id') }}</span>
										@endif
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group edit-box">
									{{-- <label for="start_date">Start Date</label> --}}
									<label for="review">Start Date<span class="text-danger">*</span></label>
									<input type="date" id="start_date" class="form-control" name="start_date" value="{{ $course_details->start_date }}">
									@if ($errors->has('start_date'))
										<span style="color: red;">{{ $errors->first('start_date') }}</span>
									@endif
								</div>
								</div>
								
								<div class="col-lg-6">
									<div class="form-group edit-box">
									{{-- <label for="end_date">End Date</label> --}}
									<label for="review">End Date<span class="text-danger">*</span></label>
									<input type="date" id="end_date" class="form-control" name="end_date" value="{{ $course_details->end_date }}" >
									@if ($errors->has('end_date'))
										<span style="color: red;">{{ $errors->first('end_date') }}</span>
									@endif
								</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group edit-box">
									{{-- <label for="fees">Fees(&#x20B9;)</label> --}}
									<label for="review">Fees(&#x20B9;)<span class="text-danger">*</span></label>
									<input type="number" id="fees" class="form-control" name="fees" value="{{ $course_details->monthly_fees }}">
									@if ($errors->has('fees'))
										<span style="color: red;">{{ $errors->first('fees') }}</span>
									@endif
								</div>
								</div>
							</div>
							<div class="form-group d-flex justify-content-end">
								<button type="submit" class="actionbutton">UPDATE</button>
							</div>
						</form>
				</div>
				</div>
			</div>
@endsection