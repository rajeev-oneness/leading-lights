@extends('hr.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <div>Student Attendance
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{ route('hr.attendance') }}">Home</a></li>
                          {{-- <li class="breadcrumb-item"><a href="{{ route('hr.attendanceDate') }}">Teacher List</a></li> --}}
                          <li class="breadcrumb-item active" aria-current="page">Attendance</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="card mb-3 col-lg-6">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-header-title mb-4">
                                    Attendance Date Wise
                                </div>
                                <form class="form" action="{{ route('hr.studentAttendanceDetails') }}" method="POST" autocomplete="off">
                                    @csrf
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <div class="d-sm-flex align-items-baseline">
                                            <p class="des  mr-2"><span class="mr-2"><i
                                                        class="fa fa-circle"></i></span>Attendance Date</p>
                                            @if (isset($specific_attendance))
                                                    <input type="text" name="date" id="date" class="form-control datepicker"
                                                        value="{{ old('date') ?? $specific_date }}">
                                            @elseif (isset($absent_date))
                                            <input type="text" name="date" id="date" class="form-control datepicker"
                                                value="{{ old('date') ?? $absent_date }}">
                                            @else
                                            <input type="text" name="date" id="date" class="form-control datepicker"
                                            value="{{ old('date') }}">
                                            @endif
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
                                    <input type="hidden" name="user_id" value="{{ $user_id ?? '' }}">
                                    <button type="submit" class="btn-pill btn btn-dark mt-4" value="attendance"
                                        name="submit_btn">Proceed</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3 col-lg-6">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-header-title mb-4">
                                    Attendance Range Wise
                                </div>
                                @if (session('error'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <form class="form" action="{{ route('hr.studentAttendanceDetails') }}" method="POST" autocomplete="off">
                                    @csrf
                                    <div class="d-sm-flex">
                                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                            <div class=" align-items-baseline">
                                                <p class="des  mr-2"><span class="mr-2"><i
                                                            class="fa fa-circle"></i></span>Start Date</p>

                                                @if (isset($checked_attendance))
                                                    <input type="text" name="start_date" id="start_date" class="form-control datepicker"
                                                        value="{{ old('start_date') ?? $start_date }}" autocomplete="off">
                                                @else
                                                    <input type="text" name="start_date" id="start_date"
                                                        class="form-control datepicker" value="{{ old('start_date') }}">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="d-sm-flex align-items-center justify-content-end mb-4 ml-4">
                                            <div class="align-items-baseline">
                                                <p class="des  mr-2"><span class="mr-2"><i
                                                            class="fa fa-circle"></i></span>End Date</p>
                                                @if (isset($checked_attendance))
                                                    <input type="text" name="end_date" id="end_date"
                                                        class="form-control datepicker"
                                                        value="{{ old('end_date') ?? $end_date }}" autocomplete="off">
                                                @else
                                                    <input type="text" name="end_date" id="end_date"
                                                        class="form-control datepicker" value="{{ old('end_date') }}">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                                        @if ($errors->has('start_date'))
                                            <span style="color: red;">{{ $errors->first('start_date') }}</span>
                                        @endif
                                        @if ($errors->has('end_date'))
                                            <span style="color: red;">{{ $errors->first('end_date') }}</span>
                                        @endif
                                    </div>
                                    <input type="hidden" name="user_id" value="{{ $user_id ?? '' }}">
                                    <button type="submit" class="btn-pill btn btn-dark mt-4" value="attendance_range"
                                        name="submit_btn">Proceed</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
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
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($specific_attendance))
                                                    <tr class="bg-tr">
                                                        <td>{{  "1" }}</td>
                                                        <td>{{ $specific_attendance['date'] }}</td>
                                                        </td>
                                                        <td>
                                                            @if ($specific_attendance['attendance_status'] == 0)
                                                            <span class="mr-2"><i
                                                                class="fa fa-check-circle text-danger"></i></span>ABSENT
                                                            @else
                                                            <span class="mr-2"><i
                                                                class="fa fa-check-circle text-success"></i></span>PRESENT
                                                            @endif
                                                        </td>
                                                    </tr>
                                            @elseif (isset($checked_attendance))
                                                @foreach ($checked_attendance as $i => $attendance)
                                                    <tr class="bg-tr">
                                                        <td>{{ $i + 1 }}</td>
                                                        <td>{{ $attendance['date'] }}</td>
                                                        </td>
                                                        <td>
                                                            @if ($attendance['attendance_status'] == 0)
                                                            <span class="mr-2"><i
                                                                class="fa fa-check-circle text-danger"></i></span>ABSENT
                                                            @else
                                                            <span class="mr-2"><i
                                                                class="fa fa-check-circle text-success"></i></span>PRESENT
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @elseif(isset($absent_date))
                                                <tr>
                                                    <td>1</td>
                                                    <td>{{ $absent_date }}</td>
                                                    <td> N/A </td>
                                                    <td> N/A </td>
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
        @include('hr.layouts.static_footer')
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
    <!-- Modal -->
    <div class="modal fade" id="attendance_details" tabindex="-1" role="dialog" aria-labelledby="attendance_level"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="attendance_level">Attendance Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover bg-table" id="attendance_table">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Login Time</th>
                                <th>Logout Time</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">

                        </tbody>
                    </table>
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

        // function addComment() {
        //     var attendance_id = $('#attendance_id').val();
        //     var comment = document.getElementById("comment").value;
        //     if (comment == '') {
        //         $('#err_txt').text('This field can\'t be empty!');
        //         return false;
        //     }
        //     if (comment.length > 255) {
        //         $('#err_txt').text('You can add comment within 255 characters');
        //         return false;
        //     }
        //     $.ajax({
        //         url: "{{ route('hr.attendanceDate') }}",
        //         data: {
        //             _token: "{{ csrf_token() }}",
        //             comment: comment,
        //             attendance_id: attendance_id
        //         },
        //         dataType: 'json',
        //         type: 'post',
        //         success: function(response) {
        //             location.reload();
        //         }
        //     });

        // }
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            endDate: new Date,
            // daysOfWeekDisabled: [0]
        });

        $('.openBtn').on('click', function() {

            var date = $(this).data('id');
            var user_id = $(this).data('user-id');
            console.log(date);
            var fragment = "";
            $.ajax({
                    type: 'POST',
                    url: "{{ route('hr.attendanceDate') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        date: date,
                        user_id : user_id
                    },
                    dataType: 'json',

                    success: function(data) {

                    },
                }).then(data => {
                    console.log(data);
                    $("#myTable").empty();
                    $.each(data, function(i, value) {
                        // console.log();
                        if (value.logout_time === null) {
                            value.logout_time = 'N/A'
                        }
                        fragment += "<tr> <td>" + (i + 1) + "</td> <td>" +
                            value.login_time +
                            " </td><td>" + value.logout_time + "</td> </tr>";
                    })
                    $("#myTable").append(fragment);
                    $("#attendance_level").html(`Attendance Details: <strong>${date}</strong>`);
                })
                .catch(error => {
                    var xhr = $.ajax();
                    console.log(xhr);
                    console.log(error);
                })

        });
    </script>
@endsection
