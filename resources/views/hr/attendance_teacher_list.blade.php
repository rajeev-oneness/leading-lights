@extends('hr.layouts.master')
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
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('hr.attendance') }}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Teacher List</li>
                </ol>
            </nav>              
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="tab-content">
                        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped bg-table" id="attendance_table">
                                            <thead>
                                                <tr>
                                                    <th>Sl. No</th>
                                                    <th>Name</th>
                                                    <th>Employee Id</th>
                                                    <th>DOJ</th>
                                                    <th>Academic Qualification</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($attendance_detail as $key => $attendance_details)
                                                    <tr class="bg-tr">
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $attendance_details->first_name ? $attendance_details->first_name : 'N/A' }}
                                                            {{ $attendance_details->last_name ? $attendance_details->last_name : 'N/A' }}
                                                        </td>
                                                        <td>{{  $attendance_details->id_no }}</td>
                                                        <td>{{  $attendance_details->doj ? $attendance_details->doj : 'N/A' }}</td>
                                                        <td>{{  $attendance_details->qualification ? $attendance_details->qualification : 'N/A'}}</td>
                                                        <td><a href="{{ route('hr.show.teacher.attendance', ['id' => $attendance_details->id]) }}"><i class="fa fa-eye text-info" data-toggle="tooltip" data-placement="top" title="View attendance"></i></a>
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
                </div>
            </div>

        </div>

        @include('hr.layouts.static_footer')
        <script>
            $(document).ready(function() {
            $('#attendance_table').DataTable();
        });
        </script>
    @endsection
