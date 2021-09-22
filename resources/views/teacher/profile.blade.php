@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <form action="{{ route('teacher.updateProfile') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="first_name">First Name<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $teacher->first_name }}">
                      @if ($errors->has('first_name'))
                          <span style="color: red;">{{ $errors->first('first_name') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="last_name">Last Name<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $teacher->last_name }}">
                      @if ($errors->has('last_name'))
                          <span style="color: red;">{{ $errors->first('last_name') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="gender">Gender</label>
                      <select class="custom-select" id="gender" name="gender">
                        <option disabled value="">Choose...</option>
                        <option value="male" @if($teacher->gender == 'male') selected @endif>Male</option>
                        <option value="female" @if($teacher->gender == 'female') selected @endif>Female</option>
                        <option value="others" @if($teacher->gender == 'others') selected @endif>Others</option>
                      </select>
                      @if ($errors->has('gender'))
                          <span style="color: red;">{{ $errors->first('gender') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"
                      value="{{ $teacher->email }}" name="email" disabled>
                      @if ($errors->has('email'))
                         <span style="color: red;">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputMobile">Mobile</label>
                      <input type="number" name="mobile" class="form-control" id="exampleInputMobile" placeholder="Enter mobile"
                      value="{{ $teacher->mobile }}" id="mobile" onkeyup="mobileValidation()">
                      <span style="color: red;" id="digit_error"></span>
                      @if ($errors->has('mobile'))
                         <span style="color: red;">{{ $errors->first('mobile') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputDOB">DOB</label>
                      <input type="date" class="form-control" id="exampleInputDOB" placeholder="Enter date of birth" name="dob"
                      value="{{ $teacher->dob }}">
                      @if ($errors->has('dob'))
                         <span style="color: red;">{{ $errors->first('dob') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputAddress">Address</label>
                      <input type="text" class="form-control" id="exampleInputAddress" placeholder="Enter address"
                      value="{{ $teacher->address }}" name="address">
                      @if ($errors->has('address'))
                         <span style="color: red;">{{ $errors->first('address') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="fname">Father's Name</label>
                      <input type="text" class="form-control" id="fname" placeholder="Enter father's name"
                      value="{{ $teacher->fathers_name }}" name="fathers_name">
                      @if ($errors->has('fathers_name'))
                         <span style="color: red;">{{ $errors->first('fathers_name') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="class">Class</label>
                      <select class="custom-select" id="class" name="class">
                        <option disabled value="">Choose...</option>
                        <option value="one" @if($teacher->class == 'one') selected @endif>One</option>
                        <option value="two" @if($teacher->class == 'two') selected @endif>Two</option>
                        <option value="three" @if($teacher->class == 'three') selected @endif>Three</option>
                      </select>
                      @if ($errors->has('class'))
                          <span style="color: red;">{{ $errors->first('class') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="section">Section</label>
                      <select class="custom-select" id="section" name="section">
                        <option selected disabled value="">Choose...</option>
                        <option value="one" @if($teacher->section == 'one') selected @endif>One</option>
                        <option value="two" @if($teacher->section == 'two') selected @endif>Two</option>
                        <option value="three" @if($teacher->section == 'three') selected @endif>Three</option>
                      </select>
                      @if ($errors->has('section'))
                          <span style="color: red;">{{ $errors->first('section') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Profile picture</label>
                      <input type="file" class="form-control-file" id="exampleInputFile" name="image">
                      {{-- <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="form-control-file" id="exampleInputFile" name="image">
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        @if ($errors->has('image'))
                          <span style="color: red;">{{ $errors->first('image') }}</span>
                        @endif
                      </div> --}}
                      @if ($teacher->image === 'default.png')
                      <img src="{{ asset('upload/'.$teacher->image) }}" alt="" width="200" height="200">
                      @else
                      <img src="{{ asset($teacher->image) }}" alt="" width="200" height="200">
                      @endif
                      
                    </div>
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id='update_profile'>Update Profile</button>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
  function mobileValidation() {
	    if($('[name=mobile]').val().length > 10){
	        $('#digit_error').html('Please enter 10 digit number');
	        $('#mobile').focus();
	        document.getElementById("update_profile").disabled = true;
	        document.getElementById("update_profile").style.cursor = 'no-drop';
	    }else{
	        $('#digit_error').html('');
	        document.getElementById("update_profile").disabled = false;
	        document.getElementById("update_profile").style.cursor = 'pointer';
	    }
    }
</script>
@endsection
