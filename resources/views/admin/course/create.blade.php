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
                        <li><a href="{{ route('admin.classes.index') }}">All Classes List</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">Add class</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5>Add Class</h5>
                <hr>
                <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row m-0 pt-3">
                        <div class="col-lg-12">
                            <div class="form-group edit-box">
                                <label for="title">Course title</label>
                                <input type="text" name="title" class="form-control" id="title"
                                    value="{{ old('title') }}">
                                @if ($errors->has('title'))
                                    <span style="color: red;">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group edit-box">
                                <label for="description">Description</label>
                                <textarea name="description"></textarea>
                                @if ($errors->has('description'))
                                    <span style="color: red;">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="image">Cover Image</label>
                                <input type="file" id="image" class="form-control" name="image"
                                    value="{{ old('image') }}">
                                @if ($errors->has('image'))
                                    <span style="color: red;">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="time">Assigned teacher</label>
                                <select class="form-control" name="teacher_id" id="teacher_id">
                                    <option value="">Please select teacher</option>
                                    @if ($teachers)
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->first_name }}
                                                {{ $teacher->last_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('teacher_id'))
                                    <span style="color: red;">{{ $errors->first('teacher_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="start_date">Start Date</label>
                                <input type="date" id="start_date" class="form-control" name="start_date"
                                    value="{{ old('start_date') }}">
                                @if ($errors->has('start_date'))
                                    <span style="color: red;">{{ $errors->first('start_date') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="end_date">End Date</label>
                                <input type="date" id="end_date" class="form-control" name="end_date"
                                    value="{{ old('end_date') }}">
                                @if ($errors->has('end_date'))
                                    <span style="color: red;">{{ $errors->first('end_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="fees">Fees</label>
                                <input type="number" id="fees" class="form-control" name="fees"
                                    value="{{ old('fees') }}">
                                @if ($errors->has('fees'))
                                    <span style="color: red;">{{ $errors->first('fees') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="duration">Duration in days</label>
                                <input type="number" id="duration" class="form-control" name="duration"
                                    value="{{ old('duration') }}">
                                @if ($errors->has('duration'))
                                    <span style="color: red;">{{ $errors->first('duration') }}</span>
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
        CKEDITOR.replace('description');
    </script>
@endsection
