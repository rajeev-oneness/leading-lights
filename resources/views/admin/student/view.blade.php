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
					<li><a href="{{ route('admin.students.show',$student->id) }}" class="active">Student Details</a></li>

				</ul>
			</div>
			<div class="col-lg-6">
				<div class="search-box-container">
					<!--<div class="input-group mr-3">
						<input type="text" class="form-control pl-2" placeholder="Search..." aria-label="Recipient's username" aria-describedby="button-addon2">
						<div class="input-group-append bg-white">
							<button class="btn btn-outline-secondary searchbtn border-left" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
						</div>
					</div>-->
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
			<div class="d-flex justify-content-between align-items-center">
				<h5>Student Details</h5>
			</div>
			<div class="d-flex justify-content-end align-items-center">
				@if ($student->status == 0)
					<a href="{{ route('admin.students.approve',$student->id) }}" class="btn btn-xs btn-info pull-right" onclick="activeAccount({{ $student->id }})" id="activeAccount">Inactive</a>
				@else
					<a href="{{ route('admin.students.approve',$student->id) }}" class="btn btn-xs btn-info pull-right" onclick="activeAccount({{ $student->id }})" id="activeAccount">Active</a>
				@endif
				
			</div>
			<hr>
			<h5 class="text-blue">Basic Information</h5>
			<div class="row m-0 details-page">
				<div class="col-lg-4">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" id="name" value="{{ $student->first_name }}  {{ $student->last_name }}" readonly>    
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" id="name" value="{{ $student->email }}" readonly>    
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label for="mobile">Mobile</label>
						<input type="text" id="mobile" value="{{ $student->mobile ? $student->mobile : 'NA'  }}" readonly>    
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label for="gender">Gender</label>
						<input type="text" id="gender" value="{{ $student->gender ? $student->gender : 'NA' }}" readonly>    
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label for="class">Class</label>
						<input type="text" id="class" value="{{ $student->class ? $student->class : 'NA' }}" readonly>    
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label for="dob">Date Of Birth</label>
						<input type="text" id="dob" value="{{ $student->dob ? $student->dob : 'NA' }}" readonly>    
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label for="fname">Father's name</label>
						<input type="text" id="fname" value="{{ $student->fathers_name ? $student->fathers_name : 'NA' }}" readonly>    
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
						<input type="text" id="address" value="{{ $student->address ? $student->address : 'NA' }}" readonly>    
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
