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
                        <div>Classes
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->registration_type == 1)
            <h5>Leading Lights School</h5>
            <div class="tabs-animation">
                <div class="card mb-3">
                    <div class="card-body">
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
                                    @foreach ($available_classes as $i => $available_class)
                                        <tr class="bg-tr">
                                            <td>{{ $i + 1 }}</td>
                                            @php
                                                if ($available_class->class) {
                                                    $class_details = App\Models\Classes::find($available_class->class);
                                                }
                                                $subject_details = App\Models\Subject::find($available_class->subject);
                                            @endphp
                                            <td>{{ $subject_details->name }}</td>
                                            <td>{{ $class_details->name }}</td>
                                            <td>{{ $available_class->date }}</td>
                                            <td>{{ date('h:i A', strtotime($available_class->start_time)) }}</td>
                                            <td>{{ date('h:i A', strtotime($available_class->end_time)) }}</td>
                                            <td>
                                                @php
                                                    $minutes_to_add = 15;
                                                    $today_date = date('Y-m-d');
                                                    $today_time = getAsiaTime24(date('Y-m-d H:i:s'));
                                                    $time = new DateTime($available_class->date . $available_class->start_time);
                                                    $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                                                    
                                                    $new_time = $time->format('H:i');
                                                    
                                                    $already_joined = DB::table('class_users')
                                                        ->where('class_id', $available_class->id)
                                                        ->where('user_id', Auth::user()->id)
                                                        ->first();
                                                    $class_start_time = date('H:i', strtotime($available_class->start_time));
                                                    // dd(date('H:i',strtotime($available_class->start_time)),$today_time)
                                                @endphp
                                                <input type="hidden" name="meeting_url" id="meeting_url"
                                                    value="{{ $available_class->meeting_url }}">
                                                @if ($available_class->date > $today_date)
                                                    <button class="btn-pill btn-transition btn btn-success"><i
                                                            class="fa fa-dot-circle"> Upcoming</i></button>
                                                @elseif($available_class->date < $today_date) <button
                                                        class="btn-pill btn-transition btn btn-danger"><i
                                                            class="fa fa-dot-circle">
                                                            Expired</i></button>
                                                    @elseif ($available_class->date == $today_date && ($today_time >=
                                                        $class_start_time && $today_time <= $new_time)) @if ($already_joined && $already_joined->comment)
                                                            <span data-toggle="tooltip" data-placement="top"
                                                                title="{{ $already_joined->comment }}">{{ \Illuminate\Support\Str::limit($already_joined->comment, 15) }}</span>
                                                        @elseif ($already_joined && $already_joined->is_attended == 1)
                                                            <span class="btn btn-success">Joined</span>
                                                        @else

                                                            <button onclick="assignClass({{ $available_class->id }})"
                                                                class="btn-pill btn btn-dark btn-lg">Join Now</button>

                                                            <button
                                                                class="btn-pill btn-transition btn btn-outline-dark btn-lg comment_section"
                                                                data-toggle="modal" data-target=".bd-example-modal-sm"
                                                                data-toggle="tooltip" title=""
                                                                data-original-title="Attach Proper Reason"
                                                                data-id="{{ $available_class->id }}">Not Join !</button>

                                                @endif
                                            @elseif ($available_class->date == $today_date &&
                                                $class_start_time >= $today_time)
                                                <button class="btn-pill btn-transition btn btn-success"><i
                                                        class="fa fa-dot-circle">
                                                        Upcoming</i></button>
                                            @else
                                                <button class="btn-pill btn-transition btn btn-danger"><i
                                                        class="fa fa-dot-circle">
                                                        Expired</i></button>
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
            @endif
            <h5>Leading Lights Coaching</h5>
            <div class="tabs-animation">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover bg-table" id="class_table1">
                                <thead>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Subject</th>
                                        <th>Group</th>
                                        <th>Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($group_wise_classes as $i => $available_class)
                                        <tr class="bg-tr">
                                            <td>{{ $i + 1 }}</td>
                                            @php
                                                if ($available_class->group_id) {
                                                    $group_details = App\Models\Group::find($available_class->group_id);
                                                }
                                                $subject_details = App\Models\Subject::find($available_class->subject);
                                            @endphp
                                            <td>{{ $subject_details->name }}</td>
                                            <td>
                                                @if ($available_class->group_id)
                                                    {{ $group_details->name }}
                                                @endif
                                            </td>
                                            <td>{{ $available_class->date }}</td>
                                            <td>{{ date('h:i A', strtotime($available_class->start_time)) }}</td>
                                            <td>{{ date('h:i A', strtotime($available_class->end_time)) }}</td>
                                            <td>
                                                @php
                                                    $minutes_to_add = 15;
                                                    $today_date = date('Y-m-d');
                                                    $today_time = getAsiaTime24(date('Y-m-d H:i:s'));
                                                    $time = new DateTime($available_class->date . $available_class->start_time);
                                                    $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                                                    
                                                    $new_time = $time->format('H:i');
                                                    
                                                    $already_joined = DB::table('class_users')
                                                        ->where('class_id', $available_class->id)
                                                        ->where('user_id', Auth::user()->id)
                                                        ->first();
                                                    $class_start_time = date('H:i', strtotime($available_class->start_time));
                                                    // dd(date('H:i',strtotime($available_class->start_time)),$today_time)
                                                @endphp
                                                <input type="hidden" name="meeting_url" id="meeting_url"
                                                    value="{{ $available_class->meeting_url }}">
                                                @if ($available_class->date > $today_date)
                                                    <button class="btn-pill btn-transition btn btn-success"><i
                                                            class="fa fa-dot-circle"> Upcoming</i></button>
                                                @elseif($available_class->date < $today_date) <button
                                                        class="btn-pill btn-transition btn btn-danger"><i
                                                            class="fa fa-dot-circle">
                                                            Expired</i></button>
                                                    @elseif ($available_class->date == $today_date && ($today_time >=
                                                        $class_start_time && $today_time <= $new_time)) @if ($already_joined && $already_joined->comment)
                                                            <span data-toggle="tooltip" data-placement="top"
                                                                title="{{ $already_joined->comment }}">{{ \Illuminate\Support\Str::limit($already_joined->comment, 15) }}</span>
                                                        @elseif ($already_joined && $already_joined->is_attended == 1)
                                                            <span class="btn btn-success">Joined</span>
                                                        @else

                                                            <button onclick="assignClass({{ $available_class->id }})"
                                                                class="btn-pill btn btn-dark btn-lg">Join Now</button>

                                                            <button
                                                                class="btn-pill btn-transition btn btn-outline-dark btn-lg comment_section"
                                                                data-toggle="modal" data-target=".bd-example-modal-sm"
                                                                data-toggle="tooltip" title=""
                                                                data-original-title="Attach Proper Reason"
                                                                data-id="{{ $available_class->id }}">Not Join !</button>

                                                @endif
                                            @elseif ($available_class->date == $today_date &&
                                                $class_start_time >= $today_time)
                                                <button class="btn-pill btn-transition btn btn-success"><i
                                                        class="fa fa-dot-circle">
                                                        Upcoming</i></button>
                                            @else
                                                <button class="btn-pill btn-transition btn btn-danger"><i
                                                        class="fa fa-dot-circle">
                                                        Expired</i></button>
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
    <script>
        $(document).ready(function() {
            $('#class_table').DataTable();
            $('#class_table1').DataTable();
        });
        $(document).on("click", ".comment_section", function() {
            var class_id = $(this).data('id');
            $(".modal-body #class_id").val(class_id);
        });

        function assignClass(classId) {
            $.ajax({
                url: "{{ route('user.class_attendance') }}",
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
