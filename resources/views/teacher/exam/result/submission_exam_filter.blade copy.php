@extends('teacher.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-subscript"></i>
                        </div>
                        <div>Exam Submission
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card-header-title mb-4">
                                        View Submission Details
                                    </div>
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <form class="form" action="{{ route('teacher.studentExamSubmission') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="d-sm-flex align-items-top justify-content-between">
                                            <div class="responsive-error">
                                                <select name="class" id="class" class="form-control" onclick="test()">
                                                    <option value="">Select Class/Groups</option>
                                                    @foreach ($groups as $group)
                                                        <option value="{{ $group->id . '-group' }}" class="text-info">
                                                            {{ $group->name }}</option>
                                                    @endforeach
                                                    @foreach ($classes as $class)
                                                        <option value="{{ $class->id . '-class' }}" @if (old('class') == $class->id) selected @endif>
                                                            {{ $class->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('class'))
                                                    <span style="color: red;width: 100%">{{ $errors->first('class') }}</span>
                                                @endif
                                            </div>
                                            <div class="responsive-error">
                                                <select class="form-control" id="subject" name="subject">
                                                    <option value="" selected>Subject</option>
                                                    @foreach ($subjects as $subject)
                                                        <option value="{{ $subject->id }}" @if (old('subject') == $subject->id) selected @endif>
                                                            {{ $subject->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('subject'))
                                                    <span
                                                        style="color: red;width: 100%">{{ $errors->first('subject') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- <div class="d-sm-flex align-items-center justify-content-between">
                                            @if ($errors->has('class'))
                                                <span style="color: red;">{{ $errors->first('class') }}</span>
                                            @endif
                                            @if ($errors->has('subject'))
                                                <span style="color: red;">{{ $errors->first('subject') }}</span>
                                            @endif
                                        </div> --}}
                                        <button class="btn-pill btn btn-primary mt-4" name="view_submission">Proceed</button>
                                        <a href="{{ route('teacher.studentExamSubmission') }}"
                                            class="btn-pill btn btn-success mt-4 float-right">View All</a>
                                    </form>
    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-header-title mb-4">
                                    Download Student Wise Report Card
                                </div>
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <form class="form" action="{{ route('teacher.studentExamSubmission') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="d-sm-flex align-items-center justify-content-between">
                                        <select name="class_name" id="class_name" class="form-control">
                                            <option value="">Select Class/Groups</option>
                                            @foreach ($groups as $group)
                                                <option value="{{ $group->id . '-group' }}" class="text-info">
                                                    {{ $group->name }}</option>
                                            @endforeach
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id . '-class' }}" @if (old('class') == $class->id) selected @endif>
                                                    {{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                        <select class="form-control" id="student_id" name="student_id">
                                            {{-- <option value="" selected>Student Name</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id_no }}" @if (old('id_no') == $user->id_no) selected @endif>
                                                    {{ $user->first_name }}
                                                    {{ $user->last_name }}-{{ $user->id_no }}</option>
                                            @endforeach --}}
                                        </select>

                                    </div>
                                    <div class="d-sm-flex align-items-center justify-content-between">
                                        @if ($errors->has('class_name'))
                                            <span style="color: red;">{{ $errors->first('class_name') }}</span>
                                        @endif
                                        @if ($errors->has('student_id'))
                                            <span style="color: red;">{{ $errors->first('student_id') }}</span>
                                        @endif
                                    </div>
                                    <button class="btn-pill btn btn-primary mt-4" name="student_wise_result"><i
                                            class="fa fa-download mr-2"></i>Download</button>
                                </form>

                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="mb-3 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-header-title mb-4">
                                    Download Class Wise Report Card
                                </div>
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <form class="form" action="{{ route('teacher.studentExamSubmission') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="d-sm-flex align-items-center justify-content-between">
                                        {{-- <select class="form-control" id="class_name1" name="class_name1">
                                    <option value="" selected>Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}" @if (old('class') == $class->id) selected @endif>
                                            {{ $class->name }}</option>
                                    @endforeach
                                </select> --}}
                                        <select name="class_name1" id="class_name1" class="form-control">
                                            <option value="">Select Class/Groups</option>
                                            @foreach ($groups as $group)
                                                <option value="{{ $group->id . '-group' }}" class="text-info">
                                                    {{ $group->name }}</option>
                                            @endforeach
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id . '-class' }}" @if (old('class') == $class->id) selected @endif>
                                                    {{ $class->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="d-sm-flex align-items-center justify-content-between">
                                        @if ($errors->has('class_name1'))
                                            <span style="color: red;">{{ $errors->first('class_name1') }}</span>
                                        @endif
                                    </div>
                                    <button class="btn-pill btn btn-primary mt-4" name="class_wise_result"><i
                                            class="fa fa-download mr-2"></i>Download</button>
                                </form>

                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        @include('teacher.layouts.static_footer')
    </div>
    <script>
        $('#class_name').on('click', function() {
            var class_id = $('#class_name').val();
            console.log(class_id);
            if (class_id !== '') {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('getStudentByClass') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        class_id: class_id
                    },
                    dataType: 'json',

                    success: function(response) {
                        console.log(response.length);
                        if (response.length > 0) {
                            $("#student_id").html('');
                            var option = '<option value="">Select a student</option>';
                            $.each(response, function(i) {
                                option += '<option value="' + response[i].id + '">' + response[
                                    i].first_name + '</option>';
                            });

                            $("#student_id").append(option);
                        } else {
                            $("#student_id").html('');
                            var option = '<option value="">Select a student</option>';
                            option += '<option value="">' + 'No student available' + '</option>';
                            $("#student_id").append(option);
                        }
                    },
                })
            }
        })
    </script>
@endsection
