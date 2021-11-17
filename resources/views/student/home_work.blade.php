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
            <h5>Regular Homework</h5>
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
                                        <th>Action</th>
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
                                                    <= $submission_time)) <form
                                                        action="{{ route('user.upload_homework') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <a href="{{ asset($home_work->upload_file) }}" download="">
                                                            <button class="btn-pill btn btn-primary mb-1"><i
                                                                    class="fas fa-download"></i>
                                                                Download Task</button>
                                                        </a>
                                                        <input class="btn-pill btn btn-primary" type="file"
                                                            placeholder="Upload" name="upload_doc"
                                                            id="{{ $home_work->id }}">


                                                        <input type="hidden" name="task_id"
                                                            id="task_id{{ $home_work->id }}"
                                                            value="{{ $home_work->id }}">
                                                        <input type="hidden" name="subject"
                                                            id="subject{{ $home_work->id }}"
                                                            value="{{ $home_work->subject }}">
                                                        <button type="submit" class="btn btn-primary" id="upload_doc"
                                                            value="regular_task" name="submit_btn">Submit</button>
                                                        </form>
                                                    @elseif (!$upload_task && $submission_date >= $today_date)
                                                        <a href="{{ asset($home_work->upload_file) }}" download="">
                                                            <button class="btn-pill btn btn-primary mb-1"><i
                                                                    class="fas fa-download"></i>
                                                                Download Task</button>
                                                        </a>
                                                        <form action="{{ route('user.upload_homework') }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input class="btn-pill btn btn-primary" type="file"
                                                                placeholder="Upload" name="upload_doc"
                                                                id="{{ $home_work->id }}">
                                                            <input type="hidden" name="task_id"
                                                                id="task_id{{ $home_work->id }}"
                                                                value="{{ $home_work->id }}">
                                                            <input type="hidden" name="subject"
                                                                id="subject{{ $home_work->id }}"
                                                                value="{{ $home_work->subject }}">
                                                            <button type="submit" class="btn btn-primary" id="upload_doc"
                                                                value="regular_task" name="submit_btn">Submit</button>
                                                        </form>
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
            <h5>Group Wise Homework</h5>
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
                                        <th>Action</th>
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
                                                    <= $submission_time)) <form
                                                        action="{{ route('user.upload_homework') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <a href="{{ asset($home_work->upload_file) }}" download="">
                                                            <button class="btn-pill btn btn-primary mb-1"><i
                                                                    class="fas fa-download"></i>
                                                                Download Task</button>
                                                        </a>
                                                        <input class="btn-pill btn btn-primary" type="file"
                                                            placeholder="Upload" name="upload_doc"
                                                            id="{{ $home_work->id }}">

                                                        <input type="hidden" name="task_id"
                                                            id="task_id{{ $home_work->id }}"
                                                            value="{{ $home_work->id }}">
                                                        <input type="hidden" name="subject"
                                                            id="subject{{ $home_work->id }}"
                                                            value="{{ $home_work->subject }}">
                                                        <button type="submit" class="btn btn-primary" id="upload_doc"
                                                            value="special_task" name="submit_btn">Submit</button>
                                                        </form>
                                                    @elseif (!$upload_task && $submission_date >= $today_date)
                                                        <a href="{{ asset($home_work->upload_file) }}" download="">
                                                            <button class="btn-pill btn btn-primary mb-1"><i
                                                                    class="fas fa-download"></i>
                                                                Download Task</button>
                                                        </a>
                                                        <form action="{{ route('user.upload_homework') }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input class="btn-pill btn btn-primary" type="file"
                                                                placeholder="Upload" name="upload_doc"
                                                                id="{{ $home_work->id }}">

                                                            <input type="hidden" name="task_id"
                                                                id="task_id{{ $home_work->id }}"
                                                                value="{{ $home_work->id }}">
                                                            <input type="hidden" name="subject"
                                                                id="subject{{ $home_work->id }}"
                                                                value="{{ $home_work->subject }}">
                                                            <button type="submit" class="btn btn-primary" id="upload_doc"
                                                                value="special_task" name="submit_btn">Submit</button>
                                                        </form>
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
        @include('teacher.layouts.static_footer')
    </div>
    <script>
        $(document).ready(function() {
            $('#task_table').DataTable();
            $('#task_table1').DataTable();
        });
        setTimeout(() => {
            $('.alert-danger').css('display', 'none');
            $('.alert-success').css('display', 'none');
        }, 4000);
        // $('#upload_doc').on('click', function(ev) {
        //         let task_id = $(ev.target).prev().prev().id;
        //         console.log(task_id);
        //         var filedata = this.files[0];
        //         var imgtype = filedata.type;

        //         if (!(imgtype === 'application/pdf')) {
        //             $('#mgs_ta').html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //          Please select pdf file type
    //          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //              <span aria-hidden="true">&times;</span>
    //          </button>
    //      </div>`);

        //         } else {
        //             $('#mgs_ta').empty();

        //             //upload

        //             // var postData = new FormData();
        //             // postData.append('file', this.files[0]);
        //             // postData.append('task_id', $("#task_id"+task_id).val())
        //             // postData.append('subject', $("#subject"+task_id).val())
        //             // console.log($("#task_id"+task_id).val(),$("#subject"+task_id).val());

        //             // $.ajax({
        //             //     headers: {
        //             //         'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
        //             //     },
        //             //     async: true,
        //             //     type: "post",
        //             //     url: "{{ route('user.upload_homework') }}",
        //             //     data: postData,
        //             //     contentType: false,
        //             //     processData: false,
        //             //     success: function() {
        //             //         location.reload();
        //             //     }
        //             // });
        //         }
        // });
    </script>
@endsection
