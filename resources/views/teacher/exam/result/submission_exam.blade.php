@extends('teacher.layouts.master')
@section('title')
    Exam Result
@endsection
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
                            <i class="fa fa-subscript"></i>
                        </div>
                        <div>Exam Submission
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabs-animation">
                @if (session('error'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-hover bg-table" id="task_table">
                        <thead>
                            <tr>
                                <th>Sl. No</th>
                                <th>Class</th>
                                <th>Subject</th>
                                <th>Exam Category</th>
                                <th>Student Id</th>
                                <th>Date</th>
                                <th>Marks</th>
                                <th>Action</th>
                                {{-- <th>Comment</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($submitted_exams_detail as $i => $exam)
                                <tr class="bg-tr">
                                    <td>{{ $i + 1 }}</td>
                                    @php
                                        $user_details = App\Models\User::find($exam->user_id);
                                        if ($exam->group_id) {
                                            $group_details = App\Models\Group::find($exam->group_id);
                                        }
                                        if ($exam->class) {
                                            $class_details = App\Models\Classes::find($exam->class);
                                        }
                                        $subject_details = App\Models\Subject::find($exam->subject);
                                        $total_marks = App\Models\Result::where('exam_id',$exam->exam_id)
                                                    ->where('total_marks','!=',null)
                                                    ->first();
                                    @endphp
                                    <td>
                                        @if ($exam->class)
                                            {{ $class_details->name }} <span class="badge badge-secondary">Class</span>
                                        @else
                                            {{ $group_details->name }} <span class="badge badge-secondary">Group</span>
                                        @endif
                                    </td>
                                    <td>{{ $subject_details->name }}</td>
                                    <td>
                                        @if ($exam->exam_type == 1)
                                            <span>MCQ</span>
                                        @elseif ($exam->exam_type == 2)
                                            <span>Descriptive</span>
                                        @else
                                            <span>Mixed(MCQ & Desc.)</span>
                                        @endif
                                    </td>

                                    <td>{{ $user_details->id_no }}</td>
                                    <td>{{ $exam->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        @if ($exam->total_marks >= 0 && $total_marks)
                                            <span>
                                                @if ($exam->pass_marks <= $exam->total_marks)
                                                    <span class="text-success">{{ $exam->total_marks }}
                                                    </span>
                                                @else
                                                    <span class="text-danger">{{ $exam->total_marks }}
                                                    </span>
                                                @endif

                                                /
                                                <span class="text-info">{{ $exam->full_marks }}</span>
                                            </span>
                                        @else
                                            <span><span class="text-danger">Not published</span> / <span
                                                    class="text-info">{{ $exam->full_marks }}</span></span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($exam->total_marks >= 0 && $total_marks)
                                            <a href="{{ route('teacher.studentSubmittedAnswer',[$exam->exam_id,$exam->user_id]) }}"><i
                                                    class="fa fa-eye mr-2" data-toggle="tooltip" data-placement="top"
                                                    title="View Answer" data-toggle="modal"
                                                    data-target="#examModal"></i></a>
                                        @else
                                            <a href="{{ route('teacher.studentSubmittedAnswer',[$exam->exam_id,$exam->user_id]) }}"><i
                                            class="fa fa-edit mr-2" data-toggle="tooltip" data-placement="top"
                                            title="Review Answer" data-toggle="modal"
                                            data-target="#examModal"></i></a>
                                        @endif
                                    </td>
                                    {{-- <td>
                                        @if ($exam->comment)
                                            <span data-toggle="tooltip" data-placement="top"
                                                title="{{ $exam->comment }}">{{ \Illuminate\Support\Str::limit($exam->comment, 15) }}</span>
                                        @else
                                            <button
                                                class="btn-pill btn-transition btn btn-outline-dark btn-lg comment_section"
                                                data-toggle="modal" data-target=".bd-example-modal-sm" data-toggle="tooltip"
                                                title="" data-original-title="Add comment" data-id="{{ $exam->id }}"><i
                                                    class="fa fa-plus"></i> Add Comment</button>
                                            <form action="{{ route('teacher.taskComment', $task->id) }}" method="POST">
                                                @csrf
                                                <input type="text" class="form-control-sm" name="comment">
                                                <button class="btn btn-success">Save</button>
                                            </form>
                                        @endif
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        @include('teacher.layouts.static_footer')
    </div>
    </div>
    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true" id="comment_box">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="exam_id" id="exam_id">
                    {{-- <form action="{{ route('teacher.taskComment',$task->id) }}" method="POST">
                    @csrf --}}
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea name="comment" cols="10" rows="3" class="form-control" id="comment"></textarea>
                        <span class="text-danger" id="err_txt"></span>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary float-right" onclick="saveComment()">Save</button>
                    </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#task_table').DataTable();
        });

        $(document).on("click", ".comment_section", function() {
            var exam_id = $(this).data('id');
            $(".modal-body #exam_id").val(exam_id);
        });

        function saveComment() {
            var exam_id = $('#exam_id').val();
            var comment = document.getElementById("comment").value;
            var baseUrl = '<?= url('') ?>';
            var url = baseUrl + '/teacher/exam-comment/' + exam_id;
            if (comment == '') {
                $('#err_txt').text('This field can\'t be empty!');
                return false;
            }
            if (comment.length > 255) {
                $('#err_txt').text('You can add comment within 255 characters');
                return false;
            }

            $.ajax({
                url: url,
                data: {
                    _token: "{{ csrf_token() }}",
                    comment: comment
                },
                dataType: 'json',
                type: 'post',
                success: function(response) {
                    location.reload();
                }
            });


        }
    </script>
@endsection
