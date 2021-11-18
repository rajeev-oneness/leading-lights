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
                        <div>Attendance
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-sm-8">
                                <img src="{{ asset('frontend/images/ams.png') }}" class="img-fluid">
                            </div>
                            <div class="col-sm-8">
                                <div class="card-body">
                                    <div class="card-header-title font-size-lg text-capitalize mb-4">
                                        Attendense Sheet
                                    </div>

                                    <table class="table table-hover bg-table">
                                        <thead>
                                            <tr>
                                                <th>Sl. No</th>
                                                <th>Name</th>
                                                <th>Employee Id</th>
                                                <th>DOJ</th>
                                                <th>Academic Qualification*</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($attendance_detail as $key => $attendance_detl)
                                                <tr class="bg-tr">
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $attendance_detl->first_name ? $attendance_detl->first_name : 'N/A' }}
                                                        {{ $attendance_detl->last_name ? $attendance_detl->last_name : 'N/A' }}
                                                    </td>
                                                    <td>{{  $attendance_detl->id_no }}</td>
                                                    <td>{{  $attendance_detl->doj ? $attendance_detl->doj : 'N/A' }}</td>
                                                    <td>{{  $attendance_detl->qualification}}</td>
                                                    <td><a href="{{ route('hr.show.teacher.attendance', ['id' => $attendance_detl->id]) }}">Show</a>
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
            </div> --}}

            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="tab-content">
                        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="attendance_table">
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
                                                @foreach ($attendance_detail as $key => $attendance_detl)
                                                    <tr class="bg-tr">
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $attendance_detl->first_name ? $attendance_detl->first_name : 'N/A' }}
                                                            {{ $attendance_detl->last_name ? $attendance_detl->last_name : 'N/A' }}
                                                        </td>
                                                        <td>{{  $attendance_detl->id_no }}</td>
                                                        <td>{{  $attendance_detl->doj ? $attendance_detl->doj : 'N/A' }}</td>
                                                        <td>{{  $attendance_detl->qualification ? $attendance_detl->qualification : 'N/A'}}</td>
                                                        <td><a href="{{ route('hr.show.teacher.attendance', ['id' => $attendance_detl->id]) }}"><i class="fa fa-eye text-info"></i></a>
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
