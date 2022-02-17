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
			@include('admin.layouts.navbar')
		</div>
		<hr>
		<div class="dashboard-body-content">
			<h5>Add student</h5>
			<hr>
			<form action="{{ route('admin.students.store') }}" method="POST">
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
							<select name="class" class="form-control" id="class_wise_combo">
								<option value="">Select Class</option>
								@foreach ($classes as $class)
									<option value="{{ $class->id }}" @if (old('class') == $class->name)
										selected
								@endif>{{ $class->name }}</option>
								@endforeach
							</select>
							<div class="error" style="color : red;">Please Fill This field.</div>
							@error('class')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group edit-box">
							<label for=""><b>Select Course</b></label>
							<select class="special_course_ids form-control" name="special_course_ids[]"
								multiple="multiple" id="special_course_ids">
								@foreach ($special_courses as $course)
									<option value="{{ $course->id }}">{{ $course->title }}</option>
								@endforeach
							</select>
							<div class="error" style="color : red;" id="special_course_id_err">Please Fill This field.</div>
						</div>
					</div>
				</div>
				<div class="form-group d-flex justify-content-end">
					<button type="submit" class="actionbutton" id="btn_submit">SAVE</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	 $(document).ready(function() {
		$('.special_course_ids').select2();
		var validated = false;
		$('.error').hide();
    });
	$('#btn_submit').on('click', function(e){
		e.preventDefault();
        var errorFlagOne = 0;
		var email = $('[name="email"]').val(),
		first_name = $('[name="first_name"]').val(),
		last_name = $('[name="last_name"]').val(),
		class_wise_combo = $('#class_wise_combo').val(),
		special_course_ids = $('#special_course_ids').val();

		if (!first_name) {
                $('[name="first_name"]').next('.error').fadeIn(100);
                errorFlagOne = 1;
		} else {
			$('[name="first_name"]').next('.error').fadeOut(100);
		}

		if (!last_name) {
			$('[name="last_name"]').next('.error').fadeIn(100);
			errorFlagOne = 1;
		} else {
			$('[name="last_name"]').next('.error').fadeOut(100);
		}

		if (!email) {
                $('input[name="email"]').next('.error').html('Please Fill This field.').fadeIn(100);
                errorFlagOne = 1;
		} else {
			$('input[name="email"]').next('.error').fadeOut(100);
		}

		if (class_wise) {
                $('#class_wise_combo').next('.error').fadeOut(100);
                $('#class_wise').next('.error').fadeOut(100);

            } else {
                if (class_wise_combo) {
                    $('#class_wise').next('.error').fadeOut(100);

                }
                else if (special_course_ids.length > 0) {
                    $('#class_wise_combo').next('.error').fadeOut(100);
                    $('#class_wise').next('.error').fadeOut(100);
                }
                else{
                    $('#class_wise').next('.error').fadeIn(100);
                    errorFlagOne = 1;
                }

            }
            if (class_wise_combo) {
                $('#class_wise_combo').next('.error').fadeOut(100);
                $('#class_wise').next('.error').fadeOut(100);

            } else {
                if (class_wise) {
                    $('#class_wise_combo').next('.error').fadeOut(100);
                }
                else if (special_course_ids.length > 0) {
                    $('#class_wise_combo').next('.error').fadeOut(100);
                    $('#class_wise').next('.error').fadeOut(100);
                }
                else{
                    $('#class_wise_combo').next('.error').fadeIn(100);
                    errorFlagOne = 1;
                }

            }
	}
</script>
@endsection