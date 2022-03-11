@extends('teacher.layouts.master')
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
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-header-title mb-4">
                                Manage Exam
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form class="form" action="{{ route('teacher.assignExam') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="d-sm-flex align-items-top justify-content-between mb-5">
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
                                {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    @if ($errors->has('class'))
                                        <span style="color: red;">{{ $errors->first('class') }}</span>
                                    @endif
                                    @if ($errors->has('subject'))
                                        <span style="color: red;">{{ $errors->first('subject') }}</span>
                                    @endif
                                </div> --}}
                                <div class="d-sm-flex align-items-center justify-content-between">
                                    <div class="d-sm-flex align-items-baseline ">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                                    class="fa fa-circle"></i></span>Exam Date</p>
                                        <input type="text" name="date" id="exam_date" class="form-control datepicker"
                                            value="{{ old('date') }}">

                                    </div>
                                    <div class="d-sm-flex align-items-baseline ">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                                    class="fa fa-circle"></i></span>Starting Time</p>
                                        <div class="input-group clockpicker">
                                            <input type="text" class="form-control" value="{{ old('start_time') }}"
                                                name="start_time">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-sm-flex align-items-baseline ">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                                    class="fa fa-circle"></i></span>Ending time</p>

                                        <div class="input-group clockpicker">
                                            <input type="text" class="form-control" value="{{ old('end_time') }}"
                                                name="end_time">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                        </div>

                                    </div>
                                </div>
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    @if ($errors->has('date'))
                                        <span style="color: red;">{{ $errors->first('date') }}</span>
                                    @endif
                                    @if ($errors->has('start_time'))
                                        <span style="color: red;">{{ $errors->first('start_time') }}</span>
                                    @endif
                                    @if ($errors->has('end_time'))
                                        <span style="color: red;">{{ $errors->first('end_time') }}</span>
                                    @endif
                                </div>
                                <div class="d-sm-flex align-items-center justify-content-between ">
                                    <div class="d-sm-flex align-items-baseline mr-5">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                                    class="fa fa-circle"></i></span>Full Marks</p>
                                        <input type="number" name="full_marks" id="full_marks" class="form-control"
                                            value="{{ old('full_marks') }}" min="1">

                                    </div>
                                    <div class="d-sm-flex align-items-baseline">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                                    class="fa fa-circle"></i></span>Expected Result Date</p>
                                        <input type="text" name="result_date" id="result_date"
                                            class="form-control datepicker1" value="{{ old('result_date') }}">

                                    </div>
                                </div>
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    @if ($errors->has('full_marks'))
                                        <span style="color: red;">{{ $errors->first('full_marks') }}</span>
                                    @endif
                                    @if ($errors->has('result_date'))
                                        <span style="color: red;">{{ $errors->first('result_date') }}</span>
                                    @endif
                                </div>
                                <!--  <p class="des dec"><span class="mr-2"><i class="fa fa-circle"></i></span>Set Quiestion Mannually</p>
                                        <textarea cols="80" id="editor1" name="editor1" rows="10"></textarea> -->
                                <div class="card-header-title mb-4">
                                    Upload Quiestion Paper as a Document(Only accept PDF) </div>
                                <div class="file-upload">
                                    <button class="file-upload-btn" type="button"
                                        onclick="$('.file-upload-input').trigger( 'click' )">Add File</button>
                                    <div class="image-upload-wrap">
                                        <input class="file-upload-input" id="upload_file" name="upload_file" type='file'
                                            accept="image/*" />
                                        <div class="drag-text">
                                            <h3>Drag and drop a file or select add File</h3>
                                        </div>
                                    </div>
                                    <div class="file-upload-content">
                                        <img class="file-upload-image" src="#" alt="your image" />
                                        <div class="image-title-wrap">
                                            <button type="button" onclick="removeUpload()" class="remove-image">Remove
                                                <span class="image-title">Uploaded Image</span></button>
                                        </div>
                                    </div>
                                    <span id="choose_file"></span>
                                    @if ($errors->has('upload_file'))
                                        <span style="color: red;"
                                            id="file_err">{{ $errors->first('upload_file') }}</span>
                                    @endif
                                </div>
                                <button class="btn-pill btn btn-dark mt-4">Assign Now</button>
                            </form>
                            <div class="card-header-title mb-4 mt-4"> History Of Exam </div>
                            <div class="table-responsive">
                                <table class="table table-hover bg-table" id="exam_table">
                                    <thead>
                                        <tr>
                                            <th>Serial no</th>
                                            <th>Class/Group Name</th>
                                            <th>Subject</th>
                                            <th>Full Marks</th>
                                            <th>Exam Date</th>
                                            <th>Exam Time</th>
                                            <th>Result Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($assign_exam as $i => $exam)
                                            <tr class="bg-tr">
                                                <th>{{ $i + 1 }}</th>
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
                                                        {{ $class_details->name }} <span
                                                            class="badge badge-secondary">Class</span>
                                                    @else
                                                        {{ $group_details->name }} <span
                                                            class="badge badge-secondary">Group</span>
                                                    @endif
                                                </td>
                                                <td>{{ $subject_details->name }}</td>
                                                <td>{{ $exam->full_marks }}</td>
                                                <td>{{ $exam->date }}</td>
                                                <td>{{ date('h:i A', strtotime($exam->start_time)) }} <span
                                                        class="text-success">to</span>
                                                    {{ date('h:i A', strtotime($exam->end_time)) }}</td>
                                                <td>{{ $exam->result_date }}</td>
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
        // $('#exam_date').on('changeDate', function() {
        //     $('.datepicker1').datepicker('destroy').datepicker({
        //             format: 'yyyy-mm-dd',
        //             startDate:  $('#exam_date').val() + '+20d',
        //             // daysOfWeekDisabled: [0]
        //         });
        // });
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
