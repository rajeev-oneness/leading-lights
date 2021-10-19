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
                            <form class="form" action="{{ route('teacher.assignExam') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="d-sm-flex align-items-center justify-content-between">
                                    <select class="form-control" id="class" name="class">
                                        <option value="" selected>Class</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->name }}" @if (old('class') == $class->name) selected @endif>
                                                {{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                    <select class="form-control" id="subject" name="subject">
                                        <option value="" selected>Subject</option>
                                        <option value="Physics" @if (old('subject') == 'Physics') selected @endif>Physics</option>
                                        <option value="Chemistry" @if (old('subject') == 'Chemistry') selected @endif>Chemistry</option>
                                        <option value="History" @if (old('subject') == 'History') selected @endif>History</option>
                                    </select>

                                </div>
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    @if ($errors->has('class'))
                                        <span style="color: red;">{{ $errors->first('class') }}</span>
                                    @endif
                                    @if ($errors->has('subject'))
                                        <span style="color: red;">{{ $errors->first('subject') }}</span>
                                    @endif
                                </div>
                                <div class="d-sm-flex align-items-center justify-content-between">
                                    <div class="d-sm-flex align-items-baseline ">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                                    class="fa fa-circle"></i></span>Exam Date</p>
                                        <input type="date" name="date" id="date" class="form-control"
                                            value="{{ old('date') }}">

                                    </div>
                                    <div class="d-sm-flex align-items-baseline ">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                                    class="fa fa-circle"></i></span>Starting Time</p>
                                        <input type="time" name="start_time" id="start_time" class="form-control"
                                            value="{{ old('start_time') }}">
                                    </div>
                                    <div class="d-sm-flex align-items-baseline ">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                                    class="fa fa-circle"></i></span>Ending time</p>
                                        <input type="time" name="end_time" id="end_time" class="form-control"
                                            value="{{ old('end_time') }}">

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
                                        <input type="date" name="result_date" id="result_date" class="form-control"
                                            value="{{ old('result_date') }}">

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
                                    Upload Quiestion Paper as a Document </div>
                                <div class="file-upload">
                                    <button class="file-upload-btn" type="button"
                                        onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
                                    <div class="image-upload-wrap">
                                        <input class="file-upload-input" id="upload_file" name="upload_file" type='file'
                                             accept="image/*" />
                                        <div class="drag-text">
                                            <h3>Drag and drop a file or select add Image</h3>
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
                                        <span style="color: red;" id="file_err">{{ $errors->first('upload_file') }}</span>
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
                                            <th>Class</th>
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
                                                <th>{{ $exam->class }}</th>
                                                <td>{{ $exam->subject }}</td>
                                                <td>{{ $exam->full_marks }}</td>
                                                <td>{{ $exam->date }}</td>
                                                <td>{{ date('H:i', strtotime($exam->start_time)) }} <span
                                                        class="text-success">to</span>
                                                    {{ date('H:i', strtotime($exam->end_time)) }}</td>
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
            $('#exam_table').DataTable();
        });
        $(document).on('change', 'input[name^="upload_file"]', function(ev) {
            var file_name = this.files[0].name;
            $('#file_err').html('');
            $("#choose_file").html(`One file chosen: <span class="text-info">${file_name}</span>`);
        });
    </script>
@endsection
