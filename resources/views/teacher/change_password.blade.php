@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Change password</div>
                @if (session('change_password_success_message'))
                <div class="alert alert-success">
                    {{ session('change_password_success_message') }}
                </div>
                @endif
                @if (session('change_password_warning'))
                <div class="alert alert-danger">
                    {{ session('change_password_warning') }}
                </div>
                @endif
                <form action="{{ route('teacher.updatePassword') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label class="control-label">Current password</label>
                      <input type="password" class="form-control" name="old_password" id="old_password" value="{{ old('old_password') }}"  required />
                      @if ($errors->change_password_warning->has('old_password'))
                          <span style="color: red;">{{ $errors->change_password_warning->first('old_password') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label class="control-label">New Password</label>
                      <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}"  required />
                      @if ($errors->change_password_warning->has('password'))
                          <span style="color: red;">{{ $errors->change_password_warning->first('password') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label class="control-label">Confirm password</label>
                      <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}"  required />
                      @if ($errors->change_password_warning->has('password_confirmation'))
                          <span style="color: red;">{{ $errors->change_password_warning->first('password_confirmation') }}</span>
                      @endif
                    </div>
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id='update_profile'>Update Password</button>
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
