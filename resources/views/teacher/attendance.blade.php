@extends('teacher.layouts.master')
@section('title')
    Attendance
@endsection
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
            <div class="row">
                <div class="card mb-3 col-lg-6">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-header-title mb-4">
                                    Attendance Date Wise
                                </div>
                                <form class="form" action="{{ route('teacher.attendance') }}" method="POST" autocomplete="off">
                                    @csrf
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <div class="d-sm-flex align-items-baseline">
                                            <p class="des  mr-2"><span class="mr-2"><i
                                                        class="fa fa-circle"></i></span>Attendance Date</p>
                                            @if (isset($specific_attendance))
                                                @if ($specific_attendance->count() > 0)
                                                    <input type="text" name="date" id="date" class="form-control datepicker"
                                                        value="{{ old('date') ?? $specific_date }}">
                                                @endif
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
                                <form class="form" action="{{ route('teacher.attendance') }}" method="POST" autocomplete="off">
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
                                        <div class="d-sm-flex align-items-center justify-content-end mb-4 ml-lg-4">
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
                                <div class="col-lg-12 table-responsive">
                                    <table class="table table-hover bg-table" id="attendance_table">
                                        <thead>
                                            <tr>
                                                <th>Sl. No</th>
                                                <th>Date</th>
                                                @if (isset($specific_attendance) || isset($absent_date))
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                @endif
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($specific_attendance))
                                                @foreach ($specific_attendance as $i => $attendance)
                                                    @php
                                                        $no_of_working_hours1 = App\Models\Attendance::whereDate('date', '=', $attendance->date)
                                                            ->selectRaw("SEC_TO_TIME(sum(TIME_TO_SEC(TIMEDIFF(logout_time,login_time) )) ) as 'total'")
                                                            ->first();
                                                    @endphp
                                                    <tr class="bg-tr">
                                                        <td>{{ $i + 1 }}</td>
                                                        <td>{{ date('d-M-Y',strtotime($attendance->date)) }}</td>
                                                        <td>{{ $attendance->login_time }}</td>
                                                        <td>{{ $attendance->logout_time ? $attendance->logout_time : 'N/A' }}
                                                        </td>
                                                        <td>
                                                            @if ($i == 0 && isset($no_of_working_hours1))
                                                                <span>{{ $no_of_working_hours1->total }} <span
                                                                        class="badge badge-info">Total time</span></span>
                                                            <span class="btn btn-light openBtn"
                                                            data-toggle="modal" data-target="#attendance_details"
                                                             data-id="{{ $attendance->date }}">
                                                            <a href="#"><i class="fa fa-info-circle mr-2" data-toggle="tooltip"
                                                            data-placement="top" title="View All"></i></a>
                                                            </span>
                                                            @else
                                                                <span class="mr-2"><i
                                                                        class="fa fa-check-circle text-success"></i></span>PRESENT
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @elseif (isset($checked_attendance))
                                                @foreach ($checked_attendance as $i => $attendance)
                                                    @php
                                                        if ($attendance['login_time']) {
                                                            $no_of_working_hours1 = App\Models\Attendance::whereDate('date', '=', $attendance['date'])
                                                                ->selectRaw("SEC_TO_TIME(sum(TIME_TO_SEC(TIMEDIFF(logout_time,login_time) )) ) as 'total'")
                                                                ->first();
                                                        }
                                                    @endphp
                                                    <tr class="bg-tr">
                                                        <td>{{ $i + 1 }}</td>
                                                        <td>{{ date('d-M-Y',strtotime($attendance['date'])) }}</td>
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($attendance['login_time'])
                                                                <span>
                                                                    @if ($no_of_working_hours1->total)
                                                                        {{ $no_of_working_hours1->total  }}
                                                                        <span class="badge badge-info">Total Time </span>
                                                                        <span class="btn btn-light openBtn"
                                                                        data-toggle="modal" data-target="#attendance_details"
                                                                        data-id="{{ $attendance['date'] }}">
                                                                        <a href="#"><i class="fa fa-info-circle mr-2" data-toggle="tooltip"
                                                                        data-placement="top" title="View All"></i></a>
                                                                        </span>
                                                                    @endif
                                                                </span>
                                                            @else
                                                                <span class="mr-2"><i class="fa fa-exclamation-circle text-danger"></i></span>ABSENT
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
        @include('teacher.layouts.static_footer')
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
        $('.datepicker').datepicker({
            format: 'dd-M-yyyy',
            endDate: new Date,
            autoclose: true
            // daysOfWeekDisabled: [0]
        });

        $('.openBtn').on('click', function() {

            var date = $(this).data('id');
            var months = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
            var datearray = date.split("-");
            var newdate = datearray[2] + '-' + months[datearray[1]-1] + '-' + datearray[0];
            var fragment = "";
            $.ajax({
                    type: 'POST',
                    url: "{{ route('teacher.attendance') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        date: date
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
                    $("#attendance_level").html(`Attendance Details: <strong>${newdate}</strong>`);
                })
                .catch(error => {
                    var xhr = $.ajax();
                    console.log(xhr);
                    console.log(error);
                })

        });
    </script>
@endsection
