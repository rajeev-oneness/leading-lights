@extends('admin.auth.layout')
@section('content')

<div class="container-fluid login-body">
    <div class="row justify-content-center">
        <div class="authfy-container col-xs-12 col-sm-10 col-md-8 col-lg-6 shadow-lg p-0">
            <div class="row m-0">
                <div class="col-sm-12 authfy-panel-right">
                    <div class="authfy-login authfy-forget">
                        <h3>Forget Your Password ?
                            <small class="d-block text-muted">Enter your email address to reset password.</small>
                        </h3>
                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <form action="{{ route('admin.sendResetLink') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="inputEmail">Email address</label>
                                <input type="email" class="form-control" id="inputEmail" tabindex="1" placeholder="Enter your email" required="" name="email">
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-brand nm-hvr nm-btn-1"> Submit <i class="fas fa-sign-in-alt ml-2"></i></button>
                            </div>
                        </form>
                        <div class="text-center">
                            <p class="log-text">Return to login <a href="{{ route('admin.login') }}">Log In</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>	
@endsection	