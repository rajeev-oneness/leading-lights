@extends('admin.layouts.master')

@section('content')
    <div class="dashboard-body" id="content">
        <div class="dashboard-content">
            <div class="row m-0 dashboard-content-header">
                <div class="col-lg-6 d-flex">
                    <a id="sidebarCollapse" href="javascript:void(0);">
                        <i class="fas fa-bars"></i>
                    </a>
                    <ul class="breadcrumb p-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="{{ route('admin.students.index') }}">Student List</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="{{ route('admin.students.show', $student->id) }}" class="active">Student
                                Details</a></li>

                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon">
                                <i class="fa fa-graduation-cap"></i>
                            </div>
                            <div>Students Profile
                            </div>
                        </div>
                        <div class="ml-5">
                            @if ($student->status == 0)
                                <a href="{{ route('admin.students.approve', $student->id) }}"
                                    class="btn btn-info pull-right" onclick="activeAccount({{ $student->id }})"
                                    id="activeAccount">Pending</a>
                            @else
                                <a href="{{ route('admin.students.approve', $student->id) }}"
                                    class="btn btn-info pull-right" onclick="activeAccount({{ $student->id }})"
                                    id="activeAccount">Approved</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tabs-animation">
                    <div class="bg-edit p-4">
                        <div class="row">
                            <div class="col-lg-3">
                                <img src="{{ asset('frontend/assets/images/avata1.jpg') }}" class="img-fluid mx-auto">
                            </div>
                            <div class="col-lg-4 not2
							">
                                <p>{{ date('d-m-Y',strtotime($student->created_at)) }}</p>
                                <h4 class="mb-4">{{ $student->first_name.' '.$student->last_name }}<span class="ml-3">
                                        <!-- <img src="assets/images/edit.png" class="img-fluid mx-auto"> -->
                                    </span></h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>DOB :</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $student->dob ?  $student->dob : 'N/A'}}</p>
                                    </div>
                                    <div class="col-md-2">
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> --}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Age :</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{  $student_age }}</p>
                                    </div>
                                    <div class="col-md-2">
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> --}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Sex :</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $student->gender ? $student->gender : 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-2">
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> --}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Class :</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $student->class ? $student->class : 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Roll No :</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $student->roll_no ? $student->roll_no : 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <!-- <img src="assets/images/edit.png" class="img-fluid mx-auto"> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <div class="media flex-wrap w-100 align-items-center">
                                            <div class="media-body">
                                                <a href="javascript:void(0)">My Bio</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $student->about_us ? $student->about_us : 'N/A' }}<span></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function activeAccount(student_id, status) {
                    event.preventDefault();
                    let url = $("#activeAccount").attr('href');
                    let data = {
                        student_id: student_id,
                        status: status
                    };
                    $.ajax({
                        url: url,
                        type: "PUT",
                        data: data,
                        dataType: 'json',
                        success: function(response) {
                            if (response.data === 'activated') {
                                $("#activeAccount").text('Approved');
                            } else {
                                $("#activeAccount").text('Pending');
                            }
                        }
                    })

                }
            </script>
        @endsection
