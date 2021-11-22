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
                            <form action="">
                            <div class="row">
                                @foreach ($available_courses as $course)
                                <div class="col-md-3">
                                    <div class="items align-items-center">
                                        <div class="pdf-text">
                                            <h4>{{ $course->title }}</h4>
                                            <p>Monthly Fees : {{ $course->monthly_fees }}</p>
                                            <input class="form-check-input" type="checkbox" value="{{ $course->monthly_fees }}" id="monthly_fees" name="monthly_fees">
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <input type="submit" value="Proceed">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('student.layouts.static_footer')
    </div>
@endsection
