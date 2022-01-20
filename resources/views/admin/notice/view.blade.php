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
                        <li><a href="{{ route('admin.notice.index') }}">All News</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">View news</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5>View Notice</h5>
                <hr>
                    <div class="row m-0 details-page">
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                {{-- <label for="name">Holiday Name</label> --}}
                                 <label for="title" class="font-weight-bold">Title</label>
                                <div>
                                    {{ $notice->title }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="desc" class="font-weight-bold">Description</label>
                               <div>
                                   {!! $notice->desc !!}
                               </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
