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
                        <li><a href="#" class="active">Special Courses List</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Courses</h5>
                    <a href="{{ route('admin.special-courses.create') }}" class="actionbutton btn btn-sm">ADD COURSE</a>
                </div>
                <hr>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="table-responsive edit-table">
                    <table class="table table-sm table-hover" id="teacher_table">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Class</th>
                                <th>Course Title</th>
                                <th>Start Date</th>
                                <th>Fees(&#x20B9;)</th>
                                <th style="width:100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $key => $course)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $course->class_id ? $course->class_details->name : 'N/A'  }}</td>
                                    <td>{{ $course->title }}</td>
                                    <td>{{ date('d-M-Y',strtotime($course->start_date)) }}</td>
                                    <td>&#x20B9;{{ $course->monthly_fees }}</td>
                                    <td>
                                        {{-- <a href="{{ route('admin.courses.show', $course->id) }}"><i
                                                class="far fa-eye"></i></a> --}}
                                        {{-- <a href="{{ route('admin.monthly_payment_check') }}"><i class="fa fa-envelope" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Send email for renewal"></i></a> --}}

                                        <a href="{{ route('admin.special-courses.edit', $course->id) }}" class="ml-2"><i
                                                class="far fa-edit"></i></a>

                                        {{-- <a href="javascript:void(0);" class="ml-2" data-toggle="modal"
                                            data-target="#exampleModal" onclick="sendEmailForm({{ $course->id }})"><i class="fa fa-envelope" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Send email for renewal"></i></a>
                                        <form id="send_email_form_{{ $course->id }}"
                                            action="{{ route('admin.monthly_payment_check', $course->id) }}" method="POST">
                                            @csrf
                                        </form> --}}
                                        {{-- <a href="javascript:void(0);" class="ml-2" data-toggle="modal"
                                            data-target="#exampleModal" onclick="deleteForm({{ $course->id }})"><i
                                                class="far fa-trash-alt text-danger"></i></a>
                                        <form id="delete_form_{{ $course->id }}"
                                            action="{{ route('admin.courses.destroy', $course->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form> --}}
                                    </td>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#teacher_table').DataTable();
        });

        function sendEmailForm(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure to send an email to all the users?',
                text: "You won't be able to revert this!",
                iconHtml: '<img src="{{ asset('img/logo.jpg') }}">',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    document.getElementById('send_email_form_' + id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Email doesn\'t sent to the course user :)',
                        'error'
                    )
                }
            })
        }
        function deleteForm(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    document.getElementById('delete_form_' + id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your data  is safe :)',
                        'error'
                    )
                }
            })
        }

        setTimeout(function() {
            $(".alert-success").hide();
            $(".alert-warning").hide();
        }, 5000);
    </script>
@endsection
