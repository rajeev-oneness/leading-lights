@extends('teacher.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-graduation-cap"></i>
                        </div>
                        <div>Change Password
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabs-animation">
                <div class="card mb-3">
                  @if (session('change_password_success_message'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ session('change_password_success_message') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  @endif
                  @if (session('change_password_warning'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{ session('change_password_warning') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  @endif
                  <div class="card-header">Change password</div>
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
        @include('teacher.layouts.static_footer')
    </div>
@endsection
