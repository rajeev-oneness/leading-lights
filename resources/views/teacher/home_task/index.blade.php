@extends('teacher.layouts.master')
@section('title')
    Home Task
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
                            <i class="fa fa-upload"></i>
                        </div>
                        <div>Home task
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-header-title mb-4 mt-4">
                                History Of Task
                                <div class="float-right">
                                    <a href="{{ route('teacher.homeTask.create') }}" class="btn-pill btn btn-dark btn-lg mb-4">Arrange Home Task</a>
                                </div>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-hover bg-table" id="task_table">
                                    <thead>
                                        <tr>
                                            <th>Serial no</th>
                                            <th>Class/Group</th>
                                            <th>Subject</th>
                                            <th>Submission Date</th>
                                            <th class="text-center">Submission Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tasks as $i => $task)
                                            <tr class="bg-tr">
                                                <th>{{ $i + 1 }}</th>
                                                @php
                                                    if ($task->group_id) {
                                                        $group_details = App\Models\Group::find($task->group_id);
                                                    }
                                                    if ($task->class) {
                                                        $class_details = App\Models\Classes::find($task->class);
                                                    }
                                                    $subject_details = App\Models\Subject::find($task->subject);
                                                @endphp
                                                <td>
                                                    @if ($task->class)
                                                        {{ $class_details->name }} <span
                                                            class="badge badge-secondary">Class</span>
                                                    @else
                                                        {{ $group_details->name }} <span
                                                            class="badge badge-secondary">Group</span>
                                                    @endif
                                                </td>
                                                <td>{{ $subject_details->name }}</td>
                                                <td>{{ date('d-M-Y',strtotime($task->submission_date)) }}</td>
                                                <td>{{ date('h:i A',strtotime($task->submission_time)) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('teacher.layouts.static_footer')
    </div>
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
        $(document).ready(function() {
            $('#task_table').DataTable();
        });
        $(document).on('change', 'input[name^="upload_file"]', function(ev) {
            var file_name = this.files[0].name;
            $('#file_err').html('');
            $("#choose_file").html(`One file chosen: <span class="text-info">${file_name}</span>`);
        });
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '+2d',
            daysOfWeekDisabled: [0],
            autoclose: true
        });
        $('.clockpicker').clockpicker({
            placement: 'bottom',
            align: 'right',
            donetext: 'Done',
            'default': 'now',
            autoclose: true,
        });
    </script>
@endsection
