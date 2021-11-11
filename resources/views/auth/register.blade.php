@extends('auth.layout.master')
@section('content')
<img src="{{ asset('frontend/images/dot2.png') }}" class="img-fluid post-img">
<div class="ripple" style="animation-delay: 0s"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 offset-sm-1">
            <div class="sign-in-box">
                <div class="row align-items-center jusify-content-center">
                    <div class="col-lg-5">
                        <img src="{{ asset('frontend/images/sign-in.png') }}" class="img-fluid">
                    </div>
                    <div class="col-lg-7 form-div wow fadeInRight">
                        <div class="heading">
                            <h1>Admission Now :)</h1>
                        </div>
                        <p>To keep connected with us please login with your personal information by email address and
                            password<span class="ml-3"><img src="{{ asset('frontend/images/bell.png') }}"
                            class="img-fluid"></span></p>
                            <form class="cd-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
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
                                        <label for="">Date Of Birth<span class="text-danger">*</span></label>
                                        <input class="form-control" type="date" name="dob" value="{{ old('dob') }}">
                                        @error('dob')
                                             <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="">Class<span class="text-danger">*</span></label>
                                    <select name="class" class="form-control" id="class" >
                                        <option value="">Select Class</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}" @if (old('class') == $class->name)
                                                selected
                                            @endif>{{ $class->name }}</option>
                                        @endforeach
                                        @error('class')
                                             <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Special Course</label>
                                    <select  class="form-control" id="course_id" name="course_id">
                                      
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="image">Upload Picture(png,jpg,jpeg only)<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="image" value="{{ old('image') }}">
                                     @error('image')
                                             <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="certificate">Upload Documents(pdf only)<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="certificate" value="{{ old('certificate') }}">
                                     @error('certificate')
                                             <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                </div>
                            </div>
                            <div class="form-row mt-2">
                                <div class="form-group col-sm-12">
                                    <button class="btn btn-login mt-2 float-right" type="submit" id="submit"
                                    >Submit</button>
                                    <a href="{{ route('login') }}" class="btn btn-create mt-2" type="button" value="Login"><span></span>Back to login</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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

    $('#class').on('change', function() {
            let class_id = $('#class').val();
            // $(".choices-multiple-remove-button").html('<option value="">** Loading...</option>');
            // $(".choices-multiple-remove-button").html('<option value="">--Select a Country--</option>');
            $.ajax({
                url: "{{ route('getCourseByClass') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    class_id: class_id
                },
                dataType: 'json',
                type: 'post',
                beforeSend:function(){
		        	$("#course_id").html('<option value="">** Loading....</option>');	
		        },
                success: function(response) {
                    if(response.msg == 'success'){
                        $("#course_id").html('');
                        var option = '<option value="">Select a course</option>';
                        $.each( response.result, function( i ) {
                            option +='<option value="'+response.result[i].id+'">'+response.result[i].title+'</option>';
                        });

		                $("#course_id").append(option);
                    }else{
		            $("#course_id").html('<option value="">No Course Found</option>');
		          }
                }
            });
        });
</script>
@endsection