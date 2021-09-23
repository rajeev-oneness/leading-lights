@extends('admin.auth.layout')
@section('content')
    <div class="container-fluid login-body">
        <div class="row justify-content-center">
            <div class="authfy-container col-xs-12 col-sm-10 col-md-8 col-lg-6 shadow-lg p-0">
                <div class="row m-0">
                    <div class="col-sm-5 authfy-panel-left">
                        <div class="brand-col">
                            <div class="headline text-center">
                                <div class="brand-logo text-center pt-5">
                                    <img src="{{ asset('img/logo.jpg') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7 authfy-panel-right">
                        <div class="authfy-login">
                            <h3>Reset Password</h3>
                            @if (session('error'))
                               <span class="text-danger">{{ session('error') }}</span> 
                            @endif
                            <form method="POST" action="{{ route('admin.resetPassword',$token) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="inputEmail">Email address</label>
                                    <input type="email" class="form-control" id="inputEmail" tabindex="1" placeholder="Enter your email" required="" name="email" value="{{ $email }}" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" tabindex="2" placeholder="Enter your password" id="inputPassword" required="">
                                    @if ($errors->reset_password_warning->has('password'))
                                    <span class="text-danger">{{ $errors->reset_password_warning->first('password') }}</span>
                                     @endif
                                </div>
                                <div class="form-group">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Enter your confirm password" required autocomplete="new-password">
                                    @if ($errors->reset_password_warning->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->reset_password_warning->first('password_confirmation') }}</span>
                                     @endif
                                </div>
                                <div class="text-right">
                                    
                                    <button type="submit" class="btn btn-brand nm-hvr nm-btn-1"> Reset <i class="fas fa-sign-in-alt ml-2"></i></button>
                                </div>
                            </form>
                            <div class="text-center">
                                {{-- <p class="log-text">Don't have an account? <a href="registration.html">Sign Up</a></p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-7 form-content">
                <div class="login-box">
                    <div class="image-wrapper logo-wrapper">
                        <img src="./assets/img/WeVouch_Logo.png" class="img-fluid logo">
                    </div>
                    <h1 class="form-heading">Sign In</h1>
                    <form class="login-form">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="Username" id="username" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="Password" id="password" class="form-control" placeholder="Enter Password">
                        </div>
                        <div class="form-group form-button-row">
                            <a href="forgetPassword.html">Forget Password</a>
                            <button class="actionbutton">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div> -->
        </div>
    </div>
@endsection	