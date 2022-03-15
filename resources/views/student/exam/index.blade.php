@extends('student.layouts.master')
@section('title')
    Exam
@endsection
<style>
    .table thead th {
        font-size: 14px !important;
    }
</style>
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-graduation-cap"></i>
                        </div>
                        <div>Exam
                        </div>
                    </div>
                </div>
                {{-- <div class="float-right">
                    <a class="btn-pill btn btn-primary btn-lg" href="{{ route('user.report_generate') }}"><i
                            class="fa fa-download mr-2"></i>Report Card</a>
                </div> --}}
            </div>
            @if (Auth::user()->registration_type == 1)
            <h5>Leading Lights School
            </h5>
            <div class="tabs-animation">
                <div class="card mb-3">
                    @if (session('regular_exam_upload_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('regular_exam_upload_success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if ($errors->regular_exam_upload_error->has('upload_doc'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $errors->regular_exam_upload_error->first('upload_doc') }}
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
                        <div class="table-responsive">
                            <table class="table table-hover" id="exam_table">
                                <thead>
                                    <tr>
                                        <th>Sl no</th>
                                        <th>Subject</th>
                                        <th>Exam Category</th>
                                        <th>Exam Date</th>
                                        <th>Exam Time</th>
                                        <th>Action</th>
                                        <th>Marks/Full Marks</th>
                                        <th>Result Date</th>
                                        {{-- <th>Comment</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($class_wise_exam as $id => $exam)
                                        <tr class="bg-tr">
                                            <td>{{ $id + 1 }}</td>
                                            @php
                                                $subject_details = App\Models\Subject::find($exam->subject);
                                            @endphp
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
                                            <td>{{ date('d-M-Y',strtotime($exam->date)) }}</td>
                                            <td>{{ date('h:i A', strtotime($exam->start_time)) }} <span
                                                    class="text-success">to</span>
                                                {{ date('h:i A', strtotime($exam->end_time)) }}</td>
                                            <td>
                                                @php
                                                    // $already_upload = App\Models\SubmitExam::where('exam_id', $exam->id)
                                                    //     ->where('id_no', Auth::user()->id_no)
                                                    //     ->first();
                                                    $result = App\Models\Result::where('exam_id',$exam->id)->first();
                                                    $total_marks = App\Models\Result::where('exam_id',$exam->id)
                                                    ->where('total_marks','!=',null)
                                                    ->first();
                                                    $today_date = date('Y-m-d');
                                                    $current_time = getAsiaTime24(date('Y-m-d H:i:s'));

                                                    $exam_date = $exam->date;
                                                    $start_time = $exam->start_time;
                                                    $end_time = $exam->end_time;
                                                    $exam_start_time = date('H:i', strtotime($exam->start_time));
                                                @endphp

                                                @if (!$result && $exam_date == $today_date && ($current_time >= $exam_start_time && $current_time <= $end_time))

                                                    <a href="{{ route('user.exam.start',$exam->id) }}" class="btn-pill btn btn-primary mb-1">Start Exam</a>

                                                    @elseif ($result)
                                                        <button class="btn-pill btn-transition btn btn-success"><i
                                                                class="fa fa-check"> Submitted</i></button>
                                                    @elseif ($exam_date == $today_date && $current_time < $exam_start_time)
                                                        <button class="btn-pill btn-transition btn btn-success"><i
                                                            class="fa fa-dot-circle"> Upcoming</i></button>

                                                    @elseif($exam_date > $today_date && !$result)
                                                        <button class="btn-pill btn-transition btn btn-success"><i
                                                                class="fa fa-dot-circle"> Upcoming</i></button>
                                                    @else
                                                        <button class="btn-pill btn-transition btn btn-danger"><i
                                                                class="fa fa-dot-circle"> Expired</i></button>
                                                @endif

                                            </td>
                                            <td>
                                                @if ($result && $result->total_marks >= 0 && $total_marks)
                                                    <span>
                                                        @if ($exam->pass_marks <= $result->total_marks)
                                                            <span class="text-success">{{ $result['total_marks'] }}
                                                            </span>
                                                        @else
                                                            <span class="text-danger">{{ $result['total_marks'] }}
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
                                            <td>{{ date('d-M-Y',strtotime($exam->result_date)) }}</td>
                                            {{-- <td>
                                                @if ($already_upload && $already_upload->comment)
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="{{ $already_upload->comment }}">{{ \Illuminate\Support\Str::limit($already_upload->comment, 15) }}</span>
                                                @else
                                                    <span>N/A</span>
                                                @endif

                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>                
            @endif
            <h5>Leading Lights Coaching
            </h5>
            <div class="tabs-animation">
                <div class="card mb-3">
                    @if (session('regular_exam_upload_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('regular_exam_upload_success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if ($errors->special_exam_upload_error->has('upload_doc'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $errors->special_exam_upload_error->first('upload_doc') }}
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
                        <div class="table-responsive">
                            <table class="table table-hover" id="exam_table1">
                                <thead>
                                    <tr>
                                        <th>Sl no</th>
                                        <th>Group</th>
                                        <th>Subject</th>
                                        <th>Exam Date</th>
                                        <th>Exam Time</th>
                                        <th>Action</th>
                                        <th>Marks/Full Marks</th>
                                        <th>Result Date</th>
                                        {{-- <th>Comment</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($group_wise_exam as $id => $exam)
                                        <tr class="bg-tr">
                                            <td>{{ $id + 1 }}</td>
                                            @php
                                                $group_details = App\Models\Group::find($exam->group_id);
                                                $subject_details = App\Models\Subject::find($exam->subject);
                                            @endphp
                                            <td><span class="badge badge-info">{{ $group_details->name }}</span></td>
                                            <td>{{ $subject_details->name }}</td>
                                            <td>{{ $exam->date }}</td>
                                            <td>{{ date('h:i A', strtotime($exam->start_time)) }} <span
                                                    class="text-success">to</span>
                                                {{ date('h:i A', strtotime($exam->end_time)) }}</td>
                                                <td>
                                                    @php
                                                        // $already_upload = App\Models\SubmitExam::where('exam_id', $exam->id)
                                                        //     ->where('id_no', Auth::user()->id_no)
                                                        //     ->first();
                                                        $result = App\Models\Result::where('exam_id',$exam->id)->first();
                                                        $total_marks = App\Models\Result::where('exam_id',$exam->id)
                                                        ->where('total_marks','!=',null)
                                                        ->first();
                                                        $today_date = date('Y-m-d');
                                                        $current_time = getAsiaTime24(date('Y-m-d H:i:s'));

                                                        $exam_date = $exam->date;
                                                        $start_time = $exam->start_time;
                                                        $end_time = $exam->end_time;
                                                        $exam_start_time = date('H:i', strtotime($exam->start_time));
                                                    @endphp

                                                    @if (!$result && $exam_date == $today_date && ($current_time >= $exam_start_time && $current_time <= $end_time))

                                                        <a href="{{ route('user.exam.start',$exam->id) }}" class="btn-pill btn btn-primary mb-1">Start Exam</a>

                                                    @elseif ($exam_date == $today_date && $current_time < $exam_start_time)
                                                            <button class="btn-pill btn-transition btn btn-success"><i
                                                                class="fa fa-dot-circle"> Upcoming</i></button>
                                                        @elseif ($result)
                                                            <button class="btn-pill btn-transition btn btn-success"><i
                                                                    class="fa fa-check"> Submitted</i></button>
                                                        @elseif($exam_date > $today_date)
                                                            <button class="btn-pill btn-transition btn btn-success"><i
                                                                    class="fa fa-dot-circle"> Upcoming</i></button>
                                                        @else
                                                            <button class="btn-pill btn-transition btn btn-danger"><i
                                                                    class="fa fa-dot-circle"> Expired</i></button>
                                                    @endif

                                                </td>
                                                <td>
                                                    @if ($result && $result->total_marks >= 0 && $total_marks)
                                                        <span> <span
                                                                class="text-success">{{ $result['total_marks'] }}</span> /
                                                            <span
                                                                class="text-info">{{ $exam->full_marks }}</span></span>
                                                    @else
                                                        <span><span class="text-danger">Not published</span> / <span
                                                                class="text-info">{{ $exam->full_marks }}</span></span>
                                                    @endif
                                                </td>
                                            <td>{{ $exam->result_date }}</td>
                                            {{-- <td>
                                                @if ($already_upload && $already_upload->comment)
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="{{ $already_upload->comment }}">{{ \Illuminate\Support\Str::limit($already_upload->comment, 15) }}</span>
                                                @else
                                                    <span>N/A</span>
                                                @endif

                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            @include('teacher.layouts.static_footer')
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#exam_table').DataTable();
            $('#exam_table1').DataTable();
        });
        // $(document).on('change', 'input[name^="upload_doc"]', function(ev) {
        //     let exam_id = ev.target.id;
        //     var filedata = this.files[0];
        //     var imgtype = filedata.type;

        //     if (!(imgtype === 'application/pdf')) {
        //         $('#mgs_ta').html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //                     Please select pdf file type
    //                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //                         <span aria-hidden="true">&times;</span>
    //                     </button>
    //                 </div>`);

        //     } else {
        //         $('#mgs_ta').empty();

        //         //upload

        //         var postData = new FormData();
        //         postData.append('file', this.files[0]);
        //         postData.append('exam_id', $("#exam_id"+exam_id).val())
        //         postData.append('subject', $("#subject"+exam_id).val())

        //         $.ajax({
        //             headers: {
        //                 'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
        //             },
        //             async: true,
        //             type: "post",
        //             url: "{{ route('user.upload_exam') }}",
        //             data: postData,
        //             contentType: false,
        //             processData: false,
        //             success: function() {
        //                 location.reload();
        //             }
        //         });
        //     }
        // })
    </script>
@endsection
