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
					<li><a href="{{ route('admin.dashboard') }}">Home</a></li>
					<li class="text-white"><i class="fa fa-chevron-right"></i></li>
					<li><a href="{{ route('admin.teachers.index')}}">Teacher List</a></li>
					<li class="text-white"><i class="fa fa-chevron-right"></i></li>
					<li><a href="{{ route('admin.teachers.show',$teacher->id) }}" class="active">Teacher Details</a></li>

				</ul>
			</div>
			@include('admin.layouts.navbar')
		</div>
		<hr>
		<div class="dashboard-body-content">
			<div class="d-flex justify-content-between align-items-center">
				<h5>Teacher Details</h5>
			</div>
			<div class="d-flex justify-content-end align-items-center">
				@if ($teacher->status == 0)
					<a href="{{ route('admin.students.approve',$teacher->id) }}" class="btn btn-xs btn-info pull-right" onclick="activeAccount({{ $teacher->id }})" id="activeAccount">Inactive</a>
				@else
					<a href="{{ route('admin.students.approve',$teacher->id) }}" class="btn btn-xs btn-info pull-right" onclick="activeAccount({{ $teacher->id }})" id="activeAccount">Active</a>
				@endif
				
			</div>
			<hr>
			<h5 class="text-blue">Basic Information</h5>
			<div class="row m-0 details-page">
				<div class="col-lg-4">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" id="name" value="{{ $teacher->first_name }}  {{ $teacher->last_name }}" readonly>    
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" id="name" value="{{ $teacher->email }}" readonly>    
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label for="mobile">Mobile</label>
						<input type="text" id="mobile" value="{{ $teacher->mobile ? $teacher->mobile : 'N/A'}}" readonly>    
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label for="gender">Gender</label>
						<input type="text" id="gender" value="{{ $teacher->gender ? $teacher->gender : 'N/A' }}" readonly>    
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label for="dob">Date Of Birth</label>
						<input type="text" id="dob" value="{{ $teacher->dob ? $teacher->dob  : 'NA'}}" readonly>    
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label for="fname">Father's name</label>
						<input type="text" id="fname" value="{{ $teacher->fathers_name ?  $teacher->fathers_name  : 'NA'}}" readonly>    
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label for="joining_date">Joining Date</label>
						<input type="text" id="joining_date" value="{{ date('Y-m-d',strtotime($teacher->created_at)) }}" readonly>    
					</div>
				</div>
			</div>
			<div class="row m-0 details-page">
				<div class="col-12 pt-3 pb-3 pl-0 pr-0">
					<h5 class="text-blue">Address</h5>
				</div>
				<div class="col-lg">
					<div class="form-group">
						<label for="address">Address</label>
						<input type="text" id="address" value="{{ $teacher->address ? $teacher->address : 'NA' }}" readonly>    
					</div>
				</div>
				{{-- <div class="col-lg-3">
					<div class="form-group">
						<label for="landmark">City</label>
						<input type="text" id="landmark" value="Kolkata" readonly>    
					</div>
				</div>
				<div class="col-lg-2">
					<div class="form-group">
						<label for="pin">Pin Code</label>
						<input type="number" id="pin" value="7537281" readonly>    
					</div>
				</div>
				<div class="col-lg-2">
					<div class="form-group">
						<label for="country">Country</label>
						<input type="text" id="country" value="India" readonly>    
					</div>
				</div>
				<div class="col-lg-2">
					<div class="form-group">
						<label for="state">State</label>
						<input type="text" id="state" value="West Bengal" readonly>    
					</div>
				</div> --}}
			</div>
		</div>
	</div>
    </div>
    </div>
	<script>
		function activeAccount(student_id,status){
			event.preventDefault();
			let url = $("#activeAccount").attr('href');
        	let data = {
				student_id : student_id,
				status : status
			};
			$.ajax({
				url: url,
				type: "PUT",
				data: data,
				dataType: 'json',
				success: function(response){
					if (response.data === 'activated') {
						$("#activeAccount").text('Active');
					} else {
						$("#activeAccount").text('Inactive');
					}
				}
			})

		}
	</script>
 @endsection
