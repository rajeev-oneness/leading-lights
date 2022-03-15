@extends('teacher.layouts.master')
@section('title')
    Exam
@endsection
@section('content')
    <style>
        .popover,
        .tooltip {
            opacity: unset;
        }

    </style>
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
            <div class="card-header-title mb-4">
                History Of Exam
                <div class="float-right">
                    <a href="{{ route('teacher.exam.create') }}" class="btn-pill btn btn-dark btn-lg mb-4">Arrange Exam</a>
                </div>
            </div>
            @if (session('question_add_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('question_add_success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="table-responsive mb-5">
                <table class="table table-hover bg-table" id="exam_table">
                    <thead>
                        <tr>
                            <th>Serial no</th>
                            <th>Class/Group Name</th>
                            <th>Subject</th>
                            <th>Exam type</th>
                            <th>Full Marks</th>
                            <th>Exam Date</th>
                            <th>Exam Time</th>
                            <th>Result Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assign_exam as $i => $exam)
                            <tr class="bg-tr">
                                <td>{{ $i + 1 }}</td>
                                @php
                                    if ($exam->group_id) {
                                        $group_details = App\Models\Group::find($exam->group_id);
                                    }
                                    if ($exam->class) {
                                        $class_details = App\Models\Classes::find($exam->class);
                                    }
                                    $subject_details = App\Models\Subject::find($exam->subject);
                                @endphp
                                <td>
                                    @if ($exam->class)
                                        {{ $class_details->name }} <span class="badge badge-secondary">Class</span>
                                    @else
                                        {{ $group_details->name }} <span class="badge badge-secondary">Group</span>
                                    @endif
                                </td>
                                <td>{{ $subject_details->name }}</td>
                                <td>
                                    @if ($exam->exam_type == 1)
                                        MCQ
                                    @elseif ($exam->exam_type == 2)
                                        Descriptive
                                    @else
                                        Mixed(MCQ & Desc)
                                    @endif
                                <td>{{ $exam->full_marks }}</td>
                                <td>{{ date('d-M-Y',strtotime($exam->date)) }}</td>
                                <td>{{ date('h:i A', strtotime($exam->start_time)) }} <span
                                        class="text-success">to</span>
                                    {{ date('h:i A', strtotime($exam->end_time)) }}</td>
                                <td>{{ date('d-M-Y',strtotime($exam->result_date)) }}</td>
                                <td>
                                    @if ($exam->date >= date('Y-m-d'))
                                        @if ($exam->exam_type == 1)
                                            <span data-toggle="modal" data-target="#mcqExamModal"
                                                data-id="{{ $exam->id }}" data-full-marks="{{ $exam->full_marks }}" class="add_question_section">
                                                <a href="#"><i class="fa fa-plus mr-2" data-toggle="tooltip"
                                                        data-placement="top" title="Add Questions"></i></a>
                                            </span>

                                        @elseif ($exam->exam_type == 2)
                                            <span data-toggle="modal" data-target="#examModal"
                                                data-id="{{ $exam->id }}" class="add_question_section">
                                                <a href="#"><i class="fa fa-plus mr-2" data-toggle="tooltip"
                                                        data-placement="top" title="Add Questions"></i></a>
                                            </span>
                                        @else
                                            <span data-toggle="modal" data-target="#mixedExamModal"
                                                data-id="{{ $exam->id }}" data-total-marks="{{ $exam->total_marks }}" class="add_question_section">
                                                <a href="#"><i class="fa fa-plus mr-2" data-toggle="tooltip"
                                                        data-placement="top" title="Add Questions"></i></a>
                                            </span>
                                        @endif
                                    @endif
                                    @if ($exam->exam_type == 1)
                                        <a href="{{ route('teacher.viewMCQQuestion', $exam->id) }}"><i
                                                class="fa fa-eye mr-2" data-toggle="tooltip" data-placement="top"
                                                title="View Questions" data-toggle="modal" data-target="#examModal"></i></a>
                                    @elseif ($exam->exam_type == 2)
                                        <a href="{{ route('teacher.viewDescQuestion', $exam->id) }}"><i
                                                class="fa fa-eye mr-2" data-toggle="tooltip" data-placement="top"
                                                title="View Questions" data-toggle="modal" data-target="#examModal"></i></a>
                                    @else
                                        <a href="{{ route('teacher.viewMixedQuestion', $exam->id) }}"><i
                                                class="fa fa-eye mr-2" data-toggle="tooltip" data-placement="top"
                                                title="View Questions" data-toggle="modal" data-target="#examModal"></i></a>
                                    @endif

                                    {{-- <a href="{{ route('admin.hr.edit', $exam->id) }}"
                                        class="ml-2"><i class="fa fa-edit"></i></a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @include('teacher.layouts.static_footer')
    </div>
    </div>
    </div>
    @include('teacher.modal.exam.add_desc_question')
    @include('teacher.modal.exam.view_desc_question')

    @include('teacher.modal.exam.add_mcq_question')
    @include('teacher.modal.exam.view_mcq_question')

    @include('teacher.modal.exam.add_mixed_question')
    @include('teacher.modal.exam.question_js')
    <script>
        $('#class_name').on('click', function() {
            var class_name = $('#class_name').val();
            var after_split = class_name.split("-")[1];
            if (after_split === 'group') {
                $('.datepicker').datepicker('destroy').datepicker({
                    format: 'yyyy-mm-dd',
                    startDate: new Date(),
                    // daysOfWeekDisabled: [0]
                });
            } else {
                $('.datepicker').datepicker('destroy').datepicker({
                    format: 'yyyy-mm-dd',
                    startDate: new Date(),
                    daysOfWeekDisabled: [0]
                });
            }
        })
        setTimeout(() => {
            $('.alert-success').css('display', 'none');
            $('.alert-warning').css('display', 'none');
        }, 4000);
        $(document).ready(function() {
            $('#exam_table').DataTable();
        });
        $(document).on('change', 'input[name^="upload_file"]', function(ev) {
            var file_name = this.files[0].name;
            $('#file_err').html('');
            $("#choose_file").html(`One file chosen: <span class="text-info">${file_name}</span>`);
        });
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: new Date(),
            daysOfWeekDisabled: [0],
            autoclose: true

        });
        $('.datepicker1').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '+20d',
            daysOfWeekDisabled: [0],
            autoclose: true
        });
        $('.clockpicker').clockpicker({
            placement: 'bottom',
            align: 'right',
            donetext: 'Done',
            'default': 'now',
            // autoclose: true,
        });
    </script>
@endsection
