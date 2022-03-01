@extends('hr.layouts.master')
@section('title')
    Student Report
@endsection
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-download"></i>
                        </div>
                        <div>Student Reports
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card mb-3 col-lg-6">
                    <div class="card-title p-3">
                        Results
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <form class="form" action="{{ route('hr.report_details') }}" method="POST">
                                    @csrf
                                    <div class="d-sm-flex align-items-top justify-content-between">
                                        <div class="responsive-error">
                                            <label for="">Select Class<span class="text-danger">*</span></label>
                                            <select name="class" id="class" class="form-control" onclick="test()">
                                                <option value="">Select Class</option>
                                                {{-- @foreach ($groups as $group)
                                                    <option value="{{ $group->id . '-group' }}" class="text-info">
                                                        {{ $group->name }}</option>
                                                @endforeach --}}
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id . '-class' }}"
                                                        @if (old('class') == $class->id) selected @endif>
                                                        {{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('class'))
                                                <span style="color: red;width: 100%">{{ $errors->first('class') }}</span>
                                            @endif
                                        </div>
                                        <div class="responsive-error">
                                            <label for="">Select Subject<span class="text-danger">*</span></label>
                                            <select class="form-control" id="subject" name="subject">
                                                <option value="" selected>Subject</option>
                                                @foreach ($subjects as $subject)
                                                    <option value="{{ $subject->id }}"
                                                        @if (old('subject') == $subject->id) selected @endif>
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
                                    <a href="{{ route('hr.report_details') }}"
                                        class="btn-pill btn btn-success mt-4 float-right">View All</a>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3 col-lg-6">
                    <div class="card-title p-3">
                        Individual Report
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <form class="form" action="{{ route('hr.report_details') }}" method="POST">
                                    @csrf
                                    <div class="d-sm-flex align-items-top justify-content-between">
                                        <div class="responsive-error">
                                            <label for="name">Select Class<span class="text-danger">*</span></label>
                                            <select name="class_name" id="class_wise_combo" class="form-control">
                                                <option value="">Select Class</option>
                                                {{-- @foreach ($groups as $group)
												<option value="{{ $group->id . '-group' }}" class="text-info">
													{{ $group->name }}</option>
											@endforeach --}}
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id . '-class' }}"
                                                        @if (old('class') == $class->id) selected @endif>
                                                        {{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('class_name'))
                                                <span
                                                    style="color: red;width: 100%">{{ $errors->first('class_name') }}</span>
                                            @endif
                                        </div>
                                        <div class="responsive-error">
                                            <label for="name">Select Student<span class="text-danger">*</span></label>
                                            <select class="form-control" name="student_id" id="student_id">
                                                <option value="">Select Student</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->first_name }}
                                                        {{ $user->last_name }}- {{ $user->id_no }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('student_id'))
                                                <span style="color: red;">{{ $errors->first('student_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <button class="btn-pill btn btn-primary mt-4" name="student_wise_result"><i
                                            class="fa fa-download"> Download</i></button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3 col-lg-6">
                    <div class="card-title p-3">
                        Class Wise Report
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <form class="form" action="{{ route('hr.report_details') }}" method="POST">
                                    @csrf
                                    <div class="d-sm-flex align-items-top justify-content-between">
                                        <div class="responsive-error">
                                            <label for="name">Select Class<span class="text-danger">*</span></label>
                                            <select name="class_name1" id="class_wise_combo" class="form-control">
                                                <option value="">Select Class</option>
                                                {{-- @foreach ($groups as $group)
												<option value="{{ $group->id . '-group' }}" class="text-info">
													{{ $group->name }}</option>
											@endforeach --}}
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id . '-class' }}"
                                                        @if (old('class') == $class->id) selected @endif>
                                                        {{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('class_name1'))
                                                <span
                                                    style="color: red;width: 100%">{{ $errors->first('class_name1') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <button class="btn-pill btn btn-primary mt-4" name="class_wise_result"><i
                                            class="fa fa-download"> Download</i></button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('hr.layouts.static_footer')
    </div>
    <script>
        $(document).ready(function() {
            // $('#student_id').select2();
            var validated = false;
            $('.error').hide();
        });
        $('#class_wise_combo').on('change', function() {
            let class_id = $('#class_wise_combo').val();
            $.ajax({
                url: "{{ route('getStudentByClass') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    class_id: class_id
                },
                dataType: 'json',
                type: 'post',
                beforeSend: function() {
                    $("#student_id").html('<option value="">** Loading....</option>');
                },
                success: function(response) {
                    if (response) {
                        $("#student_id").html('');
                        var option = '';
                        $.each(response, function(i) {
                            option += '<option value="' + response[i].id + '">' +
                                response[i].first_name + ' ' + response[i].last_name + '-' +
                                response[i].id_no +
                                '</option>';
                        });

                        $("#student_id").append(option);
                    } else {
                        $("#student_id").html('<option value="">No Student Found</option>');
                    }
                }
            });
        });
    </script>
@endsection
