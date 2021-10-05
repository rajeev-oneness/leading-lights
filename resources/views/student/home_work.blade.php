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
                    @error('upload_doc')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="card-body">
                        <table class="table table-hover" id="task_table">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Submission Date</th>
                                    <th>Submission Time</th>
                                    <th>Action</th>
                                    <th>Feedback</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($home_works as $home_work)
                                    <tr class="bg-tr">
                                        <td>{{ $home_work->subject }}</td>
                                        <td>{{ $home_work->submission_date }}</td>
                                        <td>{{ $home_work->submission_time }}</td>
                                        <td>
                                            <a href="{{ asset($home_work->upload_file) }}" download="">
                                                <button class="btn-pill btn btn-primary mb-1"><i class="fas fa-download"></i>
                                                    Download Task</button>
                                            </a>
                                            <form action="{{ route('user.upload_homework') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input class="btn-pill btn btn-primary" type="file" placeholder="Upload"
                                                    name="upload_doc">
                                                <input type="hidden" name="subject" value="{{ $home_work->subject }}">
                                                <input type="hidden" name="submission_date" value="{{ $home_work->submission_date }}">
                                                <input type="hidden" name="submission_time" value="{{ $home_work->submission_time }}">
                                                <button class="btn-pill btn btn-primary" type="submit">Submit task</button>
                                            </form>
                                        </td>
                                        <?php 
                                            $teacher_review = \App\Models\SubmitHomeTask::where('roll_no',Auth::user()->id_no)->where('subject', $home_work->subject)->where('class',$home_work->class)->where('submission_date',$home_work->submission_date)->where('submission_time',$home_work->submission_time)->first();
                                        ?>
                                        <td> 
                                            @if ($teacher_review && $teacher_review->review)
                                            <span> {{ $teacher_review->review }}</span>
                                            @else
                                                <span>N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($teacher_review && $teacher_review->comment)
                                            <span data-toggle="tooltip" data-placement="top" title="{{ $teacher_review->comment }}">{{  \Illuminate\Support\Str::limit      ($teacher_review->comment,15)  }}</span>
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
    </script>
@endsection
