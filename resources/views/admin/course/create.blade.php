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
                        <li><a href="{{ route('admin.courses.index') }}">All Courses List</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">Add Course</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5>Add Course</h5>
                <hr>
                <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row m-0 pt-3">
                        <div class="col-lg-12">
                            <div class="form-group edit-box">
                                {{-- <label for="title">Course title</label> --}}
                                 <label for="review">Course title<span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" id="title"
                                    value="{{ old('title') }}">
                                @if ($errors->has('title'))
                                    <span style="color: red;">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group edit-box">
                                {{-- <label for="description">Description</label> --}}
                                 <label for="review">Description<span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" cols="2" rows="2">{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span style="color: red;">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group edit-box">
                                {{-- <label for="description">Description</label> --}}
                                 <label for="review">This course includes<span class="text-danger">*</span></label>
                                <textarea name="course_content" class="form-control" cols="2" rows="2">{{ old('course_content') }}</textarea>
                                @if ($errors->has('course_content'))
                                    <span style="color: red;">{{ $errors->first('course_content') }}</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                {{-- <label for="start_date">Start Date</label> --}}
                                 <label for="review">Start Date<span class="text-danger">*</span></label>
                                <input type="date" id="start_date" class="form-control" name="start_date"
                                    value="{{ old('start_date') }}">
                                @if ($errors->has('start_date'))
                                    <span style="color: red;">{{ $errors->first('start_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                {{-- <label for="image">Cover Image</label> --}}
                                 <label for="review">No of sessions<span class="text-danger">*</span></label>
                                <input type="number" id="sessions" class="form-control" name="sessions"
                                    value="{{ old('sessions') }}">
                                @if ($errors->has('sessions'))
                                    <span style="color: red;">{{ $errors->first('sessions') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                {{-- <label for="fees">Fees</label> --}}
                                 <label for="review">Fees(INR)<span class="text-danger">*</span></label>
                                <input type="number" id="fees" class="form-control" name="fees"
                                    value="{{ old('fees') }}">
                                @if ($errors->has('fees'))
                                    <span style="color: red;">{{ $errors->first('fees') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                {{-- <label for="image">Cover Image</label> --}}
                                 <label for="review">Cover Image<span class="text-danger">*</span></label>
                                <input type="file" id="image" class="form-control" name="image"
                                    value="{{ old('image') }}">
                                @if ($errors->has('image'))
                                    <span style="color: red;">{{ $errors->first('image') }}</span>
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
        CKEDITOR.replace('course_content');
    </script>
@endsection
