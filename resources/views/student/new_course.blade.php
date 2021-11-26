@extends('student.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-upload"></i>
                        </div>
                        <div>Available Courses
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-header-title mb-4">
                                Available Courses
                            </div>
                            @if ($available_courses)
                            <form action="{{ route('user.add_courses') }}" method="post">
                                @csrf
                            <div class="row">
                                @foreach ($available_courses as $course)
                                <div class="col-md-3">
                                    <div class="items align-items-center">
                                        <div class="pdf-text">
                                            <h4>{{ $course->title }}</h4>
                                            <ul>
                                                <li><b>Monthly Fees :</b> &#8377;{{ $course->monthly_fees }}</li>
                                                <li><b>Start Date : </b>{{ $course->start_date }}</li>
                                            </ul>
                                            <input class="form-check-input" type="checkbox" value="{{ $course->id }}" id="course_id" name="course_id[]">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @endforeach
                            </div>
                            <input type="submit" value="Proceed" class="btn-pill btn btn-primary btn-lg float-right">
                            </form>
                            @else
                            <div class="col-md-3">
                                <div class="align-items-center">
                                    <span class="text-bold text-center text-capitalize">Currently No Courses Available</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('student.layouts.static_footer')
    </div>
@endsection
