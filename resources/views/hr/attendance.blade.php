@extends('hr.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <div>Attendance
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-sm-8">
                                <img src="{{ asset('frontend/images/ams.png') }}" class="img-fluid">
                            </div>
                            <div class="col-sm-4">
                                <div class="card-body">
                                    <div class="card-header-title font-size-lg text-capitalize mb-4">
                                        Attendense Sheet
                                    </div>

                                    <form class="form" action="{{ route('hr.attendanceFor') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="d-sm-flex">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" value="3"
                                                        name="role_id">Teacher
                                                </label>
                                            </div>
                                            <div class="form-check ml-3">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" value="4"
                                                        name="role_id">Student
                                                </label>
                                            </div>
                                        </div>
                                        <div>
                                            @error('role_id')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <button class="btn-pill btn btn-dark mt-4" name="view_submission">Proceed</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @include('hr.layouts.static_footer')

    @endsection
