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
                        <li><a href="">Home</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="{{ route('superAdmin.admin.index') }}" class="active">Admin List</a></li>

                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>ADMIN</h5>
                    <a href="{{ route('superAdmin.admin.create') }}" class="actionbutton btn btn-sm">ADD ADMIN</a>
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
                    <table class="table table-sm table-hover" id="hr_table">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Employee Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th style="width:100px" class="text-center">Status</th>
                                <th style="width:100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $key => $admin)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $admin->id_no }}</td>
                                    <td>{{ $admin->first_name }} {{ $admin->last_name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->mobile }}</td>
                                    <td class="text-center">
                                        @if ($admin->status == 1 && $admin->deactivated == 0)
                                            <span class="badge badge-success">Approved</span>
                                        @elseif ($admin->status == 1 && $admin->deactivated == 1)
                                            <span class="badge badge-danger">Deactivated</span>
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{ route('superAdmin.admin.show', $admin->id) }}"><i
                                                class="far fa-eye"></i></a>
                                        <a href="{{ route('superAdmin.admin.edit', $admin->id) }}"
                                            class="ml-2"><i class="far fa-edit"></i></a>
                                        {{-- <a href="javascript:void(0);" class="ml-2" data-toggle="modal" data-target="#exampleModal" onclick="deleteForm({{ $hr->id }})"><i class="far fa-trash-alt text-danger"></i></a>
                                        <form id="delete_form_{{ $hr->id }}" action="{{ route('admin.hr.destroy',$hr->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form> --}}
                                    </td>

                                    {{-- <td>
                                        <a href="{{ route('superAdmin.admin.show',$hr->id) }}"><i class="far fa-eye"></i></a>
							<a href="{{ route('superAdmin.admin.edit',$hr->id) }}" class="ml-2"><i class="far fa-edit"></i></a>

                                    </td> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- <script>
        $(document).ready(function() {
            $('#hr_table').DataTable();
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
    </script> --}}
@endsection
