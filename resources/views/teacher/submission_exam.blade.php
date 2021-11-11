@extends('teacher.layouts.master')
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
                <table class="table table-hover" id="task_table">
                    <thead>
                        <tr>
                            <th>Sl. No</th>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Subject</th>
                            <th>Student Id</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Action</th>
                            <th>Marks</th>
                            <th>Full Marks</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($submitted_exams_detail as $i => $exam)
                            <tr class="bg-tr">
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $exam->name }}</td>
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
                                <td>{{ $exam->id_no }}</td>
                                <td>{{ $exam->created_at->format('d-m-Y') }}</td>
                                <td>{{ getAsiaTime24($exam->created_at) }}</td>
                                <td>
                                    <a href="{{ asset($exam->upload_doc) }}" download="">
                                        <button class="btn-pill btn-transition btn btn-outline-dark"><span
                                                class="mr-2"><i class="fa fa-download"></i></span>Download
                                            Task</button>
                                    </a>
                                </td>
                                <td>
                                    @if ($exam->marks)
                                        <span>{{ $exam->marks }}</span>
                                    @else
                                        <form method="POST" action="{{ route('teacher.examMarks', $exam->id) }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="number" name="marks" id="marks" class="form-control">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="fa fa-check"></i></button>
                                            </div>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    {{ $exam->full_marks }}
                                </td>
                                <td>
                                    @if ($exam->comment)
                                        <span data-toggle="tooltip" data-placement="top"
                                            title="{{ $exam->comment }}">{{ \Illuminate\Support\Str::limit($exam->comment, 15) }}</span>
                                    @else
                                        <button class="btn-pill btn-transition btn btn-outline-dark btn-lg comment_section"
                                            data-toggle="modal" data-target=".bd-example-modal-sm" data-toggle="tooltip"
                                            title="" data-original-title="Add comment" data-id="{{ $exam->id }}"><i
                                                class="fa fa-plus"></i> Add Comment</button>
                                        {{-- <form action="{{ route('teacher.taskComment',$task->id) }}" method="POST">
                                    @csrf
                                    <input type="text" class="form-control-sm" name="comment">
                                    <button class="btn btn-success">Save</button>
                                </form> --}}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

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
