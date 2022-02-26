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
                        <li><a href="{{ route('admin.notification.index') }}">All Notification List</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">View NOTIFICATION</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5>View Notification</h5>
                <hr>
                <div class="row m-0 details-page">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" value="{{ $notification_details->title }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="text" id="date" value="{{ $notification_details->created_at ? date('d-M-y',strtotime($notification_details->created_at)) : 'N/A'}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="text" id="time" value="{{ $notification_details->created_at ? getAsiaTime24($notification_details->created_at) : 'N/A'}}" readonly>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
