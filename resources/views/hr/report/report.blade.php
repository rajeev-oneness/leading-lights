@extends('hr.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-download"></i>
                        </div>
                        <div>Student Reports
                        </div>
                    </div>
                </div>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('hr.student_report') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Report Details</li>
                </ol>
            </nav>
            <div class="table-responsive">
                <table class="table table-hover bg-table" id="task_table">
                    <thead>
                        <tr>
                            <th>Sl. No</th>
                            <th>Student Id</th>
                            <th>Teacher Name</th>
                            <th>Class</th>
                            <th>Subject</th>
                            <th>Exam Category</th>
                            <th>Date</th>
                            <th>Marks</th>
                            <th>Result Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($submitted_exams_detail as $i => $exam)
                            <tr class="bg-tr">
                                <td>{{ $i + 1 }}</td>
                                @php
                                    $user_details = App\Models\User::find($exam->user_id);
                                    if ($exam->group_id) {
                                        $group_details = App\Models\Group::find($exam->group_id);
                                    }
                                    if ($exam->class) {
                                        $class_details = App\Models\Classes::find($exam->class);
                                    }
                                    $subject_details = App\Models\Subject::find($exam->subject);
                                    $total_marks = App\Models\Result::where('exam_id', $exam->exam_id)
                                        ->where('total_marks', '!=', null)
                                        ->first();
                                @endphp
                                <td>{{ $user_details->id_no }}</td>
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
                                        <span>MCQ</span>
                                    @elseif ($exam->exam_type == 2)
                                        <span>Descriptive</span>
                                    @else
                                        <span>Mixed(MCQ & Desc.)</span>
                                    @endif
                                </td>
                                <td>{{ $exam->created_at->format('d-m-Y') }}</td>
                                <td>
                                    @if ($exam->total_marks >= 0 && $total_marks)
                                        <span>
                                            @if ($exam->pass_marks <= $exam->total_marks)
                                                <span class="text-success">{{ $exam->total_marks }}
                                                </span>
                                            @else
                                                <span class="text-danger">{{ $exam->total_marks }}
                                                </span>
                                            @endif

                                            /
                                            <span class="text-info">{{ $exam->full_marks }}</span>
                                        </span>
                                    @else
                                        <span><span class="text-danger">Not published</span> / <span
                                                class="text-info">{{ $exam->full_marks }}</span></span>
                                    @endif
                                </td>
                                <td>
                                    {{ $exam->result_date }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="app-wrapper-footer">
            <div class="app-footer">
                <div class="app-footer__inner">
                    <div class="app-footer-right">
                        <ul class="header-megamenu nav">
                            <li class="nav-item">
                                <a class="nav-link">
                                    Copyright &copy; 2021 | All Right Reserved
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#task_table').DataTable();
        });
    </script>
@endsection
