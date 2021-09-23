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
                                <!--<p>
                                    Login using social media to get quick access
                                </p>
                                <div class="row social-buttons">
                                    <div class="col-xs-4 col-sm-4 col-md-12">
                                        <a href="#" class="btn btn-sm btn-block btn-facebook">
                                            <i class="fab fa-facebook-f mr-1"></i> <span class="hidden-xs hidden-sm">Signin with facebook</span>
                                        </a>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-12">
                                        <a href="#" class="btn btn-sm btn-block btn-twitter">
                                        <i class="fab fa-twitter mr-1"></i> <span class="hidden-xs hidden-sm">Signin with twitter</span>
                                        </a>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-12">
                                        <a href="#" class="btn btn-sm btn-block btn-google">
                                        <i class="fab fa-google-plus-g mr-1"></i> <span class="hidden-xs hidden-sm">Signin with google</span>
                                        </a>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7 authfy-panel-right">
                        <div class="authfy-login">
                            <h3>Login
                                <small class="d-block text-muted">Enter your email address and password to access the account</small>
                            </h3>
                            @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <form method="POST" action="{{ route('admin.login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="inputEmail">Email address</label>
                                    <input type="email" class="form-control" name="email" id="inputEmail" tabindex="1" placeholder="Enter your email" value="{{ old('email') }}" required="">
                                        @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword">
                                        <span class="d-flex nm-jcb nm-aic">
                                            Password
                                            <a class="nm-lu nm-ct" href="{{ route('admin.forgotPassword') }}">Forgot Password?</a>
                                        </span>
                                    </label>
                                    <input type="password" class="form-control" name="password" tabindex="2" placeholder="Enter your password" id="inputPassword" required="">
                                    @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                     @endif
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="rememberMe">
                                    <label class="form-check-label nm-check" for="rememberMe">Remember me</label>
                                </div>
                                <div class="text-right">
                                    
                                    <button type="submit" class="btn btn-brand nm-hvr nm-btn-1"> Log In <i class="fas fa-sign-in-alt ml-2"></i></button>
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
