@extends('teacher.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-window-restore"></i>
                        </div>
                        <div>Access Class
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabs-animation">
                <div class="row">
                    <div class="col-lg-12  text-right">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn-pill btn btn-dark btn-lg mb-4" data-toggle="modal"
                            data-target="#exampleModal">
                            Arrange Class
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover bg-table" id="class_table">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Subject</th>
                                <th>Class</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($arrange_classes as $i => $arrange_class)
                                <tr class="bg-tr">
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $arrange_class->subject }}</td>
                                    <td>{{ $arrange_class->class }}</td>
                                    <td>{{ $arrange_class->date }}</td>
                                    <td>{{ $arrange_class->start_time }}</td>
                                    <td>{{ $arrange_class->end_time }}</td>
                                    <td>
                                        @php
                                            $minutes_to_add = 55;
                                            $today_date = date('Y-m-d');
                                            $today_time = getAsiaTime24(date('Y-m-d H:i:s'));
                                            $time = new DateTime($arrange_class->date . $arrange_class->start_time);
                                            $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                                            
                                            $new_time = $time->format('H:i');
                                            
                                            $already_joined = DB::table('class_users')
                                                ->where('class_id', $arrange_class->id)
                                                ->where('user_id', Auth::user()->id)
                                                ->first();
                                        @endphp
                                        <input type="hidden" name="meeting_url" id="meeting_url"
                                            value="{{ $arrange_class->meeting_url }}">
                                        @if ($arrange_class->date > $today_date)
                                            <button class="btn-pill btn-transition btn btn-success"><i
                                                    class="fa fa-dot-circle"> Upcoming</i></button>
                                        @elseif($arrange_class->date < $today_date) <button
                                                class="btn-pill btn-transition btn btn-danger"><i class="fa fa-dot-circle">
                                                    Expired</i></button>
                                            @elseif ($arrange_class->date == $today_date && ($today_time >=
                                                $arrange_class->start_time && $today_time <= $new_time)) @if ($already_joined && $already_joined->comment)
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="{{ $already_joined->comment }}">{{ \Illuminate\Support\Str::limit($already_joined->comment, 15) }}</span>
                                                @elseif ($already_joined && $already_joined->is_attended == 1)
                                                    <span class="btn btn-success">Joined</span>
                                                @else

                                                    <button onclick="assignClass({{ $arrange_class->id }})"
                                                        class="btn-pill btn btn-dark btn-lg">Join Now</button>

                                                    <button
                                                        class="btn-pill btn-transition btn btn-outline-dark btn-lg comment_section"
                                                        data-toggle="modal" data-target=".bd-example-modal-sm"
                                                        data-toggle="tooltip" title=""
                                                        data-original-title="Attach Proper Reason"
                                                        data-id="{{ $arrange_class->id }}">Not Join !</button>

                                        @endif
                                    @elseif ($arrange_class->date == $today_date && $today_time <= $arrange_class->
                                            start_time)
                                            <button class="btn-pill btn-transition btn btn-success"><i
                                                    class="fa fa-dot-circle">
                                                    Upcoming</i></button>
                                        @else
                                            <button class="btn-pill btn-transition btn btn-danger"><i
                                                    class="fa fa-dot-circle">
                                                    Expired</i></button>
                            @endif
                            <button type="button" class="btn-pill btn-transition btn btn-info openBtn" data-toggle="modal"
                                data-target="#view_classroom" title="View Class Room"
                                data-id="{{ $arrange_class->id }}"><i class="fa fa-eye"></i>
                            </button>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    </div>
    </div>
    <!-- Modal for arrange class-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Arrange Class</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Subject</label>
                                    <select name="subject" id="subject" class="form-control">
                                        <option value="">Select subject</option>
                                        <option value="Math">Math</option>
                                        <option value="Physics">Physics</option>
                                        <option value="Chemistry">Chemistry</option>
                                        <option value="History">History</option>
                                    </select>
                                    <span class="text-danger" id="sub_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="class_name">Class</label>
                                    <select name="class_name" id="class_name" class="form-control">
                                        <option value="">Select classes</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->name }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="class_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control" name="date" id="date">
                                    <span class="text-danger" id="date_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Start Time</label>
                                    <input type="time" class="form-control" name="start_time" id="start_time">
                                    <span class="text-danger" id="start_time_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">End Time</label>
                                    <input type="time" class="form-control" name="end_time" id="end_time">
                                    <span class="text-danger" id="end_time_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="meeting_url">Live class URL(Zoon,Meet etc)</label>
                                    <input type="text" class="form-control" name="meeting_url" id="meeting_url">
                                    <span class="text-danger" id="url_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="arrange_class()">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- For Not Join a class -->
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
                    <input type="hidden" name="class_id" id="class_id">
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
    <!-- View classroom -->
    <!-- Modal -->
    <div class="modal fade" id="view_classroom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Class Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover bg-table" id="attendance_table">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Comment</th>
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
            $('#class_table').DataTable();
            $('#attendance_table').DataTable();
            $('.openBtn').on('click', function() {

                var prop_id = $(this).data('id');
                var fragment="";
                $.ajax({
                        type: 'POST',
                        url: "{{ route('teacher.view_participation') }}" ,
                        data: {
                            _token: "{{ csrf_token() }}",
                             prop_id : prop_id},
                        dataType: 'json',

                        success: function(data) {

                        },
                    }).then(data => {
                        $("#myTable").empty();
                        $.each(data,function (i,value) {
                            var email = value.email;
                            var name = value.first_name +' '+ value.last_name;
                            if (value.comment) {
                                var comment = value.comment;
                            } else {
                                var comment = 'N/A';
                            }
                            
                            // console.log();
                            fragment +="<tr> <td>"+(i+1)+"</td> <td>"+email+"</td> <td>"+name+" </td><td>"+comment+"</td> </tr>";
                        })
                        $("#myTable").append(fragment);
                    })
                    .catch(error => {
                        var xhr = $.ajax();
                        console.log(xhr);
                        console.log(error);
                    })

            });
        });
        

        function arrange_class() {
            let subject = $('#subject').val();
            let class_name = $('#class_name').val();
            let start_time = $('#start_time').val();
            let end_time = $('#end_time').val();
            let date = $('#date').val();
            let meeting_url = $('#meeting_url').val();
            let url_validate = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;

            let flag = 0;
            if (subject == '') {
                $('#sub_error').text('This field is required');
                flag = 1;
            } else {
                $('#sub_error').text('');
            }
            if (class_name == '') {
                $('#class_error').text('This field is required');
                flag = 1;
            } else {
                $('#class_error').text('');
            }
            if (start_time == '') {
                $('#start_time_error').text('This field is required');
                flag = 1;
            } else {
                $('#start_time_error').text('');
            }
            if (end_time == '') {
                $('#end_time_error').text('This field is required');
                flag = 1;
            } else {
                $('#end_time_error').text('');
            }
            if (date == '') {
                $('#date_error').text('This field is required');
                flag = 1;
            } else {
                $('#date_error').text('');
            }
            if (meeting_url == '') {
                $('#url_error').text('This field is required');
                flag = 1;
            } else {
                if (!url_validate.test(meeting_url)) {
                    $('#url_error').text('Please provide valid URL!');
                    flag = 1;
                } else {
                    $('#url_error').text('');
                }
            }

            if (flag == 1) {
                return false;
            } else {
                $.ajax({
                    url: "{{ route('teacher.arrange_class') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        subject: subject,
                        class: class_name,
                        date: date,
                        start_time: start_time,
                        end_time: end_time,
                        meeting_url: meeting_url

                    },
                    dataType: 'json',
                    type: 'post',
                    success: function(response) {
                        if (response.error) {
                            $('#start_time_error').text(response.error);
                        } else {
                            location.reload();
                        }
                    }
                });
            }
        }


        $(document).on("click", ".comment_section", function() {
            var class_id = $(this).data('id');
            $(".modal-body #class_id").val(class_id);
        });

        function assignClass(classId) {
            $.ajax({
                url: "{{ route('teacher.class_attendance') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    class_id: classId

                },
                dataType: 'json',
                type: 'post',
                success: function(response) {

                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                    var url = $('#meeting_url').val();
                    window.open(url, "_blank");
                }
            });
        }

        function addComment() {
            var class_id = $('#class_id').val();
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
                url: "{{ route('user.class_attendance') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    comment: comment,
                    class_id: class_id
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
