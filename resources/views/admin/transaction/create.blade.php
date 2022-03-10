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
							<li><a href="{{ route('admin.transaction.index')}}">All Transaction List</a></li>
							<li class="text-white"><i class="fa fa-chevron-right"></i></li>
							<li><a href="#" class="active">Add Transaction</a></li>
						</ul>
					</div>
					@include('admin.layouts.navbar')
				</div>
				<hr>
				<div class="dashboard-body-content">
						<h5>Add Transaction</h5>
						<hr>
						<form action="{{ route('admin.students.transaction.paymentDue') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="row m-0 pt-3">
								<div class="col-lg-6">
									<div class="form-group edit-box">
										<label for="name">Select Class<span class="text-danger">*</span></label>
										<select name="class" id="class_wise_combo" class="form-control">
											<option value="">Select Class</option>
											{{-- @foreach ($groups as $group)
												<option value="{{ $group->id . '-group' }}" class="text-info">
													{{ $group->name }}</option>
											@endforeach --}}
											@foreach ($classes as $class)
												<option value="{{ $class->id . '-class' }}" @if (old('class') == $class->id) selected @endif>
													{{ $class->name }}</option>
											@endforeach
										</select>
										@if ($errors->has('class'))
											<span style="color: red;width: 100%">{{ $errors->first('class') }}</span>
										@endif
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group edit-box">
									<label for="name">Student Name<span class="text-danger">*</span></label>
									<select class="form-control" name="student_id" id="student_id">
										@foreach ($users as $user)
											<option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
										@endforeach
									</select>
									@if ($errors->has('student_id'))
										<span style="color: red;">{{ $errors->first('student_id') }}</span>
									@endif
									</div>
								</div>
							</div>
							<div class="form-group d-flex justify-content-end">
								<button type="submit" class="actionbutton">Proceed</button>
							</div>
						</form>
				</div>
				</div>
			</div>
<script>
	$(document).ready(function() {
		$('#student_id').select2();
		var validated = false;
		$('.error').hide();
    });
	$('#class_wise_combo').on('change', function() {
		let class_id = $('#class_wise_combo').val();
		$.ajax({
			url: "{{ route('getStudentByClass') }}",
			data: {
				_token: "{{ csrf_token() }}",
				class_id: class_id
			},
			dataType: 'json',
			type: 'post',
			beforeSend: function() {
				$("#student_id").html('<option value="">** Loading....</option>');
			},
			success: function(response) {
				if (response) {
					$("#student_id").html('');
					var option = '';
					$.each(response, function(i) {
						option += '<option value="' + response[i].id + '">' +
							response[i].first_name + ' '+ response[i].last_name +'</option>';
					});

					$("#student_id").append(option);
				} else {
					$("#student_id").html('<option value="">No Student Found</option>');
				}
			}
		});
	});
</script>
@endsection