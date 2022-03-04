@extends('teacher.layouts.master')
@section('title')
    Exam Result
@endsection
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
                <div class="card mb-3 col-lg-6">
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
