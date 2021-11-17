@extends('hr.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <div>Attendance
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form class="form" action="{{ route('hr.attendanceStudent') }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    <div class="form-row">
                                                        <div class="form-group col-sm-6">
                                                            <div
                                                                class="card-header-title font-size-lg text-capitalize mb-4">
                                                                Class
                                                            </div>
                                                            <select class="form-control" name="class_name"
                                                                id="class_name">
                                                                <option value="">Select Class</option>
                                                                {{-- @foreach ($groups as $group)
                                                                    <option value="{{ $group->id . '-group' }}"
                                                                        class="text-info">
                                                                        {{ $group->name }}</option>
                                                                @endforeach --}}
                                                                @foreach ($classes as $class)
                                                                    <option value="{{ $class->id . '-class' }}"
                                                                        @if (old('class') == $class->id) selected @endif>
                                                                        {{ $class->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <div
                                                                class="card-header-title font-size-lg text-capitalize mb-4">
                                                                Student
                                                            </div>
                                                            <select class="form-control" id="student_id"
                                                                name="student_id">

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-sm-6">
                                                            <button class="btn-pill btn btn-dark mt-4"
                                                                name="view_submission">Proceed</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('hr.layouts.static_footer')
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
