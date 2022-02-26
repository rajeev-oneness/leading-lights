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
                        <li><a href="#" class="active">Student Report</a></li>

                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Student Report</h5>
                </div>
                <div class="row">
                    <div class="card mb-3 col-lg-6">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <form class="form" action="{{ route('admin.report_details') }}" method="POST">
                                        @csrf
                                        <div class="d-sm-flex align-items-top justify-content-between">
                                            <div class="responsive-error">
                                                <select name="class" id="class" class="form-control" onclick="test()">
                                                    <option value="">Select Class/Groups</option>
                                                    @foreach ($groups as $group)
                                                        <option value="{{ $group->id . '-group' }}" class="text-info">
                                                            {{ $group->name }}</option>
                                                    @endforeach
                                                    @foreach ($classes as $class)
                                                        <option value="{{ $class->id . '-class' }}" @if (old('class') == $class->id) selected @endif>
                                                            {{ $class->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('class'))
                                                    <span style="color: red;width: 100%">{{ $errors->first('class') }}</span>
                                                @endif
                                            </div>
                                            <div class="responsive-error">
                                                <select class="form-control" id="subject" name="subject">
                                                    <option value="" selected>Subject</option>
                                                    @foreach ($subjects as $subject)
                                                        <option value="{{ $subject->id }}" @if (old('subject') == $subject->id) selected @endif>
                                                            {{ $subject->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('subject'))
                                                    <span
                                                        style="color: red;width: 100%">{{ $errors->first('subject') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- <div class="d-sm-flex align-items-center justify-content-between">
                                            @if ($errors->has('class'))
                                                <span style="color: red;">{{ $errors->first('class') }}</span>
                                            @endif
                                            @if ($errors->has('subject'))
                                                <span style="color: red;">{{ $errors->first('subject') }}</span>
                                            @endif
                                        </div> --}}
                                        <button class="btn-pill btn btn-primary mt-4" name="view_submission">Proceed</button>
                                        <a href="{{ route('admin.report_details') }}"
                                            class="btn-pill btn btn-success mt-4 float-right">View All</a>
                                    </form>
    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
