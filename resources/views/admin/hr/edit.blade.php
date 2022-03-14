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
                        <li><a href="{{ route('admin.hr.index') }}">HR List</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">Edit HR details</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5>Edit HR Details</h5>
                <hr>
                <form action="{{ route('admin.hr.update', $hr_details['id']) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <h5 class="text-blue">Basic Information</h5>
                    <div class="row m-0 pt-3">
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="first_name">First Name<span class="text-danger">*</span></label>
                                <input type="text" name="first_name" class="form-control" id="first_name"
                                    value="{{ $hr_details->first_name }}" onkeydown="return alphaOnly(event);">
                                @if ($errors->has('first_name'))
                                    <span style="color: red;">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="last_name">Last Name<span class="text-danger">*</span></label>
                                <input type="text" name="last_name" class="form-control" id="last_name"
                                    value="{{ $hr_details->last_name }}" onkeydown="return alphaOnly(event);">
                                @if ($errors->has('last_name'))
                                    <span style="color: red;">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="email">Email Address<span class="text-danger">*</span></label>
                                <input type="text" id="email" class="form-control" name="email"
                                    value="{{ $hr_details->email }}" readonly>
                                @if ($errors->has('email'))
                                    <span style="color: red;">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 form-group edit-box">
                            <label for="mobile">Mobile No<span class="text-danger">*</span></label>
                            <input type="number" id="mobile" class="form-control" value="{{ $hr_details->mobile }}"
                                name="mobile" maxlength="10"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                @if ($hr_details->mobile == '') onkeyup="mobileValidation()" @endif>
								@if ($errors->has('mobile'))
                                <span style="color: red;" id="mobile_err">{{ $errors->first('mobile') }}</span>
                            @endif
                            <span style="color: red;" id="digit_error"></span>
                            <span class="text-danger mobile-err"></span>
                            <span class="text-success mobile-success"></span>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="col-lg-6 form-group edit-box">
                            <label for="exampleInputEmail1">Date Of Joining<span class="text-danger">*</span></label>
                            <input type="text" class="form-control datepicker" id="exampleInputEmail1"
                                placeholder="Enter date of birth" name="doj" value="{{ $hr_details->doj }}">
                            @if ($errors->has('doj'))
                                <span style="color: red;">{{ $errors->first('doj') }}</span>
                            @endif
                        </div>
                        {{-- <div class="col-lg-6">
									<div class="form-group edit-box">
										<label for="father_name">Father's Name</label>
										<input type="text" value="{{ $hr_details->fathers_name }}" class="form-control" name="fathers_name">
										@if ($errors->has('dob'))
									   		<span style="color: red;">{{ $errors->first('fathers_name') }}</span>
										@endif
									</div>
								</div> --}}
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="gender">Gender<span class="text-danger">*</span></label>
                                <select class="custom-select" id="gender" name="gender">
                                    <option disabled value="">Choose...</option>
                                    <option value="Male" @if ($hr_details->gender == 'male') selected @endif>Male</option>
                                    <option value="Female" @if ($hr_details->gender == 'female') selected @endif>Female</option>
                                    <option value="others" @if ($hr_details->gender == 'others') selected @endif>Others</option>
                                </select>
                                @if ($errors->has('gender'))
                                    <span style="color: red;">{{ $errors->first('gender') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 form-group edit-box">
                            <label for="exampleInputEmail1">Upload picture</label>
                            <input type="file" class="form-control" id="image" name="image">
							@if ($hr_details->image)
								<img src="{{ asset($hr_details->image) }}" alt="" height="50" width="50">
							@endif
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
										<option value="1" @if ($hr_details->status == 1) selected @endif>Active</option>
										<option value="0" @if ($hr_details->status == 0) selected @endif>Inactive</option>
									</select>
								</div>
							</div> --}}
                    <h5 class="text-blue">Address</h5>
                    <div class="row m-0 pt-3">
                        <div class="col-lg-4">
                            <div class="form-group edit-box">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address"
                                    value="{{ $hr_details->address }}">
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
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
    <script>
        $('.datepicker').datepicker({
            format: 'dd-M-yyyy',
            endDate: '+1d',
            autoclose: true,
            clearBtn: true,
            // daysOfWeekDisabled: [0]
        });
        function alphaOnly(event) {
            var key = event.keyCode;
            return ((key >= 65 && key <= 90) || key == 8);
        };
        /*
        		 Mobile AAvailability
        	*/
        $('#mobile').on('keyup', function() {
        // function mobileValidation() {
            $('#mobile_err').html('');
            let mobile = $('#mobile').val();
            console.log(mobile);
            $('input[name="mobile"]').next('.error').html('');
            if (mobile) {
                if (mobile.length > 10) {
                    $('.mobile-success').html('');
                    $('.mobile-err').html('Please enter 10 digit number');
                    $('#mobile').focus();
                    document.getElementById("btn_submit").disabled = true;
                    document.getElementById("btn_submit").style.cursor = 'no-drop';
                } else if (mobile.length < 10) {
                    $('.mobile-success').html('');
                    $('.mobile-err').html('Please enter 10 digit number');
                    $('#mobile').focus();
                    document.getElementById("btn_submit").disabled = true;
                    document.getElementById("btn_submit").style.cursor = 'no-drop';
                } 
                else if (mobile.length == 10){
                    $('.mobile-err').html('');
                    document.getElementById("btn_submit").disabled = false;
                    document.getElementById("btn_submit").style.cursor = 'pointer';
                }
                // else if (mobile.length == 10) {
                //     $.ajax({
                //         url: "{{ route('checkMobileNoExistence') }}",
                //         data: {
                //             _token: "{{ csrf_token() }}",
                //             mobile: mobile
                //         },
                //         dataType: 'json',
                //         type: 'post',
                //         beforeSend: function() {
                //             $(".mobile-success").html('Loading....');
                //         },
                //         success: function(response) {
                //             if (response.msg == 'success') {
                //                 $('.mobile-err').html('');
                //                 $('.mobile-success').html('Available');
                //                 document.getElementById("btn_submit").disabled = false;
                //                 document.getElementById("btn_submit").style.cursor = 'pointer';

                //             } else {
                //                 $(".mobile-success").html('');
                //                 $(".mobile-err").html('Already exist!!');
                //                 document.getElementById("btn_submit").disabled = true;
                //                 document.getElementById("btn_submit").style.cursor = 'no-drop';
                //             }
                //         }
                //     });
                // }
            } else {
                $(".email-success").html('');
                $(".email-err").html('');
                document.getElementById("btn_submit").disabled = false;
                document.getElementById("btn_submit").style.cursor = 'pointer';
            }
        });
    </script>
@endsection
