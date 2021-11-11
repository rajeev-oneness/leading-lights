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
                        <li><a href="#" class="active">Add group</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5>Add Group</h5>
                <hr>
                <form action="{{ route('admin.groups.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row m-0 pt-3">
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="name">Group Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span style="color: red;">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="name">Teacher Name</label>
                                <select id="choices-multiple-remove-button" name="teacher_id">
                                    <option value="">Select Teacher</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->first_name }}
                                            {{ $teacher->last_name }} - {{ $teacher->id_no }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('teacher_id'))
                                    <span style="color: red;">{{ $errors->first('teacher_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="class_id">Class</label>
                                <select class="form-control" name="class_id" id="class_id">
                                    <option value="">Select Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('class_id'))
                                    <span style="color: red;">{{ $errors->first('class_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="name">Students Name</label>
                                <select id="choices-multiple-remove-button" multiple name="student_ids[]" class="student_ids">
                                    @foreach ($students as $student)
                                        <option value="{{ $student->user_id }}">{{ $student->first_name }}
                                            {{ $student->last_name }} - {{ $student->id_no }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('student_ids'))
                                    <span style="color: red;">{{ $errors->first('student_ids') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="actionbutton">SAVE</button>
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
        $('#class_id').on('change', function() {
            let class_id = $('#class_id').val();
            $(".choices-multiple-remove-button").html('<option value="">** Loading...</option>');
            $(".choices-multiple-remove-button").html('<option value="">--Select a Country--</option>');
            $.ajax({
                url: "{{ route('admin.getStudentsByClass') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    class_id: class_id
                },
                dataType: 'json',
                type: 'post',
                beforeSend:function(){
		        	$(".choices-multiple-remove-button").html('<option value="">** Loading....</option>');	
		        },
                success: function(response) {
                    if(response.msg == 'success'){
                        $('#choices-multiple-remove-button').html('');
                    }
                }
            });
        });
    </script>
@endsection
