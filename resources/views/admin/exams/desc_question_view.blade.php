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
                    <li><a href="{{ route('admin.exams.index') }}">All exams List</a></li>
                    <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                    <li><a href="#" class="active">View exams</a></li>

                </ul>
            </div>
            @include('admin.layouts.navbar')
        </div>
        <hr>
        <div class="dashboard-body-content">
            <div class="card mb-3">
                <div class="card-header qtitle justify-content-center">
                    Leading Lights
                </div>
                <div class="card-body">
                    {{-- <a href="{{ route('teacher.exam.index') }}" class="btn
                    btn-primary btn-lg"><i class="fa fa-arrow-left"></i> Back</a> --}}
                    @if($questions->count() > 0)
                        @foreach($questions as $i => $question)
                            <h5>{{ $i + 1 }}. {{ $question->question }}</h5>
                            @if($question->image)
                                <div class="pdf-box" style="height:100px !important;width: 200px!important">
                                    <img src="{{ asset($question->image) }}" alt=""
                                        class="img-fluid rounded  mx-auto w-100 mb-3">
                                </div>
                            @endif
                            <p class="font-weight-bold">Marks: <span>{{ $question->marks }}</span></p>
                            <hr>
                        @endforeach
                    @else
                        <h5 class="text-danger">Oops. No data found</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
