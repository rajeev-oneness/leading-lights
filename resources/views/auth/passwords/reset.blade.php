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
                                <h1>Reset password</h1>
                            </div>
                            <p>To keep connected with us please login with your personal information by email address
                                and password<span class="ml-3"><img
                                        src="{{ asset('frontend/images/bell.png') }}" class="img-fluid"></span>
                            </p>

                            <form class="cd-form" method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-row">
                                    <div class="form-group col-sm-12">
                                        <label class="image-replace cd-email" for="email">E-mail Address</label>
                                            
                                            <input id="email" type="email" class="full-width has-padding has-border" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-sm-12">
                                        <label class="image-replace cd-password" for="signin-password">Password</label>
                                        <input class="full-width has-padding has-border" id="signin-password"
                                            type="password" placeholder="Password" name="password" required>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-12">
                                        <label class="image-replace cd-password" for="password-confirm">Confirm
                                            Password</label>
                                        <input id="password-confirm" type="password"
                                            class="full-width has-padding has-border" name="password_confirmation" required
                                            autocomplete="new-password" placeholder="Confirm Password">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row mt-2">
                                    <div class="form-group col-sm-12">
                                        <button class="btn btn-login mt-2">Reset Password</button>
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
