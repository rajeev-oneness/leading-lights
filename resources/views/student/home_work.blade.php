@extends('student.layouts.master')
@section('content')
    <style>
        .table thead th {
            font-size: 14px !important;
        }

    </style>
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-graduation-cap"></i>
                        </div>
                        <div>Homework
                        </div>
                    </div>
                </div>
            </div>
            <h5>Leading Lights School</h5>
            <div class="tabs-animation">
                <div class="card mb-3">
                    @if (session('regular_task_upload_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('regular_task_upload_success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if ($errors->regular_task_upload_error->has('upload_doc'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $errors->regular_task_upload_error->first('upload_doc') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <span class="text-danger" id="mgs_ta"></span>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="task_table">
                                <thead>
                                    <tr>
                                        <th>Serial no</th>
                                        <th>Subject</th>
                                        <th>Submission Date</th>
                                        <th>Submission Time</th>
                                        <th>Assignment</th>
                                        <th>Answer Sheet</th>
                                        <th>Feedback</th>
                                        <th>Comment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($class_wise_home_works as $id => $home_work)
                                        <tr class="bg-tr">
                                            <td>{{ $id + 1 }}</td>
                                            @php
                                                $subject_details = App\Models\Subject::find($home_work->subject);
                                            @endphp
                                            <td>{{ $subject_details->name }}</td>
                                            <td>{{ $home_work->submission_date }}</td>
                                            <td>{{ $home_work->submission_time }}</td>
                                            <td><a href="{{ asset($home_work->upload_file) }}" download="">
                                                <button class="btn-pill btn btn-primary mb-1"><i
                                                        class="fas fa-download"></i>
                                                    Download Task</button>
                                            </a></td>
                                            <td>
                                                @php
                                                    $upload_task = App\Models\SubmitHomeTask::where('task_id', $home_work->id)
                                                        ->where('id_no', Auth::user()->id_no)
                                                        ->first();
                                                    
                                                    $today_date = date('Y-m-d');
                                                    $current_time = getAsiaTime24(date('Y-m-d H:i:s'));
                                                    
                                                    $submission_date = $home_work->submission_date;
                                                    $submission_time = $home_work->submission_time;
                                                @endphp
                                                @if ($submission_date == $today_date && $current_time > $submission_time)
                                                    <span class="btn-pill btn btn-danger"><i class="fa fa-dot-circle">
                                                            Expired</i> </span>
                                                @elseif (!$upload_task && $submission_date == $today_date &&
                                                    ($current_time
                                                    <= $submission_time))
                                                    <button type="button" class="btn-pill btn btn-primary upload-document"
                                                    data-toggle="modal" data-target="#exampleModal"
                                                    data-id="{{ $home_work->id }}"
                                                    data-subject="{{ $home_work->subject }}" data-submit-type="school_task">
                                                    Upload
                                                </button>
                                                        
                                                    @elseif (!$upload_task && $submission_date >= $today_date)
                                                        <button type="button" class="btn-pill btn btn-primary upload-document"
                                                        data-toggle="modal" data-target="#exampleModal"
                                                        data-id="{{ $home_work->id }}"
                                                        data-subject="{{ $home_work->subject }}"
                                                        data-submit-type="school_task">
                                                        Upload
                                                    </button>
                                                    @elseif ($upload_task)
                                                        <span class="btn-pill btn btn-success"><i
                                                                class="fa fa-check"></i>
                                                            Submitted</span>
                                                    @else
                                                        <span class="btn-pill btn btn-danger"><i class="fa fa-dot-circle">
                                                                Expired</i> </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($upload_task && $upload_task->review)
                                                    <span> {{ $upload_task->review }}</span>
                                                @else
                                                    <span>N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($upload_task && $upload_task->comment)
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="{{ $upload_task->comment }}">{{ \Illuminate\Support\Str::limit($upload_task->comment, 15) }}</span>
                                                @else
                                                    <span>N/A</span>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <h5>Leading Lights Coaching</h5>
            <div class="tabs-animation">
                <div class="card mb-3">
                    @if (session('special_task_upload_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('special_task_upload_success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if ($errors->special_task_upload_error->has('upload_doc'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $errors->special_task_upload_error->first('upload_doc') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <span class="text-danger" id="mgs_ta"></span>
                    @error('upload_doc')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="task_table1">
                                <thead>
                                    <tr>
                                        <th>Serial no</th>
                                        <th>Group Name</th>
                                        <th>Subject</th>
                                        <th>Submission Date</th>
                                        <th>Submission Time</th>
                                        <th>Assignment</th>
                                        <th>Answer sheet</th>
                                        <th>Feedback</th>
                                        <th>Comment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($group_wise_home_works as $id => $home_work)
                                        <tr class="bg-tr">
                                            <td>{{ $id + 1 }}</td>
                                            @php
                                                $group_details = App\Models\Group::find($home_work->group_id);
                                                $subject_details = App\Models\Subject::find($home_work->subject);
                                            @endphp
                                            <td><span class="badge badge-info">{{ $group_details->name }}</span></td>
                                            <td>{{ $subject_details->name }}</td>
                                            <td>{{ $home_work->submission_date }}</td>
                                            <td>{{ $home_work->submission_time }}</td>
                                            <td><a href="{{ asset($home_work->upload_file) }}" download="">
                                                    <button class="btn-pill btn btn-primary mb-1"><i
                                                            class="fas fa-download"></i>
                                                        Download</button>
                                                </a></td>
                                            <td>
                                                @php
                                                    $upload_task = App\Models\SubmitHomeTask::where('task_id', $home_work->id)
                                                        ->where('id_no', Auth::user()->id_no)
                                                        ->first();
                                                    
                                                    $today_date = date('Y-m-d');
                                                    $current_time = getAsiaTime24(date('Y-m-d H:i:s'));
                                                    
                                                    $submission_date = $home_work->submission_date;
                                                    $submission_time = $home_work->submission_time;
                                                @endphp
                                                @if ($submission_date == $today_date && $current_time > $submission_time)
                                                    <span class="btn-pill btn btn-danger"><i class="fa fa-dot-circle">
                                                            Expired</i> </span>
                                                @elseif (!$upload_task && $submission_date == $today_date &&
                                                    ($current_time
                                                    <= $submission_time)) <button type="button"
                                                        class="btn-pill btn btn-primary upload-document" data-toggle="modal"
                                                        data-target="#exampleModal" data-id="{{ $home_work->id }}"
                                                        data-subject="{{ $home_work->subject }}" data-submit-type="special_task">
                                                        Upload
                                                        </button>
                                                    @elseif (!$upload_task && $submission_date >= $today_date)
                                                        <button type="button" class="btn-pill btn btn-primary upload-document"
                                                            data-toggle="modal" data-target="#exampleModal"
                                                            data-id="{{ $home_work->id }}"
                                                            data-subject="{{ $home_work->subject }}"
                                                            data-submit-type="special_task">
                                                            Upload
                                                        </button>
                                                    @elseif ($upload_task)
                                                        <span class="btn-pill btn btn-success"><i
                                                                class="fa fa-check"></i>
                                                            Submitted</span>
                                                    @else
                                                        <span class="btn-pill btn btn-danger"><i class="fa fa-dot-circle">
                                                                Expired</i> </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($upload_task && $upload_task->review)
                                                    <span> {{ $upload_task->review }}</span>
                                                @else
                                                    <span>N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($upload_task && $upload_task->comment)
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="{{ $upload_task->comment }}">{{ \Illuminate\Support\Str::limit($upload_task->comment, 15) }}</span>
                                                @else
                                                    <span>N/A</span>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        @include('student.layouts.static_footer')
    </div>
    </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload answer sheet(PDF only)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="documentUploadForm" action="{{ route('user.upload_homework') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="task_id" id="task_id">
                        <input type="hidden" name="subject" id="subject">
                        <input type="hidden" name="submit_btn" id="submit_btn">
                        <div class="file-upload">
                            <button class="file-upload-btn" type="button"
                                onclick="$('.file-upload-input').trigger( 'click' )">Add File</button>
                            {{-- <button class="file-upload-btn" type="button">Add Image</button> --}}

                            <div class="image-upload-wrap">
                                <input class="file-upload-input" type='file' accept="pdf/*" id="img_upload"
                                    name="upload_file" />
                                <div class="drag-text">
                                    <h3>Drag and drop a file or select add file</h3>
                                </div>
                            </div>
                            @if ($errors->has('upload_file'))
                                <span style="color: red;" id="file_err">{{ $errors->first('upload_file') }}</span>
                            @endif
                            <span id="choose_file"></span>
                            <div class="file_error" style="color : red;">Please Fill This field.
                            </div>
                        </div>
                        {{-- <button type="submit" class="btn-pill btn btn-dark mt-4" name="submit_btn" value="special_task"
                            id="button_submit">Submit</button> --}}

                        <button type="submit" class="btn-pill btn btn-dark float-right" id="button_submit" value="special_task"
                            name="submit_btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#task_table').DataTable();
            $('#task_table1').DataTable();
            var validated = false;
            $('.file_error').hide();
        });
        $(document).on('change', 'input[name^="upload_file"]', function(ev) {
            var file_name = this.files[0].name;
            $('#file_err').html('');
            $("#choose_file").html(`One file chosen: <span class="text-info">${file_name}</span>`);
        });
        setTimeout(() => {
            $('.alert-danger').css('display', 'none');
            $('.alert-success').css('display', 'none');
        }, 4000);

        $(document).on("click", ".upload-document", function() {
            var task_id = $(this).data('id');
            var subject = $(this).data('subject');
            var submit_type = $(this).data('submit-type');
            $(".modal-body #task_id").val(task_id);
            $(".modal-body #subject").val(subject);
            $(".modal-body #submit_btn").val(submit_type);
        });

        $('#button_submit').on('click', function(e) {
            e.preventDefault();
            var errorFlagOne = 0;

            var task_id = $('#task_id').val();
            console.log(task_id);

            var upload_file = $('[name="upload_file"]').val();

            if (!upload_file) {
                $('.file_error').fadeIn(100);
                errorFlagOne = 1;
            } else {
                $('.file_error').fadeOut(100);
            }

            var allowedExtensions = /(\.pdf)$/i;
            if (!allowedExtensions.exec(upload_file) && upload_file != '') {
                $('.file_error').html(
                    'Please upload file having pdf extensions').fadeIn(100);
                errorFlagOne = 1;
            }

            if (errorFlagOne == 1) {
                return false;
            } else {
                $("#documentUploadForm").submit();
            }
        });
    </script>
@endsection
