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
                        {{-- <li><a href="dashboard.html">Home</a></li> --}}
                        {{-- <li class="text-white"><i class="fa fa-chevron-right"></i></li> --}}
                        <li><a href="{{ route('admin.dashboard') }}" class="active">Dashboard</a></li>

                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="search-box-container">
                        <!-- <div class="form-group search-box top-search-bar"> -->
                        <!-- <input type="text" name="search-box"  placeholder="Search" -->
                        <!-- > -->
                        <!-- <button type="submit"> -->
                        <!-- <i class="fa fa-search"></i> -->
                        <!-- </button> -->
                        <!-- </div> -->
                        <div class="notification">
                            <button class="notification-button">
                                <i class="fa fa-bell"></i>
                                <span class="badge-number">0</span>
                            </button>
                            <div class="user-wrapper mx-3">
                                <img src="{{ asset('img/user.png') }}" class="img-fluid user-img">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <hr>
            <div class="dashboard-body-content-upper p-0">
                <div class="row m-0">
                    <div class="col-12 col-md-3 mb-3">
                        <div class="card shadow-sm border-0">
                            <div class="card-body gpcVCf">
                                <div class="icon-sec w-25">
                                    <img src="{{ asset('img/Total-Customers.png') }}">
                                </div>
                                <div class="text-sec">
                                    <h3>{{ $teachers_count }}<span>Total Teachers</span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <div class="card shadow-sm border-0">
                            <div class="card-body gpcVCf">
                                <div class="icon-sec w-25">
                                    <img src="{{ asset('img/new-Customers.png') }}">
                                </div>
                                <div class="text-sec">
                                    <h3>{{ $students_count }} <span>Total Students</span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @endsection
