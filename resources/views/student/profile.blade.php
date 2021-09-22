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
                <form action="{{ route('user.updateProfile', $student->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                      <div class="form-group edit-box">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="first_name" value="{{ $student->first_name }}">
                        @if ($errors->has('first_name'))
                          <span style="color: red;">{{ $errors->first('first_name') }}</span>
                        @endif
                      </div>
                      <div class="form-group edit-box">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="last_name" value="{{ $student->last_name }}">
                        @if ($errors->has('last_name'))
                          <span style="color: red;">{{ $errors->first('last_name') }}</span>
                        @endif
                      </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"
                      value="{{ $student->email }}" name="email" disabled>
                      @if ($errors->has('email'))
                         <span style="color: red;">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputMobile">Mobile</label>
                      <input type="number" name="mobile" class="form-control" id="exampleInputMobile" placeholder="Enter mobile"
                      value="{{ $student->mobile }}" id="mobile" onkeyup="mobileValidation()">
                      <span style="color: red;" id="digit_error"></span>
                      @if ($errors->has('mobile'))
                         <span style="color: red;">{{ $errors->first('mobile') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputDOB">DOB</label>
                      <input type="date" class="form-control" id="exampleInputDOB" placeholder="Enter date of birth" name="dob"
                      value="{{ $student->dob }}">
                      @if ($errors->has('dob'))
                         <span style="color: red;">{{ $errors->first('dob') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputAddress">Address</label>
                      <input type="text" class="form-control" id="exampleInputAddress" placeholder="Enter address"
                      value="{{ $student->address }}" name="address">
                      @if ($errors->has('address'))
                         <span style="color: red;">{{ $errors->first('address') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="fname">Father's Name</label>
                      <input type="text" class="form-control" id="fname" placeholder="Enter father's name"
                      value="{{ $student->fathers_name }}" name="fathers_name">
                      @if ($errors->has('fathers_name'))
                         <span style="color: red;">{{ $errors->first('fathers_name') }}</span>
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
                      @if ($student->image === 'default.png')
                      <img src="{{ asset('upload/'.$student->image) }}" alt="" width="200" height="200">
                      @else
                      <img src="{{ asset($student->image) }}" alt="" width="200" height="200">
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
