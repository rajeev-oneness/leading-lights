@extends('student.layouts.master')
@section('title')
    Exam
@endsection
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
            <div class="remain_type sticky">
                <h5>Remaining time:  <span id="remaining_time" class="badge badge-primary">{{ $exam_time }}</span></h5>
            </div>
            <div class="tabs-animation">
                {{-- It restrict user from copy,paste and cut --}}
                {{-- <section class=" " oncopy="return false;" oncut="return false;" onpaste="return false;"
                    oncontextmenu="return false;"> --}}
                    <div class="card mb-3">
                        <div class="card-header qtitle justify-content-center">
                            Leading Lights
                        </div>
                        <div class="row m-0 exam_header align-items-center">
                            <div class="col-12 col-lg-4">
                                <ul class="mb-0">
                                    <li>Date : <b>{{ date('d-M-Y',strtotime($exam->date)) }}</b> </li>
                                    <li>Student ID : <b>{{ Auth::user()->id_no }}</b></li>
                                    <li>Student Name : <b>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</b></li>
                                </ul>
                            </div>
                            <div class="col-12 col-lg-4">
                                <h5 class="card-tittle text-center">Class : <b>{{ Auth::user()->class_details->name}}</b></h5>
                                <h5 class="card-tittle text-center">Subject : <b>{{ $exam->subject_details->name}}</b></h5>
                                <h5 class="card-tittle text-center">Name of exam : <b>{{ $exam->type_of_exam}}</b></h5>
                            </div>
                            <div class="col-12 col-lg-4 text-right">
                                <ul class="mb-0">
                                <li>Total Marks : <b>{{ $exam->full_marks }}</b></li>
                                <li>Pass Marks : <b>{{ $exam->pass_marks }}</b></li>
                            </ul>
                            </div>
                        </div>
                        <!--<div>
                            <ul>
                                <li>Date: {{ date('d-M-Y',strtotime($exam->date)) }} </li>
                                <li>Student ID: {{ Auth::user()->id_no }}</li>
                                <li>Student Name: {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</li>
                            </ul>
                            <ul class="float-right">
                                <li>Total Marks: {{ $exam->full_marks }}</li>
                                <li>Pass Marks: {{ $exam->pass_marks }}</li>
                            </ul>
                        </div>-->
                        <div class="card-body">
                            <p class="text-danger"><small><b>Note:</b> All questions are compulsory.</span>
                            @if ($exam->exam_type == 1 && $exam->negative_marks == 1)
                                <span>If wrong question selected then 0.25 marks deducted</span>
                            @endif
                            </p>
                            <hr>
                            @if ($questions->count() > 0)
                                <form action="{{ route('user.exam.start', $exam->id) }}" class="exam_form" method="POST" name="exam"
                                    id="examForm">
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
                                        <div class="row">
                                            @php
                                                $stored_answer = App\Models\TempExam::where('question_id',$question->id)->where('user_id',Auth::user()->id)->first();
                                            @endphp
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="answer"><b>Answer: </b></label>
                                                    @if ($stored_answer)
                                                        <textarea name="answer{{ $key + 1 }}"  cols="3" rows="3" class="form-control" id="answer{{ $key + 1 }}">{{ $stored_answer->answer }}</textarea>
                                                    @else
                                                      <textarea name="answer{{ $key + 1 }}"  cols="3" rows="3" class="form-control" id="answer{{ $key + 1 }}"></textarea>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn save_btn" id="save_ans" value="save_ans" name="save_ans" onclick="saveAnswer({{ $exam->id }},{{ $question->id }},{{ $key + 1}})"><i class="fa fa-save"></i> Save</button>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($exam->exam_type == 3 && $question->question_type == 2)
                                            <div class="row">
                                                @php
                                                    $stored_answer = App\Models\TempExam::where('question_id',$question->id)->where('user_id',Auth::user()->id)->first();
                                                @endphp
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="answer"><b>Answer: </b></label>
                                                        @if ($stored_answer)
                                                            <textarea name="answer{{ $key + 1 }}"  cols="3" rows="3" class="form-control" id="answer{{ $key + 1 }}">{{ $stored_answer->answer }}</textarea>
                                                        @else
                                                             <textarea name="answer{{ $key + 1 }}"  cols="3" rows="3" class="form-control" id="answer{{ $key + 1 }}"></textarea>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn save_btn" id="save_ans" value="save_ans" name="save_ans" onclick="saveAnswer({{ $exam->id }},{{ $question->id }},{{ $key + 1}})"><i class="fa fa-save"></i> Save</button>
                                                </div>
                                            </div>

                                        @endif
                                        <input type="hidden" name="question_type[]" value="{{ $question->question_type }}">
                                        <p class="marks_text">Marks: <span>{{ $question->marks }}</span></p>
                                        <hr>
                                    @endforeach
                                    <div class="text-right">
                                        <input type="hidden" name="index" value="{{ $key + 1 }}">
                                        <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                                        <input type="hidden" name="is_user_submitted" value="0" id="is_user_submitted">

                                        <input type="submit" value="submit" class="btn btn-primary submit_btn btn-lg"
                                        id="btn_submit" name="btn_submit">
                                    </div>

                                </form>
                            @else
                                <h5 class="text-danger">Oops. No data found</h5>
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

        // Exam time count down
        function remainTimeCountDown(){

            var countDownDate = new Date("{{ date('M d,Y',strtotime($exam->date)) }}, {{ $exam->end_time }}").getTime();

            var x = setInterval(function() {
                var now = new Date().getTime();
                var distance = countDownDate - now;

                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById("remaining_time").innerHTML = hours + "h "
                + minutes + "m " + seconds + "s ";

                /* If the timer is up before 10 secs the alert button should pop up to click on submit.
                 If not submitted it should be considered as not attended and the student will get 0. */
                if (hours == 0 && minutes == 0 && seconds == 10) {
                    timeUpAlert();
                }

                /* There should be an alert when the time is less than a minute.*/
                if (hours == 0 && minutes == 1 && seconds == 0) {
                    oneMinuteAlert();
                }

                if (distance < 0) {
                    clearInterval(x);
                    form.submit();
                    setTimeout(() => {
                        window.location.href = "{{ route('user.exam.index') }}";
                    }, 4000);
                    document.getElementById("remaining_time").innerHTML = "EXPIRED";
                }
            }, 1000);
        }

        remainTimeCountDown();

        function timeUpAlert(){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'TIMES UP!!',
                text: `Your time is over,
                please submit your answer sheet.
                Otherwise your answer won't be reflect`,
                iconHtml: '<img src="{{ asset('img/logo.jpg') }}">',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    document.getElementById('is_user_submitted').value = "1";
                    document.getElementById('examForm').submit();
                    setTimeout(() => {
                        window.location.href = "{{ route('user.exam.index') }}";
                    }, 4000);
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'You can continue your exam :)',
                        'error'
                    )
                }
            })
        }

        function oneMinuteAlert(){
            let timerInterval
            Swal.fire({
            title: 'One minute remaining',
            html: 'Only one minute remaining',
            timer: 3000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
                }, 100)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
            }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log('I was closed by the timer')
            }
            })
        }

        // Save ans
        function saveAnswer(exam_id,question_id,index) {
            event.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "To save your answer!",
                iconHtml: '<img src="{{ asset('img/logo.jpg') }}">',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var answer = document.getElementById('answer'+index).value;
                    console.log(answer);
                    $.ajax({
                        url: "{{ route('user.exam.start.ans.save') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            answer: answer,
                            exam_id: exam_id,
                            question_id : question_id
                        },
                        dataType: 'json',
                        type: 'post',
                        success: function(response) {
                            location.reload();
                        }
                    });
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'You can continue your exam :)',
                        'error'
                    )
                }
            })
        }

        // Confirmation before submit an exam
        $('#btn_submit').on('click',function() {
            event.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "To submit your answer sheet!",
                iconHtml: '<img src="{{ asset('img/logo.jpg') }}">',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    document.getElementById('is_user_submitted').value = "1";
                    document.getElementById('examForm').submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'You can continue your exam :)',
                        'error'
                    )
                }
            })
        })
    </script>
@endsection
