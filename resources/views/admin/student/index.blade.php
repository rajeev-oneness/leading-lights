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
                        <li><a href="{{ route('admin.students.index') }}" class="active">Student List</a></li>

                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Student</h5>
                    <a href="{{ route('admin.students.create') }}" class="actionbutton btn btn-sm">ADD STUDENT</a>
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
                    <table class="table table-sm table-hover" id="student_table">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Student Id</th>
                                <th>Class</th>
                                <th>Special Course</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th style="width:100px" class="text-center">Status</th>
                                <th style="width:100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $key => $student)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $student->id_no }}</td>
                                    <?php
                                    if(str_contains($student->special_course_ids, ',')) {
                                        $special_course_ids = explode(',', $student->special_course_ids);
                                        foreach ($special_course_ids as $course_id) {
                                            $course_details[] = App\Models\SpecialCourse::find($course_id);
                                        }
                                    }
                                    else{
                                        $special_course_ids = $student->special_course_ids;
                                        $course_detail = App\Models\SpecialCourse::find($special_course_ids);
                                    }
                                    
                                    
                                    $class_details = App\Models\Classes::find($student->class);
                                    ?>
                                    <td><span class="text-success">{{ $class_details->name }}</span></td>
                                    <td>
                                            <span class="text-info">
                                                @if ($student->special_course_ids !== null)
                                                
                                                    @if (str_contains($student->special_course_ids, ','))
                                                    <div class="student-list">
                                                        <ol>
                                                            @foreach ($course_details as $course)
                                                                <li>{{ $course['title'] }}</li>
                                                            @endforeach
                                                        </ol>
                                                    </div>
                                                    @else
                                                        {{ $course_detail['title'] }}
                                                    @endif
                                                @else
                                                    N/A
                                                @endif
    
                                            </span>
                                        
                                        
                                    </td>
                                    {{-- <td>{{ $course_details->title ? $course_details->title : 'N/A' }}</td> --}}
                                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>
                                        @if ($student->country_code)
                                        {{ $student->mobile ? '+'.$student->country_code.' '.$student->mobile : 'N/A' }}
                                        @else
                                        {{ $student->mobile ? $student->mobile : 'N/A' }}
                                        @endif
                                        
                                    </td>
                                    <td class="text-center">
                                        @if ($student->status == 1)
                                            <span class="badge badge-success">Approved</span>
                                        @elseif($student->rejected == 1)
                                            <span class="badge badge-danger">Rejected</span>
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{ route('admin.students.show', $student->id) }}"><i
                                                class="far fa-eye"></i></a>
                                        <a href="{{ route('admin.students.edit', $student->id) }}"
                                            class="ml-2"><i class="far fa-edit"></i></a>
                                        {{-- <a href="javascript:void(0);" class="ml-2" data-toggle="modal"
                                            data-target="#exampleModal" onclick="deleteForm({{ $student->id }})"><i
                                                class="far fa-trash-alt text-danger"></i></a>
                                        <form id="delete_form_{{ $student->id }}"
                                            action="{{ route('admin.students.destroy', $student->id) }}" method="POST">
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
            $('#student_table').DataTable();
        });

        function deleteForm(id) {
            console.log("hello");
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
