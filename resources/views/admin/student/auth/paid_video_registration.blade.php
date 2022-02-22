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
			<form action="{{ route('admin.students.registration.paid.video') }}" method="POST" id="registrationForm">
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
							<input type="text" name="last_name" class="form-control" id="last_name" value="{{ old('last_name') }}"  onkeydown="return alphaOnly(event);">
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
					<div class="col-lg-6">
						<div class="form-group edit-box">
							<label for="email">Which Video You want to Subscription<span class="text-danger">*</span></label>
							<select name="class" class="form-control" id="class_wise">
								<option value="" selected>Select Video</option>
								@foreach ($videos as $video)
									<option value="{{ $video->id }}">{{ \Illuminate\Support\Str::limit($video->title,50) }}</option>
								@endforeach
							</select>
							<div class="error" style="color : red;">Please Fill This field.</div>
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

	$('#btn_submit').on('click', function(e) {
            e.preventDefault();
            var errorFlagOne = 0;

            var email = $('[name="email"]').val(),
                mobile = $('[name="mobile"]').val(),
                first_name = $('[name="first_name"]').val(),
                last_name = $('[name="last_name"]').val(),
                class_id = $('[name="class"]').val(),
                class_wise = $('#class_wise').val();
                // image = $('[name="image"]').val(),
                // certificate = $('[name="certificate"]').val();
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
                $('#class_wise').next('.error').fadeOut(100);

            } else {
                    $('#class_wise').next('.error').fadeIn(100);
                    errorFlagOne = 1;
            }

            if (errorFlagOne == 1) {
                return false;
            } else {
                $("#registrationForm").submit();
				$('#btn_submit').text('Loading...');
                document.getElementById("btn_submit").disabled = true;
                document.getElementById("btn_submit").style.cursor = 'no-drop';
            }
        });
		function alphaOnly(event) {
            var key = event.keyCode;
            return ((key >= 65 && key <= 90) || key == 8);
        };
</script>
@endsection