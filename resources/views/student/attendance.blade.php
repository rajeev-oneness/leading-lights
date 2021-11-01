@extends('student.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <div>Attendance
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-header-title mb-4">
                               Attendance Date
                            </div>
                            <form class="form" action="{{ route('user.attendance') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="d-sm-flex align-items-center justify-content-between">
                                    <div class="d-sm-flex align-items-baseline">
                                        <p class="des  mr-2"><span class="mr-2"><i
                                                    class="fa fa-circle"></i></span>Attendance  Date</p>
                                        <input type="date" name="date" id="date"
                                            class="form-control" value="{{ $date ?? old('date') }}">
                                    </div>
                                </div>
                                <div class="d-sm-flex align-items-center justify-content-between mb-2">
                                    @if ($errors->has('date'))
                                        <span style="color: red;">{{ $errors->first('date') }}</span>
                                    @endif
                                    {{-- @if ($errors->has('end_date'))
                                        <span style="color: red;">{{ $errors->first('end_date') }}</span>
                                    @endif --}}
                                </div>
                                <button type="submit" class="btn-pill btn btn-dark mt-4" name="attendance">Proceed</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                
                <!--   <div class="col-lg-5 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="calendar-bg-events"></div>
                        </div>
                    </div>
                    <div class="card bg-holidday">
                        <div class="card-body">
                            <div class="card-header-title font-size-lg text-capitalize mb-3 font-weight-bold">
                                Holiday Lest
                            </div>
                            <div class="d-sm-flex">
                                <img src="images/holiday.png" class="img-fluid mx-auto d-block">
                                <div class="durga">
                                    <img src="images/durga.png" class="img-fluid mx-auto d-block">
                                    <h5>Oct: 25, 26, 27</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="col-lg-12 col-sm-12">
                    <div class="tab-content">
                        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-hover bg-table" id="attendance_table">
                                        <thead>
                                            <tr>
                                                <th>Sl. No</th>
                                                <th>Date</th>
                                                {{-- <th>Start Time</th> --}}
                                               {{--  <th>End Time</th> --}}
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($checked_attendance))
                                            @foreach ($checked_attendance as $i => $attendance)
                                            <tr class="bg-tr">
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $attendance->date }}</td>
                                                {{-- <td>{{ $attendance->first_login_time }}</td> --}}
                                                {{-- <td>{{ $attendance->last_login_time }}</td> --}}
                                                <td>
                                                    <!-- <button class="btn-pill btn btn-dark btn-lg">Submit</button> -->
                                                    <span class="mr-2"><i
                                                            class="fa fa-check-circle text-success"></i></span>PRESENT
                                                    {{-- <button class="btn-pill btn-transition btn btn-outline-dark btn-lg comment_section"
                                                        data-toggle="modal" data-target=".bd-example-modal-sm"
                                                        data-toggle="tooltip" title=""
                                                        data-original-title="Attach Proper Reason" data-id="{{ $attendance->id }}">Not Join !</button> --}}
                                                </td>
                                            </tr>
                                            @endforeach 
                                            @else
                                            <tr>
                                                <td>{{ $date }}</td>
                                                <td>N/A</td>
                                                {{-- <td>{{ $first_login_time }}</td>
                                                <td>{{ $last_login_time }}</td> --}}
                                                <td>
                                                    <span class="mr-2"><i
                                                        class="fa fa-check-circle text-danger"></i></span>ABSENT
                                                </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('student.layouts.static_footer')
    </div>
</div>
</div>
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Please attach your proper reason</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="attendance_id" id="attendance_id">
            <textarea name="comment" id="comment" cols="3" rows="3" class="form-control"></textarea>
            <span class="text-danger" id="err_txt"></span>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="addComment()">Save</button>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        $('#attendance_table').DataTable();
    });
    $(document).on("click", ".comment_section", function() {
            var attendance_id = $(this).data('id');
            $(".modal-body #attendance_id").val(attendance_id);
        });
            function addComment() {
            var attendance_id = $('#attendance_id').val();
            var comment = document.getElementById("comment").value;
            if (comment == '') {
                $('#err_txt').text('This field can\'t be empty!');
                return false;
            }
            if (comment.length > 255) {
                $('#err_txt').text('You can add comment within 255 characters');
                return false;
            }
            $.ajax({
                url: "{{ route('teacher.attendance') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    comment: comment,
                    attendance_id: attendance_id
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
