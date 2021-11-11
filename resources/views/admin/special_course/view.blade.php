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
                        <li><a href="{{ route('admin.courses.index') }}">All Courses List</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">View course</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5>View Course</h5>
                <hr>
                <div class="row m-0 details-page">
                    <div class="col-12 pt-3 pb-3 pl-0 pr-0">
                        <h5 class="text-blue">Basic details</h5>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="title">Class Name</label>
                            <input type="text" id="title" value="{{ $course_details->title }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="teacher_id">Assigned teacher</label>
                            <input type="text" id="teacher_id"
                                value="{{ $teacher->first_name }} {{ $teacher->last_name }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="text" id="start_date" value="{{ $course_details->start_date }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="text" id="end_date" value="{{ $course_details->end_date }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="duration">Duration in days</label>
                            <input type="text" id="duration" value="{{ $course_details->duration }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="fees">Fees(INR)</label>
                            <input type="text" id="fees" value="{{ $course_details->fees }}" readonly>
                        </div>
                    </div>

                </div>
                @if ($course_details->image)
                    <div class="row m-0 details-page">
                        <div class="col-12 pt-3 pb-3 pl-0 pr-0">
                            <h5 class="text-blue">Others</h5>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="image">Cover Image</label>
                                <img src="{{ asset($course_details->image) }}" alt="" height="200" width="200">
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
