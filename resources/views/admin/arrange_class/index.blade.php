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
                        <li><a href="#" class="active">All class List</a></li>

                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Classes</h5>
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
                <div class="table-responsive edit-table">
                    <table class="table table-sm table-hover" id="teacher_table">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Teacher name</th>
                                <th>Class/Group</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Meeting URL</th>
                                <th style="width:100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($arrange_class as $key => $class)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ App\models\User::find($class->user_id)->first_name }}
                                        {{ App\models\User::find($class->user_id)->last_name }}</td>
                                        @php
                                        if ($class->group_id) {
                                            $group_details = App\Models\Group::find($class->group_id);

                                        }
                                        if ($class->class) {
                                            $class_details = App\Models\Classes::find($class->class);
                                        }
                                        $subject_details = App\Models\Subject::find($class->subject);
                                    @endphp
                                    <td>
                                        @if ($class->class)
                                            {{ $class_details->name }} <span class="badge badge-info">Class</span>
                                        @else
                                            {{ $group_details->name }} <span class="badge badge-info">Group</span>
                                        @endif
                                        {{-- {{ $class->class ?  $class->class : $group_details->name}} --}}
                                    </td>
                                    <td>{{ $subject_details->name }}</td>
                                    <td>{{ $class->date }}</td>
                                    <td>{{ $class->start_time }}-{{ $class->end_time }}</td>
                                    <td>{{ $class->meeting_url }}</td>
                                    <td>
                                        <a data-toggle="modal" data-target="#view_classroom" title="View Class Room"
                                            data-id="{{ $class->id }}" class="openBtn"><i class="far fa-eye"></i></a>
                                        {{-- <a href="{{ route('admin.classes.edit', $class->id) }}" class="ml-2"><i
                                                class="far fa-edit"></i></a> --}}
                                        <a href="javascript:void(0);" class="ml-2" data-toggle="modal"
                                            data-target="#exampleModal" onclick="deleteForm({{ $class->id }})"><i
                                                class="far fa-trash-alt text-danger"></i></a>
                                        <form id="delete_form_{{ $class->id }}"
                                            action="{{ route('admin.delete_arrange_classes', $class->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
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
                    <table class="table table-hover" id="attendance_table">
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
            $('#teacher_table').DataTable();
            $('#attendance_table').DataTable();
            $('.openBtn').on('click', function() {

                var prop_id = $(this).data('id');
                var fragment = "";
                $.ajax({
                        type: 'POST',
                        url: "{{ route('admin.view_participation') }}",
                        data : {
                            _token: "{{ csrf_token() }}",
                            prop_id : prop_id
                        },
                        dataType: 'json',

                        success: function(data) {

                        },
                    }).then(data => {
                        $("#myTable").empty();
                        $.each(data, function(i, value) {
                            var email = value.email;
                            var name = value.first_name + ' ' + value.last_name;
                            if (value.comment) {
                                var comment = value.comment;
                            } else {
                                var comment = 'N/A';
                            }

                            // console.log();
                            fragment += "<tr> <td>" + (i + 1) + "</td> <td>" + email +
                                "</td> <td>" + name + " </td><td>" + comment + "</td> </tr>";
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
        }, 5000);
    </script>
@endsection
