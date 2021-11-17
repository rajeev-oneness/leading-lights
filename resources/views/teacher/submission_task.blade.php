@extends('teacher.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-subscript"></i>
                        </div>
                        <div>Task Submission
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabs-animation">
                <div class="table-responsive">
                    <table class="table table-hover" id="task_table">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Name</th>
                                <th>Class</th>
                                <th>Subject</th>
                                <th>Student Id</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Action</th>
                                <th>Review</th>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $key => $task)
                                <tr class="bg-tr">
                                    <th>{{ $key + 1 }}</th>
                                    <td>{{ $task->name }}</td>
                                    @php
                                        if ($task->group_id) {
                                            $group_details = App\Models\Group::find($task->group_id);
                                        }
                                        if ($task->class) {
                                            $class_details = App\Models\Classes::find($task->class);
                                        }
                                        $subject_details = App\Models\Subject::find($task->subject);
                                    @endphp
                                    <td>
                                        @if ($task->class)
                                            {{ $class_details->name }} <span class="badge badge-secondary">Class</span>
                                        @else
                                            {{ $group_details->name }} <span class="badge badge-secondary">Group</span>
                                        @endif
                                    </td>
                                    <td>{{ $subject_details->name }}</td>
                                    <td>{{ $task->id_no }}</td>
                                    <td>{{ date('Y-m-d', strtotime($task->created_at)) }}</td>
                                    <td>{{ getAsiaTime24($task->created_at) }}</td>
                                    <td>
                                        <a href="{{ asset($task->upload_doc) }}" download="">
                                            <button class="btn-pill btn-transition btn btn-outline-dark"><span
                                                    class="mr-2"><i class="fa fa-download"></i></span>Download
                                                Task</button>
                                        </a>
                                    </td>
                                    <td>
                                        @if ($task->review)
                                            <span>{{ $task->review }}</span>
                                        @else
                                            <form method="POST" action="{{ route('teacher.taskReview') }}">
                                                @csrf
                                                <div class="form-group">
                                                    {{-- <label>Remarks</label> --}}
                                                    <select class="form-control" id="review{{ $task->id }}"
                                                        name="review" onchange="changeReview({{ $task->id }})">
                                                        <option value="">Please select</option>
                                                        <option value="Bad">Bad</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Very Good">Very Good</option>
                                                        <option value="Outstanding">Outstanding</option>
                                                    </select>
                                                </div>
                                            </form>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($task->comment)
                                            <span data-toggle="tooltip" data-placement="top"
                                                title="{{ $task->comment }}">{{ \Illuminate\Support\Str::limit($task->comment, 15) }}</span>
                                        @else
                                            <button
                                                class="btn-pill btn-transition btn btn-outline-dark btn-lg comment_section"
                                                data-toggle="modal" data-target=".bd-example-modal-sm" data-toggle="tooltip"
                                                title="" data-original-title="Add comment" data-id="{{ $task->id }}"><i
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
                    <input type="hidden" name="task_id" id="task_id">
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
            var task_id = $(this).data('id');
            $(".modal-body #task_id").val(task_id);
        });
        // if (comment == '') {
        //     $('#')
        // }
        function changeReview(task_id) {
            var review = $('#review' + task_id).val();
            $.ajax({
                url: "{{ route('teacher.taskReview') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    data: {
                        'review': review,
                        'task_id': task_id
                    }
                },
                dataType: 'json',
                type: 'post',
                success: function(response) {
                    location.reload();
                }
            });
        }

        function saveComment() {
            var task_id = $('#task_id').val();
            var comment = document.getElementById("comment").value;
            var baseUrl = '<?= url('') ?>';
            var url = baseUrl + '/teacher/task-comment/' + task_id;
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
