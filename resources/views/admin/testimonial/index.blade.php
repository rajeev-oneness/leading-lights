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
                        <li><a href="#" class="active">All Testimonial List</a></li>

                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Testimonial</h5>
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
                                <th>Added By</th>
                                <th>Content</th>
                                <th>Publish Date</th>
                                <th>Status</th>
                                <th style="width:100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($testimonials as $key => $testimonial)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $testimonial->user->first_name }} {{ $testimonial->user->last_name }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($testimonial->content,50) }}</td>
                                    <td>{{ date('Y-m-d',strtotime($testimonial->created_at)) }}</td>
                                    <td>
                                        @if ($testimonial->status == "0")
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif ($testimonial->status == "1")
                                            <span class="badge badge-success">Approved</span>
                                        @elseif ($testimonial->status == "2")
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.testimonial.show', $testimonial->id) }}"
                                            class="ml-2"><i class="far fa-eye"></i></a>
                                        <a href="javascript:void(0);" class="ml-2" data-toggle="modal"
                                            data-target="#exampleModal" onclick="deleteForm({{ $testimonial->id }})"><i
                                                class="far fa-trash-alt text-danger"></i></a>
                                        <form id="delete_form_{{ $testimonial->id }}"
                                            action="{{ route('admin.testimonial.destroy', $testimonial->id) }}" method="POST">
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
                iconHtml: '<img src="{{ asset('img/logo.jpg') }}">',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel!',
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
