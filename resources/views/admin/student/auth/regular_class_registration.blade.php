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
                        <li><a href="{{ route('admin.students.index') }}">Student List</a></li>
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
                <form action="{{ route('admin.students.registration.regular.class') }}" method="POST">
                    @csrf
                    <h5 class="text-blue">Basic Information</h5>
                    <div class="row m-0 pt-3">
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="first_name">First Name<span class="text-danger">*</span></label>
                                <input type="text" name="first_name" class="form-control" id="first_name"
                                    value="{{ old('first_name') }}" onkeydown="return alphaOnly(event);">
                                @if ($errors->has('first_name'))
                                    <span style="color: red;">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="last_name">Last Name<span class="text-danger">*</span></label>
                                <input type="text" name="last_name" class="form-control" id="last_name"
                                    value="{{ old('last_name') }}" onkeydown="return alphaOnly(event);">
                                @if ($errors->has('last_name'))
                                    <span style="color: red;">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="email">Email Address<span class="text-danger">*</span></label>
                                <input type="text" id="email" class="form-control" name="email"
                                    value="{{ old('email') }}">
                                <span class="text-danger email-err"></span>
                                <span class="text-success email-success"></span>
                                @if ($errors->has('email'))
                                    <span style="color: red;">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="class">Class<span class="text-danger">*</span></label>
                                <select name="class" id="class" class="form-control">
                                    <option value="">Please select class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}"
                                            @if (old('class') == $class->id) selected @endif>{{ $class->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('class'))
                                    <span style="color: red;">{{ $errors->first('class') }}</span>
                                @endif
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

        function alphaOnly(event) {
            var key = event.keyCode;
            return ((key >= 65 && key <= 90) || key == 8);
        };
    </script>
@endsection
