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
            <div class="row m-0 dashboard-content-header">
                <div class="col-md-6">     
                    <ul class="breadcrumb p-0">
                        <li><a href="{{ route('teacher.exam.index') }}">Exam List</a></li>
                        <li class="text-info"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#">Arrange Exam</a></li>
                    </ul>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-header-title mb-4">
                                Arrange Exam
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
                            <form class="form" action="{{ route('teacher.exam.store') }}" method="POST"
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
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-md-3">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                                    class="fa fa-circle"></i></span>Exam Date<span
                                                class="text-danger">*</span></p>
                                        <input type="text" name="date" id="exam_date" class="form-control datepicker"
                                            value="{{ old('date') }}" autocomplete="off">
                                        @if ($errors->has('date'))
                                            <span style="color: red;">{{ $errors->first('date') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                                    class="fa fa-circle"></i></span>Start Time<span
                                                class="text-danger">*</span></p>
                                        <div class="input-group">
                                            <input type="time" class="form-control" value="{{ old('start_time') }}"
                                                name="start_time">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                        </div>
                                        @if ($errors->has('start_time'))
                                            <span style="color: red;">{{ $errors->first('start_time') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                                    class="fa fa-circle"></i></span>End time<span
                                                class="text-danger">*</span></p>

                                        <div class="input-group">
                                            <input type="time" class="form-control" value="{{ old('end_time') }}"
                                                name="end_time">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                        </div>
                                        @if ($errors->has('start_time'))
                                            <span style="color: red;">{{ $errors->first('start_time') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                                    class="fa fa-circle"></i></span>Exam Type<span
                                                class="text-danger">*</span></p>
                                        <select name="exam_type" id="exam-type" class="form-control">
                                            <option value="">Select Exam Type</option>
                                            <option value="1">MCQ</option>
                                            <option value="2">Descriptive</option>
                                            <option value="3">Mixed(MCQ & Descriptive)</option>
                                        </select>
                                        @if ($errors->has('exam_type'))
                                            <span style="color: red;">{{ $errors->first('exam_type') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-3 mb-3">
                                    <div class="col-md-4">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                                    class="fa fa-circle"></i></span>Full Marks<span
                                                class="text-danger">*</span></p>
                                        <input type="number" name="full_marks" id="full_marks" class="form-control"
                                            value="{{ old('full_marks') }}" min="1">
                                        @if ($errors->has('full_marks'))
                                            <span style="color: red;">{{ $errors->first('full_marks') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                                    class="fa fa-circle"></i></span>Negative Marks<span
                                                class="text-danger">*</span></p>
                                        <select name="negative_marks" id="negative_marks" class="form-control">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                        @if ($errors->has('negative_marks'))
                                            <span style="color: red;">{{ $errors->first('negative_marks') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                                    class="fa fa-circle"></i></span>Pass Marks<span
                                                class="text-danger">*</span></p>
                                        <input type="text" name="pass_marks" id="pass_marks" class="form-control"
                                            value="{{ old('pass_marks') }}">
                                        @if ($errors->has('pass_marks'))
                                            <span style="color: red;">{{ $errors->first('pass_marks') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <!--  <p class="des dec"><span class="mr-2"><i class="fa fa-circle"></i></span>Set Quiestion Mannually</p>
                                                            <textarea cols="80" id="editor1" name="editor1" rows="10"></textarea> -->
                                {{-- <div class="card-header-title mb-4">
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
                                </div> --}}
                                <button class="btn-pill btn btn-dark mt-4">Assign Now</button>
                            </form>
                        </div>
                    </div>
                </div>
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
            daysOfWeekDisabled: [0]
        });
        $('.datepicker1').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '+20d',
            daysOfWeekDisabled: [0]
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
