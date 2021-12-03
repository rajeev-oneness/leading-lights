@extends('student.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-graduation-cap"></i>
                        </div>
                        <div>Exam
                        </div>
                    </div>
                </div>
            </div>
            <h5>Exam time {{ $exam_time }}</h5>
            <div class="tabs-animation">
                <div class="card mb-3">
                    <div class="card-body">
                        @if ($questions->count() > 0)
                        <form action="{{ route('user.exam.start',$exam->id) }}" method="POST">
                            @csrf
                            @foreach ($questions as $key => $question)
                                <input type="hidden" name="question_id{{ $key + 1 }}" value="{{ $question->id }}">
                                <input type="hidden" name="answer{{ $key + 1 }}" value="0">
                                <h5>{{ $key + 1 }}. {{ $question->question }}</h5>
                                <ol style="list-style-type: lower-alpha;" >
                                    @foreach ($question->optionData as $option)
                                        <li><input type="radio" name="ans{{ $key + 1 }}" value="{{ $option->option }}" id=""> {{ $option->option }}</li>
                                    @endforeach
                                </ol>
                            @endforeach
                            <input type="hidden" name="index" value="{{ $key + 1 }}">
                            <input type="hidden" name="exam_id" value="{{ $exam->id }}">

                            <input type="submit" value="Submit" class="btn btn-primary btn-lg">
                        </form>
                        @else
                        <h2 class="text-danger">Oops. No data found</h2>
                        @endif
                        
                    </div>
                </div>

            </div>
        </div>
        @include('teacher.layouts.static_footer')
    </div>
@endsection
