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
                <form action="{{ route('admin.groups.update', $group->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row m-0 pt-3">
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                {{-- <label for="name">Group Name</label> --}}
                                <label for="review">Group Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ old('name') ?? $group->name }}">
                                @if ($errors->has('name'))
                                    <span style="color: red;">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                {{-- <label for="name">Teacher Name</label> --}}
                                <label for="review">Teacher Name<span class="text-danger">*</span></label>
                                <select id="choices-multiple-remove-button" name="teacher_id">
                                    <option value="">Select Teacher</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" @if ($teacher->id == $group->teacher_id)
                                            selected
                                    @endif>{{ $teacher->first_name }}
                                    {{ $teacher->last_name }} - {{ $teacher->id_no }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('teacher_id'))
                                    <span style="color: red;">{{ $errors->first('teacher_id') }}</span>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="class_id">Class</label>
                                <label for="review">Class<span class="text-danger">*</span></label>
                                <select class="form-control" name="class_id" id="class_id">
                                    <option value="">Select Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}" @if ($class->id === $group->class_id)
                                            selected
                                    @endif>{{ $class->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('class_id'))
                                    <span style="color: red;">{{ $errors->first('class_id') }}</span>
                                @endif
                            </div>
                        </div> --}}


                        <div class="col-lg-12">
                            <div class="form-group edit-box">
                                {{-- <label for="name">Students Name</label> --}}
                                <label for="review">Students Name<span class="text-danger">*</span></label>
                                <?php
                                //get the old values from form
                                $old = old('student_ids');
                                
                                //get data from database table field
                                $ids = explode(',', $group->student_ids);
                                
                                //stay the values after form submission
                                if ($old) {
                                    $ids = $old;
                                }
                                ?>
                                {{-- <select id="choices-multiple-remove-button" name="student_ids[]" multiple>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->user_id }}"  echo in_array($student->user_id, $ids) ? 'selected' : ''; >
                                            {{ $student->first_name }}
                                            {{ $student->last_name }} - {{ $student->id_no }}</option>
                                    @endforeach
                                </select> --}}

                                <select class="student_ids form-control" name="student_ids[]" multiple="multiple"
                                    id="student_ids">

                                    @foreach ($students as $student)
                                        {{-- <option value="{{$student->id}}">{{ $student->first_name }} {{ $student->last_name }}</option> --}}
                                        <option value="{{ $student->id }}" @php
                                            echo in_array($student->group_id, $ids) ? 'selected' : '';
                                        @endphp>
                                            {{ $student->first_name }} {{ $student->last_name }} - {{ $student->id_no }}
                                        </option>
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
            $('.student_ids').select2();
            // document.getElementById('student_ids' + id).submit();
        });

        $('#class_id').on('click', function() {
            let class_id = $('#class_id').val();
            getStudentsByClass(class_id)
        });

        @if ($group->class_id > 0)
            getStudentsByClass('{{ $group->class_id }}','{{ $group->student_ids }}');
        @endif

        function getStudentsByClass(classId, studentId = '') {
            $.ajax({
                url: "{{ route('admin.getStudentsByClass') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    class_id: classId
                },
                dataType: 'json',
                type: 'post',
                beforeSend: function() {
                    $("#student_ids").html('<option value="">** Loading....</option>');
                },
                success: function(response) {
                    if (response.msg == 'success') {
                        $("#student_ids").html('');
                        var option = '';
                        let array = [];
                        if (studentId != '') {
                            array = studentId.split(',');
                        }
                        console.log(response.result);
                        $.each(response.result, function(i) {
                            option += '<option value="' + response.result[i].id + '"';
                            if (data = $.inArray(response.result[i].id.toString(), array) !== -1) {
                                option += ' selected';
                            }
                            option += '>' + response.result[i].first_name + " " + response.result[i]
                                .last_name + " - "+ response.result[i].id_no +'</option>';
                        });

                        $("#student_ids").append(option);
                    } else {
                        $("#student_ids").html('<option value="">No Student Found</option>');
                    }
                }
            });
        }
    </script>
@endsection
