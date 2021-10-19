@extends('student.layouts.master')
@section('content')
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
            <div class="tabs-animation">
                <div class="card mb-3">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
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
                                @foreach ($home_works as $id => $home_work)
                                    <tr class="bg-tr">
                                        <td>{{ $id+1 }}</td>
                                        <td>{{ $home_work->subject }}</td>
                                        <td>{{ $home_work->submission_date }}</td>
                                        <td>{{ $home_work->submission_time }}</td>
                                        <td>
                                            @php
                                                $upload_task = App\Models\SubmitHomeTask::where('task_id',$home_work->id)->where('roll_no',Auth::user()->id_no)->first();

                                                $today_date = date('Y-m-d');
                                                $current_time = getAsiaTime24(date('Y-m-d H:i:s'));

                                                $submission_date = $home_work->submission_date;
                                                $submission_time = $home_work->submission_time;
                                            @endphp
                                            @if($submission_date == $today_date && ($current_time > $submission_time))
                                            <span class="btn-pill btn btn-danger"><i class="fa fa-dot-circle"> Expired</i> </span>
                                            @elseif (!$upload_task && $submission_date == $today_date && ($current_time <= $submission_time))
                                                <a href="{{ asset($home_work->upload_file) }}" download="">
                                                    <button class="btn-pill btn btn-primary mb-1"><i class="fas fa-download"></i>
                                                        Download Task</button>
                                                </a>
                                                <input class="btn-pill btn btn-primary" type="file" placeholder="Upload"
                                                    name="upload_doc" id="{{ $home_work->id }}">
                                                
                                                <input type="hidden" name="task_id" id="task_id{{ $home_work->id }}" value="{{ $home_work->id }}">
                                                <input type="hidden" name="subject" id="subject{{ $home_work->id }}" value="{{ $home_work->subject }}">
                                            
                                            @elseif (!$upload_task && $submission_date >= $today_date)
                                            <a href="{{ asset($home_work->upload_file) }}" download="">
                                                <button class="btn-pill btn btn-primary mb-1"><i class="fas fa-download"></i>
                                                    Download Task</button>
                                            </a>
                                            <input class="btn-pill btn btn-primary" type="file" placeholder="Upload"
                                                name="upload_doc" id="{{ $home_work->id }}">
                                            
                                            <input type="hidden" name="task_id" id="task_id{{ $home_work->id }}" value="{{ $home_work->id }}">
                                            <input type="hidden" name="subject" id="subject{{ $home_work->id }}" value="{{ $home_work->subject }}">
                                            @elseif ($upload_task)
                                            <span class="btn-pill btn btn-success"><i class="fa fa-check"></i> Submitted</span>
                                            @else
                                            <span class="btn-pill btn btn-danger"><i class="fa fa-dot-circle"> Expired</i> </span>
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
                                            <span data-toggle="tooltip" data-placement="top" title="{{ $upload_task->comment }}">{{  \Illuminate\Support\Str::limit      ($upload_task->comment,15)  }}</span>
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
        $(document).on('change', 'input[name^="upload_doc"]', function(ev) {
                let task_id = ev.target.id;
                var filedata = this.files[0];
                var imgtype = filedata.type;

                if (!(imgtype === 'application/pdf')) {
                    $('#mgs_ta').html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
                 Please select pdf file type
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>`);

                } else {
                    $('#mgs_ta').empty();

                    //upload

                    var postData = new FormData();
                    postData.append('file', this.files[0]);
                    postData.append('task_id', $("#task_id"+task_id).val())
                    postData.append('subject', $("#subject"+task_id).val())
                    console.log($("#task_id"+task_id).val(),$("#subject"+task_id).val());

                    $.ajax({
                        headers: {
                            'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                        },
                        async: true,
                        type: "post",
                        url: "{{ route('user.upload_homework') }}",
                        data: postData,
                        contentType: false,
                        processData: false,
                        success: function() {
                            location.reload();
                        }
                    });
                }
        });
    </script>
@endsection
