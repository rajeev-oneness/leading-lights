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
            <h5>Remaining time <span class="js-timeout">{{ $exam_time }}</span></h5>
            <div class="tabs-animation">
                {{-- It restrict user from copy,paste and cut --}}
                {{-- <section class=" " oncopy="return false;" oncut="return false;" onpaste="return false;"
                    oncontextmenu="return false;"> --}}
                    <div class="card mb-3">
                        <div class="card-header justify-content-center">
                            Leading Lights
                        </div>
                        <div>
                            <h5 class="card-tittle text-center">Class: {{ $exam->class_details }}</h5>
                        </div>
                        <div class="card-body">
                            @if ($questions->count() > 0)
                                <form action="{{ route('user.exam.start', $exam->id) }}" method="POST" name="exam">
                                    @csrf
                                    @foreach ($questions as $key => $question)
                                        <input type="hidden" name="question_id{{ $key + 1 }}"
                                            value="{{ $question->id }}">
                                        <input type="hidden" name="answer{{ $key + 1 }}" value="">
                                        <h5>{{ $key + 1 }}. {{ $question->question }}</h5>
                                        @if ($question->image)
                                            <div class="pdf-box"
                                                style="height:100px !important;width: 200px!important">
                                                <img src="{{ asset($question->image) }}" alt=""
                                                    class="img-fluid rounded  mx-auto w-100 mb-3">
                                            </div>
                                        @endif
                                        @if ($exam->exam_type == 1)
                                            <ol style="list-style-type: lower-alpha;">
                                                @foreach ($question->optionData as $option)
                                                    <li><input type="radio" name="answer{{ $key + 1 }}"
                                                            value="{{ $option->option }}" id=""> {{ $option->option }}
                                                    </li>
                                                @endforeach
                                            </ol>
                                        @elseif ($exam->exam_type == 3 && $question->question_type == 1)
                                            <ol style="list-style-type: lower-alpha;">
                                                @foreach ($question->optionData as $option)
                                                    <li><input type="radio" name="answer{{ $key + 1 }}"
                                                            value="{{ $option->option }}" id=""> {{ $option->option }}
                                                    </li>
                                                @endforeach
                                            </ol>
                                        @elseif ($exam->exam_type == 2)
                                            <div class="form-group">
                                                <label for="answer"><b>Answer: </b></label>
                                                <textarea name="answer{{ $key + 1 }}" id="" cols="3" rows="3" class="form-control" id="answer"></textarea>
                                            </div>
                                        @endif
                                        @if ($exam->exam_type == 3 && $question->question_type == 2)
                                        <div class="form-group">
                                            <label for="answer"><b>Answer: </b></label>
                                            <textarea name="answer{{ $key + 1 }}" id="" cols="3" rows="3" class="form-control" id="answer"></textarea>
                                        </div>
                                        @endif
                                        <input type="hidden" name="question_type[]" value="{{ $question->question_type }}">
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
    <script type="text/javascript">
        var interval;
        var form = document.forms.exam;

        function countdown() {
            clearInterval(interval);

            interval = setInterval(function() {
                var timer = $('.js-timeout').html();
                timer = timer.split(':');
                var hours = timer[0];
                var minutes = timer[1];
                minutes -= 1;
                if (hours < 0) return;
                else if (minutes < 0 && hours != 0) {
                    hours -= 1;
                    minutes = 59;
                } else if (minutes < 10 && length.minutes != 2) minutes = '0' + minutes;

                $('.js-timeout').html(hours + ':' + minutes);

                if (hours == 0 && minutes == 0) {
                    clearInterval(interval);
                    form.submit();
                    setTimeout(() => {
                        window.location.href = "{{ route('user.exam.index') }}";
                    }, 5000);

                }
            }, 60000);
        }

        $('.js-timeout').text("{{ $exam_time }}");
        countdown();
    </script>
@endsection
