@extends('auth.layout.master')
@section('content')
<img src="{{ asset('frontend/images/dot2.png') }}" class="img-fluid post-img">
<div class="ripple" style="animation-delay: 0s"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 offset-sm-1">
            <div class="sign-in-box">
                <a href="{{ route('land_page') }}"><i title="Home Page" class="fa fa-home text-primary fa-2x float-right mr-2"></i></a>
                <div class="row align-items-center jusify-content-center">
                    <div class="col-lg-5">
                        <img src="{{ asset('frontend/images/sign-in-hr.png') }}" class="img-fluid">
                    </div>
                    <div class="col-lg-7 form-div wow fadeInRight">
                        <div class="heading">
                            <h1>Register Now :)</h1>
                        </div>
                        <p>To keep connected with us please login with your personal information by email address and
                            password<span class="ml-3"><img src="{{ asset('frontend/images/bell.png') }}"
                            class="img-fluid"></span></p>
                            <form class="cd-form" method="POST" action="{{ route('hr_register') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label for="first_name">First Name<span class="text-danger">*</span> </label>
                                        <input class="form-control" id="first_name" name="first_name" type="text" placeholder="" value="{{ old('first_name') }}">
                                        @error('first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <span class="cd-error-message">Error message here!</span>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="last_name">Last Name<span class="text-danger">*</span></label>
                                        <input class="form-control" id="last_name" name="last_name" type="text" placeholder="" value="{{ old('last_name') }}">
                                        @error('last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                    
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label for="email">Email address<span class="text-danger">*</span></label>
                                        <input class=" form-control" type="email" name="email" id="email" value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="mobile">Phone Number<span class="text-danger">*</span></label>
                                        <input class=" form-control" type="number" name="mobile" id="mobile" value="{{ old('mobile') }}" onkeyup="mobileValidation()">
                                        <span style="color: red;" id="digit_error"></span>
                                        @error('mobile')
                                             <span class="text-danger" id="mobile_err">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label for="gender">Gender<span class="text-danger">*</span></label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="Male" @if(old('gender') == 'Male')  selected @endif>Male</option>
                                            <option value="Female" value="Female" @if(old('gender') == 'Female')  selected @endif>Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Date Of Joining<span class="text-danger">*</span></label>
                                        <input class="form-control datepicker" type="text" name="doj" value="{{ old('doj') }}">
                                        @error('doj')
                                             <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="">Academic Qualification<span class="text-danger">*</span></label>
                                    <select name="qualification" class="form-control">
                                        <option value="M.Tech">M.Tech</option>
                                        <option value="B.Tech">B.Tech</option>
                                        <option value="MCA">MCA</option>
                                        <option value="MBA">MBA</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="image">Upload Profile Picture(png,jpg,jpeg only)<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="image">
                                     @error('image')
                                             <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                </div>
                            </div>
                            <div class="form-row mt-2">
                                <div class="form-group col-sm-12">
                                    <button class="btn btn-login mt-2 float-right" type="submit" id="submit"
                                    >Submit</button>
                                    <a href="{{ route('hr_login') }}" class="btn btn-create mt-2" type="button" value="Login"><span></span>Back to login</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script>
    	function mobileValidation() {
	    if($('[name=mobile]').val().length > 10){
	        $('#digit_error').html('Please enter 10 digit number');
	        $('#mobile').focus();
            $('#mobile_err').html('');
	        document.getElementById("submit").disabled = true;
	        document.getElementById("submit").style.cursor = 'no-drop';
	    }else{
	        $('#digit_error').html('');
	        document.getElementById("submit").disabled = false;
	        document.getElementById("submit").style.cursor = 'pointer';
	    }
    }
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '+1 day',
        daysOfWeekDisabled: [0]
    });
</script>
@endsection