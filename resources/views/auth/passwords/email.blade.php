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
                                <h1>Forgot password</h1>
                            </div>
                            <p>To keep connected with us please use with your email address
                                for forgot your password<span class="ml-3"><img
                                        src="{{ asset('frontend/images/bell.png') }}" class="img-fluid"></span>
                            </p>
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            <form class="cd-form" method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-sm-12">
                                        <label class="image-replace cd-email" for="signin-email">E-mail Address</label>
                                        <input class="full-width has-padding has-border" id="signin-email"
                                            type="E-mail Address" placeholder="E-mail" name="email">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row mt-2">
                                    <div class="form-group col-sm-12">
                                        <button class="btn btn-login mt-2">Send password reset link</button>
                                        <a class="btn btn-create mt-2" type="button" value="Login"
                                            href="{{ route('login') }}"><span><i class="fa fa-arrow-left"></i></span>Back
                                            to login</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
