@extends('teacher.layouts.master')
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
                            <i class="fa fa-book"></i>
                        </div>
                        <div>Manage Exam
                        </div>
                    </div>
                </div>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active"><a href="{{ route('teacher.exam.index') }}">Exam List</a></li>
                  <li class="breadcrumb-item " aria-current="page">Arrange Exam</li>
                </ol>
              </nav>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row m-0">
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
                                enctype="multipart/form-data" id="examForm">
                                @csrf
                                <div class="row justify-content-between m-0">
                                    {{-- <select class="form-control" id="class" name="class">
                                        <option value="" selected>Class</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}" @if (old('class') == $class->id) selected @endif>
                                                {{ $class->name }}</option>
                                        @endforeach
                                    </select> --}}
                                    <div class="col-lg-6 responsive-error">
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
                                        <span style="color: red;" id="class_err"></span>
                                        @if ($errors->has('class'))
                                            <span style="color: red;">{{ $errors->first('class') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 responsive-error">
                                        <select class="form-control" id="subject" name="subject">
                                            <option value="" selected>Subject</option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}" @if (old('subject') == $subject->id) selected @endif>
                                                    {{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                        <span style="color: red;" id="subject_err"></span>
                                        @if ($errors->has('subject'))
                                            <span style="color: red;">{{ $errors->first('subject') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-md-12">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                            class="fa fa-circle"></i></span>Name of exam<span
                                        class="text-danger">*</span></p>
                                    <input type="text" name="name_of_exam" id="name_of_exam" class="form-control"
                                        value="{{ old('name_of_exam') }}" autocomplete="off">
                                    <span style="color: red;" id="name_of_exam_err"></span>
                                    @if ($errors->has('name_of_exam'))
                                        <span style="color: red;">{{ $errors->first('name_of_exam') }}</span>
                                    @endif
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-md-6" id="type_of_exam_block">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                            class="fa fa-circle"></i></span>Type of exam<span
                                        class="text-danger">*</span></p>
                                        <select name="type_of_exam" id="type_of_exam" class="form-control">
                                            <option value="">Select Type</option>
                                            <option value="weekly">Weekly</option>
                                            <option value="monthly">Monthly</option>
                                            <option value="sessional">Sessional</option>
                                        </select>
                                        <span style="color: red;" id="exam_type_err"></span>
                                        @if ($errors->has('type_of_exam'))
                                            <span style="color: red;">{{ $errors->first('type_of_exam') }}</span>
                                        @endif
                                    </div>
                                    {{-- <div class="col-md-6" id="select_month_block">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                            class="fa fa-circle"></i></span>Select Month<span
                                        class="text-danger">*</span></p>
                                        <select name="select_month" id="select_month" class="form-control">
                                            <option value="">Select Type</option>
                                            <option value="01">January</option>
                                            <option value="02">February</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                        @if ($errors->has('select_month'))
                                            <span style="color: red;">{{ $errors->first('select_month') }}</span>
                                        @endif
                                    </div> --}}
                                    <div class="col-md-6" id="term_bock">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                            class="fa fa-circle"></i></span>Select Term<span
                                        class="text-danger">*</span></p>
                                        <select name="selected_term" id="selected_term" class="form-control">
                                            <option value="">Select Term</option>
                                            <option value="term_1">Term 1</option>
                                            <option value="term_2">Term 2</option>
                                            <option value="term_3">Term 3</option>
                                        </select>
                                        <span style="color: red;" id="term_err"></span>
                                        @if ($errors->has('selected_term'))
                                            <span style="color: red;">{{ $errors->first('type_of_exam') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row justify-content-between m-0">
                                    <div class="col-md-3">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                                    class="fa fa-circle"></i></span>Exam Date<span
                                                class="text-danger">*</span></p>
                                        <input type="text" name="date" id="exam_date" class="form-control datepicker"
                                            value="{{ old('date') }}" autocomplete="off">
                                        <span style="color: red;" id="exam_date_err"></span>
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
                                                name="start_time" id="start_time">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                        </div>
                                        <span style="color: red;" id="start_time_err"></span>
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
                                                name="end_time" id="end_time">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                        </div>
                                        <span style="color: red;" id="end_time_err"></span>
                                        @if ($errors->has('start_time'))
                                            <span style="color: red;">{{ $errors->first('start_time') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                                    class="fa fa-circle"></i></span>Exam Category<span
                                                class="text-danger">*</span></p>
                                        <select name="exam_type" id="exam-category" class="form-control">
                                            <option value="">Select Exam Category</option>
                                            <option value="1" {{ old('exam_type') == 1 ? 'selected' : '' }}>MCQ</option>
                                            <option value="2" {{ old('exam_type') == 2 ? 'selected' : '' }}>Descriptive</option>
                                            <option value="3" {{ old('exam_type') == 3 ? 'selected' : '' }}>Mixed(MCQ & Descriptive)</option>
                                        </select>
                                        <span style="color: red;" id="exam_category_err"></span>
                                        @if ($errors->has('exam_type'))
                                            <span style="color: red;">{{ $errors->first('exam_type') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row m-0 mt-0 mb-0">
                                    <div class="col-md-4">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                                    class="fa fa-circle"></i></span>Full Marks<span
                                                class="text-danger">*</span></p>
                                        <input type="number" name="full_marks" id="full_marks" class="form-control"
                                            value="{{ old('full_marks') }}" min="1">
                                        <span style="color: red;" id="full_marks_err"></span>
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
                                        <span style="color: red;" id="pass_marks_err"></span>    
                                        @if ($errors->has('pass_marks'))
                                            <span style="color: red;">{{ $errors->first('pass_marks') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 text-right">
                                    <button class="btn-pill btn btn-dark mt-4" id="create_now">Create Now</button>
                                </div>

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
         $(document).ready(function() {
            $("#select_month_block").css("display", "none");
            $("#term_bock").css("display", "none");
            
         });
        $("#type_of_exam").on("change",function(){
            var exam_type =  $("#type_of_exam").val();
            // if (exam_type == 'monthly') {
            //     $("#select_month_block").css("display", "block");
            //     $("#term_bock").css("display", "none");
            // }
            if(exam_type == 'sessional'){
                $("#select_month_block").css("display", "none");
                $("#term_bock").css("display", "block");
            }
            else{
                $("#select_month_block").css("display", "none");
                $("#term_bock").css("display", "none");
            }
        })
        $('#create_now').on('click',function(){
            event.preventDefault();
            var errorFlagOne = 0;
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "To create this exam!",
                iconHtml: '<img src="{{ asset('img/logo.jpg') }}">',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    var exam_type =  $("#type_of_exam").val();
                    var selected_term = $('#selected_term').val();
                    var class_name = $('#class_name').val();
                    var subject = $('#subject').val();
                    var name_of_exam = $('#name_of_exam').val();
                    var exam_date = $('#exam_date').val();
                    var start_time = $('#start_time').val();
                    var end_time = $('#end_time').val();
                    var exam_category = $('#exam-category').val();
                    var full_marks = $('#full_marks').val();
                    var pass_marks = $('#pass_marks').val();
                    if (class_name == '') {
                        $('#class_err').text('This field is required');
                        errorFlagOne = 1;
                    }
                    if (subject == '') {
                        $('#subject_err').text('This field is required');
                        errorFlagOne = 1;
                    }
                    if (name_of_exam == '') {
                        $('#name_of_exam_err').text('This field is required');
                        errorFlagOne = 1;
                    }
                    if (exam_date == '') {
                        $('#exam_date_err').text('This field is required');
                        errorFlagOne = 1;
                    }
                    if (start_time == '') {
                        $('#start_time_err').text('This field is required');
                        errorFlagOne = 1;
                    }
                    if (end_time == '') {
                        $('#end_time_err').text('This field is required');
                        errorFlagOne = 1;
                    }
                    if (exam_category == '') {
                        $('#exam_category_err').text('This field is required');
                        errorFlagOne = 1;
                    }
                    if (full_marks == '') {
                        $('#full_marks_err').text('This field is required');
                        errorFlagOne = 1;
                    }
                    if (pass_marks == '') {
                        $('#pass_marks_err').text('This field is required');
                        errorFlagOne = 1;
                    }
                    if (exam_type == '') {
                        $('#exam_type_err').text('This field is required');
                        errorFlagOne = 1;
                    }
                    
                    if (exam_type == 'sessional') {
                        if (selected_term == '') {
                            $('#term_err').text('This field is required');
                            $('#exam_type_err').text('');
                            errorFlagOne = 1;
                        }else{
                            $('#term_err').text('This field is required');
                        }
                    }
                    if (errorFlagOne == 1) {
                         return false;
                    } else {
                        document.getElementById('examForm').submit();
                        document.getElementById("examForm").disabled = true;
                        document.getElementById("examForm").style.cursor = 'no-drop';
                    }
                
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    // swalWithBootstrapButtons.fire(
                    //     'Cancelled',
                    //     'You can continue to create this exam :)',
                    //     'error'
                    // )
                }
            })
        });
        $('#class_name').on('click', function() {
            var class_name = $('#class_name').val();
            var after_split = class_name.split("-")[1];
            if (after_split === 'group') {
                $('.datepicker').datepicker('destroy').datepicker({
                    format: 'dd-M-yyyy',
                    startDate: new Date(),
                    autoclose: true
                    // daysOfWeekDisabled: [0]
                });
            } else {
                $('.datepicker').datepicker('destroy').datepicker({
                    format: 'dd-M-yyyy',
                    startDate: new Date(),
                    daysOfWeekDisabled: [0],
                    autoclose: true
                });
            }
        })
        setTimeout(() => {
            $('.alert-success').css('display', 'none');
            $('.alert-warning').css('display', 'none');
        }, 10000);
        $(document).ready(function() {
            $('#exam_table').DataTable();
        });
        $(document).on('change', 'input[name^="upload_file"]', function(ev) {
            var file_name = this.files[0].name;
            $('#file_err').html('');
            $("#choose_file").html(`One file chosen: <span class="text-info">${file_name}</span>`);
        });
        $('.datepicker').datepicker({
            format: 'dd-M-yyyy',
            startDate: new Date(),
            daysOfWeekDisabled: [0],
            autoclose: true
        });
        $('.datepicker1').datepicker({
            format: 'dd-M-yyyy',
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
