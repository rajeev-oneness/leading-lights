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
                        <li><a href="{{ route('admin.groups.index') }}">All Groups List</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">View group</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5>View Group</h5>
                <hr>
                <form>
                    <div class="row m-0 pt-3">
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="name">Group Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') ?? $group->name }}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="name">Teacher Name</label>
								@php
									$teacher = App\Models\User::where('id',$group->teacher_id)->first();
								@endphp
								<input type="text" class="form-control" value="{{ $teacher->first_name }} {{ $teacher->last_name }}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="class">Class</label>
								<input type="text" class="form-control" value="{{ $classes->name }}" disabled>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="name">Students Name</label>
								<div class="student-list">	
                                    <ol>
                                @foreach ($student_details as $key => $student_detail)
                               
                                    <li>{{ $student_detail->first_name }} {{ $student_detail->last_name }} - {{ $student_detail->id_no }}</li>

                                            
											{{-- <strong>{{ $key + 1 }}.</strong> {{ $student_detail->first_name }} {{ $student_detail->last_name }} - {{ $student_detail->id_no }} --}}
                                        
									@endforeach
                                </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
                // maxItemCount:5,
                // searchResultLimit:5,
                // renderChoiceLimit:5
            });


        });
    </script>
@endsection
