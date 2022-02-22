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
			<form action="{{ route('admin.students.registration.special.course') }}" method="POST" id="registrationForm">
				@csrf
				<h5 class="text-blue">Basic Information</h5>
				<div class="row m-0 pt-3">
					<div class="col-lg-6">
						<div class="form-group edit-box">
							<label for="first_name">First Name<span class="text-danger">*</span></label>
							<input type="text" name="first_name" class="form-control" id="first_name" value="{{ old('first_name') }}" onkeydown="return alphaOnly(event);">
							@if ($errors->has('first_name'))
							<span style="color: red;">{{ $errors->first('first_name') }}</span>
							@endif
							<div class="error" style="color : red;">Please Fill This field.</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group edit-box">
							<label for="last_name">Last Name<span class="text-danger">*</span></label>
							<input type="text" name="last_name" class="form-control" id="last_name" value="{{ old('last_name') }}" onkeydown="return alphaOnly(event);">
							@if ($errors->has('last_name'))
							<span style="color: red;">{{ $errors->first('last_name') }}</span>
							@endif
							<div class="error" style="color : red;">Please Fill This field.</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group edit-box">
							<label for="email">Email Address<span class="text-danger">*</span></label>
							<input type="text" id="email" class="form-control" name="email" value="{{ old('email') }}" >
							@if ($errors->has('email'))
							<span style="color: red;">{{ $errors->first('email') }}</span>
							@endif
							<div class="error" style="color : red;">Please Fill This field.</div>
							<span class="text-danger email-err"></span>
							<span class="text-success email-success"></span>
						</div>
					</div>
					<div class="col-lg-6 d-none">
						<div class="form-group edit-box">
							<label for="email">Regular Class<span class="text-danger">*</span></label>
							<select name="class" class="form-control" id="class_wise">
								<option value="" selected>Select Class</option>
								@foreach ($classes as $class)
									<option value="{{ $class->id }}" @if (old('class') == $class->name)
										selected
								@endif>{{ $class->name }}</option>
								@endforeach
							</select>
							<div class="error" style="color : red;">Please Fill This field.</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group edit-box">
							<label for="email">Regular Class<span class="text-danger">*</span></label>
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
							<label for="">Select Course<span class="text-danger">*</span></label>
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

	$('#btn_submit').on('click', function(e) {
            e.preventDefault();
            var errorFlagOne = 0;

            var email = $('[name="email"]').val(),
                first_name = $('[name="first_name"]').val(),
                last_name = $('[name="last_name"]').val(),
                class_id = $('[name="class"]').val(),
                class_wise = $('#class_wise').val(),
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
            if (class_wise_combo && special_course_ids.length == 0) {
                $('#special_course_id_err').fadeIn(100);
                errorFlagOne = 1;
            } else {
                $('#special_course_id_err').fadeOut(100);
            }


            if (errorFlagOne == 1) {
                return false;
            } else {
                $("#registrationForm").submit();
            }
        });
	//Email availability
	$('#email').on('keyup', function() {
		let email = $('#email').val();
		$('input[name="email"]').next('.error').html('');
		if (email) {
			if (IsEmail(email) == false) {
				$(".email-success").html('');
				$(".email-err").html('');
				$('.email-err').html('Invalid Email Address!').fadeIn(100);
				document.getElementById("btn_submit").disabled = true;
                document.getElementById("btn_submit").style.cursor = 'no-drop';
			} else {
				$.ajax({
					url: "{{ route('checkEmailExistence') }}",
					data: {
						_token: "{{ csrf_token() }}",
						email: email
					},
					dataType: 'json',
					type: 'post',
					beforeSend: function() {
						$(".email-success").html('Loading....');
					},
					success: function(response) {
						if (response.msg == 'success') {
							$(".email-err").html('');
							$(".email-success").html('Available');
							document.getElementById("btn_submit").disabled = false;
							document.getElementById("btn_submit").style.cursor = 'pointer';

						} else {
							$(".email-success").html('');
							$(".email-err").html('Already exist!!');
							document.getElementById("btn_submit").disabled = true;
							document.getElementById("btn_submit").style.cursor = 'no-drop';
						}
					}
				});
			}
		} else {
			$(".email-success").html('');
			$(".email-err").html('');
			document.getElementById("btn_submit").disabled = false;
			document.getElementById("btn_submit").style.cursor = 'pointer';
		}
	});

	//Email Validation
	function IsEmail(eml) {
		var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!regex.test(eml)) {
			return false;
		} else {
			return true;
		}
	}

	$('#class_wise_combo').on('change', function() {
		let class_id = $('#class_wise_combo').val();
		$.ajax({
			url: "{{ route('getCourseByClass') }}",
			data: {
				_token: "{{ csrf_token() }}",
				class_id: class_id
			},
			dataType: 'json',
			type: 'post',
			beforeSend: function() {
				$("#special_course_ids").html('<option value="">** Loading....</option>');
			},
			success: function(response) {
				if (response.msg == 'success') {
					$("#special_course_ids").html('');
					var option = '';
					$.each(response.result, function(i) {
						option += '<option value="' + response.result[i].id + '">' +
							response.result[i].title + '</option>';
					});

					$("#special_course_ids").append(option);
				} else {
					$("#special_course_ids").html('<option value="">No Course Found</option>');
				}
			}
		});
    });

	$('#class_wise_combo').on('change',function() {
		if ($('#class_wise_combo').val() != "") {
			$('#class_wise').prop('disabled', true);
			$('#first_block').removeClass("actv_bg");
			$('#second_block').addClass("actv_bg");
		}else{
			$('#class_wise').prop('disabled', false);
			$('#first_block').removeClass("actv_bg");
			$('#second_block').removeClass("actv_bg");
		}
    })

	function alphaOnly(event) {
            var key = event.keyCode;
            return ((key >= 65 && key <= 90) || key == 8);
        };
</script>
@endsection