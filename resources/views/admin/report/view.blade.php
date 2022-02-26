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
                        <li><a href="{{ route('admin.report.index') }}">All Student Report</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">Student Report</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <div class="table-responsive">
                    <table class="table table-hover" id="report_table">
                        <thead>
                            <tr>
                                <th>Sl. No</th>
                                <th>Student Id</th>
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
                                <tr>
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
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#report_table').DataTable({
            });
        });
    </script>
@endsection
