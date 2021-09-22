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
							<li><a href="{{ route('admin.classes.index')}}">All Classes List</a></li>
							<li class="text-white"><i class="fa fa-chevron-right"></i></li>
							<li><a href="#" class="active">View  class</a></li>
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
						<h5>View Class</h5>
						<hr>
						<div class="row m-0 details-page">
							<div class="col-12 pt-3 pb-3 pl-0 pr-0">
								<h5 class="text-blue">Basic details</h5>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Class Name</label>
									<input type="text" id="title" value="{{ $class_details->title }}" readonly>    
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="teacher_id">Assigned teacher</label>
									<input type="text" id="teacher_id" value="{{ $teacher->first_name }} {{ $teacher->last_name }}" readonly>    
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="date">Date</label>
									<input type="text" id="date" value="{{ $class_details->date }}" readonly>    
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="time">Time</label>
									<input type="text" id="time" value="{{ $class_details->time }}" readonly>    
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="class">Class</label>
									<input type="text" id="class" value="{{ $class_details->class }}" readonly>    
								</div>
							</div>
							
						</div>
						<div class="row m-0 details-page">
							<div class="col-12 pt-3 pb-3 pl-0 pr-0">
								<h5 class="text-blue">Others</h5>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="image">Cover image</label>
									<img src="{{ asset($class_details->image) }}" alt="" height="200" width="200">
								</div>
							</div>
						</div>
				</div>
				</div>
			</div>
@endsection