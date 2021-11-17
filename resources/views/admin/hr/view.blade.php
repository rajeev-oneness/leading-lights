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
					<li><a href="{{ route('admin.hr.index')}}">HR List</a></li>
					<li class="text-white"><i class="fa fa-chevron-right"></i></li>
					<li><a href="#" class="active">HR Details</a></li>

				</ul>
			</div>
			@include('admin.layouts.navbar')
		</div>
		<hr>
		<div class="app-main__outer">
			<div class="app-main__inner">
				<div class="app-page-title">
					<div class="page-title-wrapper">
						<div class="page-title-heading">
							<div class="page-title-icon">
								<i class="fa fa-text-height"></i>
							</div>
							<div>HR Profile
							</div>
						</div>
						<div class="ml-5">
                            @if ($hr->status == 0)
                                <a href="{{ route('admin.hr.approve', $hr->id) }}"
                                    class="btn btn-info pull-right" onclick="activeAccount({{ $hr->id }})"
                                    id="activeAccount">Pending</a>
                            @else
                                <a href="{{ route('admin.hr.approve', $hr->id) }}"
                                    class="btn btn-info pull-right" onclick="activeAccount({{ $hr->id }})"
                                    id="activeAccount">Approved</a>
                            @endif
                        </div>
					</div>
				</div>
				<div class="tabs-animation">
					<div class="bg-edit2 p-4">
						<div class="row">
							<div class="col-lg-5 col-sm-4">
								<img src="{{ asset($hr->image ? $hr->image : 'frontend/assets/images/avata2.jpg') }}" class="img-fluid mx-auto">
							</div>
							<div class="col-lg-7 col-sm-8 not2">
								<p>Joined-
									{{ $hr->created_at ? date('d-m-Y', strtotime($hr->created_at)) : 'N/A' }}
								</p>
								<h4 class="mb-4">{{ $hr->first_name }} {{ $hr->last_name }}<span
										class="ml-3">
										<!-- <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> -->
									</span></h4>
								<div class="row">
									<div class="col-lg-4 col-sm-3">
										<label>Address:</label>
									</div>
									<div class="col-lg-6 col-sm-7">
										<p id="address">{{ $hr->address ? $hr->address : 'N/A' }}</p>
									</div>
									<div class="col-lg-2 col-sm-2">
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-sm-3">
										<label>Mob. No:</label>
									</div>
									<div class="col-lg-6 col-sm-7">
										<p>{{ $hr->mobile ? $hr->mobile : 'N/A' }}</p>
									</div>
									<div class="col-lg-2 col-sm-2">
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-sm-3">
										<label>Email Id:</label>
									</div>
									<div class="col-lg-6 col-sm-7">
										<p>{{ $hr->email ? $hr->email : 'N/A' }}</p>
									</div>
									<div class="col-lg-2 col-sm-2">
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-sm-3">
										<label>Employee ID:</label>
									</div>
									<div class="col-lg-6 col-sm-7">
										<p>{{ $hr->id_no ? $hr->id_no : 'N/A' }}</p>
									</div>
									<div class="col-lg-2 col-sm-2">
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-sm-3">
										<label>Academic Qualification:</label>
									</div>
									<div class="col-lg-6 col-sm-7">
										<p id="qualification">{{ $hr->qualification ? $hr->qualification : 'N/A'}}</p>
									</div>
									<div class="col-lg-2 col-sm-2">
									</div>
								</div>
							</div>
						</div>
						<div class="row mt-4">
							<div class="col-lg-12">
								<div class="card mb-4">
									<div class="card-body">
										<div class="card-header-title font-size-lg text-capitalize mb-4">
											My Bio
										</div>
										<p>{{ $hr->about_us ? $hr->about_us : 'N/A' }}<span></span></p>
									</div>
								</div>
							</div>
						</div>
					</div>
	
				</div>
			</div>
			<div class="app-wrapper-footer">
				<div class="app-footer">
					<div class="app-footer__inner">
						<div class="app-footer-right">
							<ul class="header-megamenu nav">
								<li class="nav-item">
									<a class="nav-link">
										Copyright &copy; 2021 | All Right Reserved
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    </div>
    </div>
	<script>
		function activeAccount(hr_id,status){
			event.preventDefault();
			let url = $("#activeAccount").attr('href');
        	let data = {
				hr_id : hr_id,
				status : status
			};
			$.ajax({
				url: url,
				type: "PUT",
				data: data,
				dataType: 'json',
				beforeSend:function(){
		        	$("#activeAccount").text('Loading...')
		        },
				success: function(response){
					if (response.data === 'activated') {
						$("#activeAccount").text('Approved');
					} else {
						$("#activeAccount").text('Pending');
					}
				}
			})

		}
	</script>
 @endsection
