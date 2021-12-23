@extends('teacher.layouts.master')
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
                  <li class="breadcrumb-item active"><a href="{{ route('teacher.studentExamSubmission') }}">Exam List</a></li>
                  <li class="breadcrumb-item " aria-current="page">Answer Sheet</li>
                </ol>
            </nav>
            <div class="card mb-3">
                <div class="card-body">
                    {{-- <a href="{{ route('teacher.exam.index') }}" class="btn btn-primary btn-lg"><i class="fa fa-arrow-left"></i> Back</a> --}}
                    <div class="card-header-title mb-4">Answer Sheet</div>
                    <form action="{{ route('teacher.studentSubmittedAnswer', [$exam_id, $user_id]) }}" method="POST"
                        name="exam">
                        @csrf
                        @foreach ($exam_details as $i => $exam)
                            <input type="hidden" name="question_id{{ $i + 1 }}" value="{{ $exam->question_id }}">
                            <input type="hidden" name="answer{{ $i + 1 }}" value="">
                            <h5>{{ $i + 1 }}. {{ $exam->question }}</h5>
                            @if ($exam->image)
                                <div class="pdf-box" style="height:100px !important;width: 200px!important">
                                    <img src="{{ asset($exam->image) }}" alt=""
                                        class="img-fluid rounded  mx-auto w-100 mb-3">
                                </div>
                            @endif
                            <p class="font-weight-bold">Marks: {{ $exam->marks }}</p>
                            <div>
                                @if ($exam->answer)
                                    <label for=""><strong>Answers</strong></label>
                                    <p>{{ $exam->answer }}</p>
                                    @if ($exam_type == 1 || ($exam_type == 3 && $exam->question_type == 1))
                                    <label for=""><strong>Right Answers</strong></label>
                                    @php
                                        $right_answer = App\Models\Question::find($exam->question_id)->answer;
                                    @endphp
                                    <p>{{ $right_answer }}</p>

                                    @endif
                                @else
                                    <p>No Answer</p>
                                @endif

                            </div>
                            @if ($exam_type == 2 || ($exam_type == 3 && $exam->question_type == 2))
                                <p class="font-weight-bold">
                                    Teacher marks: <span>{{ $exam->answer_marks }}</span>
                                </p>
                            @endif

                            @if (!$exam_result)

                            @if ($exam->answer)
                                @if ($exam->question_type == 2 || $exam->question_type == null)
                            <div class="row">
                                <div class="col-md-4">
                                   <div class="form-group">
                                       <label for="given_answer">Answer marks</label>
                                       @if ($exam->marks == "2")
                                            <select name="answer{{ $i + 1 }}" id="" class="form-control">
                                                <option value="0">0</option>
                                                <option value="0.5">0.5</option>
                                                <option value="1">1</option>
                                                <option value="1.5">1.5</option>
                                                <option value="2">2</option>
                                            </select>
                                       @endif
                                       @if ($exam->marks == "3")
                                            <select name="answer{{ $i + 1 }}" id="" class="form-control">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                       @endif
                                       @if ($exam->marks == "4")
                                            <select name="answer{{ $i + 1 }}" id="" class="form-control">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                       @endif
                                       @if ($exam->marks == "5")
                                            <select name="answer{{ $i + 1 }}" id="" class="form-control">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                       @endif
                                   </div>
                                </div>
                            </div>
                                @endif
                            @endif
                            @endif
                            @if ($exam_type == 3)
                            <input type="hidden" name="question_type[]" value="{{ $exam->question_type }}">
                            @elseif ($exam_type == 2)
                            <input type="hidden" name="question_type[]" value="">
                            @endif
                            <hr>
                        @endforeach
                        <input type="hidden" name="index" value="{{ $i + 1 }}">
                        <input type="hidden" name="exam_id" value="{{ $exam_id }}">
                        @if (!$exam_result)
                        <input type="submit" value="Submit" class="btn btn-primary btn-lg">
                        @endif
                    </form>
                </div>
            </div>
        </div>
        @include('teacher.layouts.static_footer')
    </div>
    </div>
    </div>
@endsection
