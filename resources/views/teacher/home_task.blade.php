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
                        <div>Upload home task
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-header-title mb-4">
                                Upload home task
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form class="form" action="{{ route('teacher.uploadHomeTask') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="d-sm-flex align-items-top justify-content-between mb-4">
                                    {{-- <select class="form-control" id="class" name="class">
                                        <option value="" selected>Class</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}" @if (old('class') == $class->id) selected @endif>
                                                {{ $class->name }}</option>
                                        @endforeach
                                    </select> --}}
                                    <div class="responsive-error">
                                        <select name="class" id="class_name" class="form-control">
                                            <option value="">Select Class/Groups</option>
                                            @foreach ($groups as $group)
                                                <option value="{{ $group->id . '-group' }}" class="text-info">
                                                    {{ $group->name }}</option>
                                            @endforeach
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id . '-class' }}" @if (old('class') == $class->id) selected @endif>
                                                    {{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('class'))
                                            <span style="color: red;">{{ $errors->first('class') }}</span>
                                        @endif
                                    </div>
                                    <div class="responsive-error">
                                        <select class="form-control" id="subject" name="subject">
                                            <option value="" selected>Subject</option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}" @if (old('subject') == $subject->id) selected @endif>
                                                    {{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('subject'))
                                            <span style="color: red;">{{ $errors->first('subject') }}</span>
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="d-sm-flex align-items-center justify-content-between mb-2">
                                    @if ($errors->has('class'))
                                        <span style="color: red;">{{ $errors->first('class') }}</span>
                                    @endif
                                    @if ($errors->has('subject'))
                                        <span style="color: red;">{{ $errors->first('subject') }}</span>
                                    @endif
                                </div> --}}
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <div class="d-sm-flex align-items-baseline">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                                    class="fa fa-circle"></i></span>Submission Date</p>
                                        <input type="text" name="submission_date" id="datepicker"
                                            class="form-control datepicker" value="{{ old('submission_date') }}">

                                    </div>
                                    <div class="d-sm-flex align-items-baseline">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                                    class="fa fa-circle"></i>Submitted by</span></p>
                                        <div class="input-group">
                                            <input type="time" class="form-control"
                                                value="{{ old('submission_time') }}" name="submission_time">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                        </div>

                                    </div>

                                </div>
                                <div class="d-sm-flex align-items-center justify-content-between">
                                    @if ($errors->has('submission_date'))
                                        <span style="color: red;">{{ $errors->first('submission_date') }}</span>
                                    @endif
                                    @if ($errors->has('submission_time'))
                                        <span style="color: red;">{{ $errors->first('submission_time') }}</span>
                                    @endif
                                </div>
                                <!--  <p class="des dec"><span class="mr-2"><i class="fa fa-circle"></i></span>Set Quiestion Mannually</p>
                                                    <textarea cols="80" id="editor1" name="editor1" rows="10"></textarea> -->
                                <div class="card-header-title mb-4">
                                    Upload Quiestion Paper as a Document (Only accept pdf format)</div>
                                <div class="file-upload">
                                    <button class="file-upload-btn" type="button"
                                        onclick="$('.file-upload-input').trigger( 'click' )">Add file</button>
                                    <div class="image-upload-wrap">
                                        <input class="file-upload-input" type='file' onchange="readURL(this);"
                                            accept="image/*" name="upload_file" id="upload_file" />
                                        <div class="drag-text">
                                            <h3>Drag and drop a file or select add file</h3>
                                        </div>
                                    </div>
                                    <div class="file-upload-content">
                                        <img class="file-upload-image" src="#" alt="your image" />
                                        <div class="image-title-wrap">
                                            <button type="button" onclick="removeUpload()" class="remove-image">Remove
                                                <span class="image-title">Uploaded Image</span></button>
                                        </div>
                                    </div>
                                    @if ($errors->has('upload_file'))
                                        <span style="color: red;"
                                            id="file_err">{{ $errors->first('upload_file') }}</span>
                                    @endif
                                    <span id="choose_file"></span>
                                </div>
                                {{-- <div class="form-group col-sm-12">
                                    <div class="chiller_cb">
                                        <input id="myCheckbox" type="checkbox" checked="">
                                        <label for="myCheckbox">This is Photoshop's version of Lorem Ipsum. Proin gravida
                                            nibh
                                            Aenean sollicitudin, lorem quis bibendum auctor, nisi elit conse
                                            sagittis sem nibh id elit. </label>
                                        <span></span>
                                    </div>
                                </div> --}}
                                <button type="submit" class="btn-pill btn btn-dark mt-4" name="submit">Assign Now</button>

                            </form>

                            <div class="card-header-title mb-4 mt-4"> History Of Task </div>
                            <div class="table-responsive">
                                <table class="table table-hover bg-table" id="task_table">
                                    <thead>
                                        <tr>
                                            <th>Serial no</th>
                                            <th>Class/Group</th>
                                            <th>Subject</th>
                                            <th>Submission Date</th>
                                            <th>Submission Time</th>
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
                                                <td>{{ $task->submission_date }}</td>
                                                <td>{{ $task->submission_time }}</td>
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
            daysOfWeekDisabled: [0]
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
