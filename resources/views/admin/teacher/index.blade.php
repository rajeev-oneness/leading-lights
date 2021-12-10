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
                        <li><a href="{{ route('admin.teachers.index') }}" class="active">Teacher List</a></li>

                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Teacher</h5>
                    <a href="{{ route('admin.teachers.create') }}" class="actionbutton btn btn-sm">ADD TEACHER</a>
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
                                <th>Employee Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th style="width:100px" class="text-center">Status</th>
                                <th style="width:100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $key => $teacher)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $teacher->id_no }}</td>
                                    <td>{{ $teacher->first_name }} {{ $teacher->last_name }}</td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>
                                        @if ($teacher->country_code)
                                            {{ $teacher->mobile ? '+' . $teacher->country_code . ' ' . $teacher->mobile : 'N/A' }}
                                        @else
                                            {{ $teacher->mobile ? $teacher->mobile : 'N/A' }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($teacher->status == 1 && $teacher->deactivated == 0)
                                            <span class="badge badge-success">Approved</span>
                                        @elseif ($teacher->status == 1 && $teacher->deactivated == 1)
                                            <span class="badge badge-danger">Deactivated</span>
                                        @elseif($teacher->rejected == 1)
                                            <span class="badge badge-danger">Rejected</span>
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.teachers.show', $teacher->id) }}"><i
                                                class="far fa-eye"></i></a>
                                        <a href="{{ route('admin.teachers.edit', $teacher->id) }}"
                                            class="ml-2"><i class="far fa-edit"></i></a>
                                        {{-- <a href="javascript:void(0);" class="ml-2" data-toggle="modal" data-target="#exampleModal" onclick="deleteForm({{ $teacher->id }})"><i class="far fa-trash-alt text-danger"></i></a>
							<form id="delete_form_{{ $teacher->id }}" action="{{ route('admin.teachers.destroy',$teacher->id) }}" method="POST">
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
