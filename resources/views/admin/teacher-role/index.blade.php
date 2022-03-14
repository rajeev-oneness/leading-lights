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
                        <li><a href="#" class="active">Teacher Role Management</a></li>

                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
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
                                <th>Teacher Name</th>
                                <th>Employee Id</th>
                                <th>Group Access</th>
                                <th>Organization Access</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $key => $teacher)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($teacher->first_name.' '.$teacher->last_name,50) }}</td>
                                    <td>{{ $teacher->id_no }}</td>
                                    <td>
                                        @if ($teacher->group_access == 0)
                                            <span class="text-danger">No</span>
                                        @else
                                            <span class="text-success">Yes</span>
                                        @endif

                                        <div class="custom-control custom-switch">
                                            <span data-toggle="tooltip" data-placement="top" title="Change Status">
                                            <input type="checkbox" class="custom-control-input" id="group_access_update_{{ $teacher->id }}"  {{ $teacher->group_access == 1 ? 'checked' : '' }} onclick="updateGroupAccess({{ $teacher->id }})">
                                                <label class="custom-control-label" for="group_access_update_{{ $teacher->id }}"></label>
                                            </span>
                                        </div>
                                        <form action="{{ route('admin.teacher.role.group.update') }}" id="group_form_{{ $teacher->id }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                                <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                                        </form>
                                    </td>
                                    <td>
                                        @if ($teacher->class_access == 0)
                                        <span class="text-danger">No</span>
                                        @else
                                            <span class="text-success">Yes</span>
                                        @endif

                                        <div class="custom-control custom-switch">
                                            <span data-toggle="tooltip" data-placement="top" title="Change Status">
                                            <input type="checkbox" class="custom-control-input" id="class_access_update_{{ $teacher->id }}"  {{ $teacher->class_access == 1 ? 'checked' : '' }} onclick="updateClassAccess({{ $teacher->id }})">
                                                <label class="custom-control-label" for="class_access_update_{{ $teacher->id }}"></label>
                                            </span>
                                        </div>
                                        <form action="{{ route('admin.teacher.role.class.update') }}" id="class_form_{{ $teacher->id }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                                <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                                        </form>
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

        function updateGroupAccess(id) {
            event.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                iconHtml: '<img src="{{ asset('img/logo.jpg') }}">',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    document.getElementById('group_form_' + id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    // swalWithBootstrapButtons.fire(
                    //     'Cancelled',
                    //     'Your data  is safe :)',
                    //     'error'
                    // )
                }
            })
        }

        function updateClassAccess(id) {
            event.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                iconHtml: '<img src="{{ asset('img/logo.jpg') }}">',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    document.getElementById('class_form_' + id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    // swalWithBootstrapButtons.fire(
                    //     'Cancelled',
                    //     'Your data  is safe :)',
                    //     'error'
                    // )
                }
            })
        }

        setTimeout(function() {
            $(".alert-success").hide();
        }, 5000);
    </script>
@endsection
