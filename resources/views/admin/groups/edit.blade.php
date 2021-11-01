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
                        <li><a href="#" class="active">Edit group</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5>Edit Group</h5>
                <hr>
                <form action="{{ route('admin.groups.update', $group->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row m-0 pt-3">
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="name">Group Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') ?? $group->name }}">
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
                                        <option value="{{ $teacher->id }}" @if ($teacher->id == $group->teacher_id)
                                            selected
                                        @endif>{{ $teacher->first_name }}
                                            {{ $teacher->last_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('teacher_id'))
                                <span style="color: red;">{{ $errors->first('teacher_id') }}</span>
                            @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="name">Students Name</label>
                                <?php  
                                //get the old values from form
                                $old = old('student_ids');

                                //get data from database table field
                                $ids= explode(',',$group->student_ids); 

                                //stay the values after form submission
                                if($old){  $ids=$old; } 
                                ?>
                                <select  id="choices-multiple-remove-button"  name="student_ids[]" multiple>
                                    @foreach ($students as $student)
                                    <option value="{{ $student->id }}" <?php echo in_array($student->id,$ids)?"selected" :"" ;?> >{{  ucfirst($student->first_name) }} {{  ucfirst($student->last_name) }}</option>  
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
    </script>
@endsection
