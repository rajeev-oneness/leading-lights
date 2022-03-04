@extends('teacher.layouts.master')
@section('title')
    View Question
@endsection
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-book"></i>
                        </div>
                        <div>Manage Exam
                        </div>
                    </div>
                </div>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('teacher.exam.index') }}">Exam List</a></li>
                    <li class="breadcrumb-item " aria-current="page">Exam details</li>
                </ol>
            </nav>
            <div class="card mb-3">
                <div class="card-header qtitle justify-content-center">
                    Leading Lights
                </div>
                <div class="card-body">
                    {{-- <a href="{{ route('teacher.exam.index') }}" class="btn btn-primary btn-lg"><i class="fa fa-arrow-left"></i> Back</a> --}}
                    @if ($questions->count() > 0)
                        @foreach ($questions as $i => $question)
                            <h5>{{ $i + 1 }}. {{ $question->question }}</h5>
                            @if ($question->image)
                                <div class="pdf-box" style="height:100px !important;width: 200px!important">
                                    <img src="{{ asset($question->image) }}" alt=""
                                        class="img-fluid rounded  mx-auto w-100 mb-3">
                                </div>
                            @endif
                            <ol style="list-style-type: lower-alpha;">
                                @foreach ($question->optionData as $option)
                                    <li>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="ans{{ $i + 1 }}"
                                                value="{{ $option->option }}" id="" @if ($option->option === $question->answer)
                                            checked @endif>
                                            {{ $option->option }}
                                        </div>
                                    </li>
                                @endforeach
                            </ol>
                            <p class="font-weight-bold">Marks: <span>{{ $question->marks }}</span></p>
                            <hr>
                        @endforeach
                    @else
                        <h5 class="text-danger">Oops. No data found</h5>
                    @endif
            </div>
        </div>
    </div>
    @include('teacher.layouts.static_footer')
    </div>
    </div>
    </div>
@endsection
