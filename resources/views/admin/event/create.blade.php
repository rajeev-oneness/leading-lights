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
                        <li><a href="{{ route('admin.classes.index') }}">All Event List</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">Add Event</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5>Add Event</h5>
                <hr>
                <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row m-0 pt-3">
                        <div class="col-lg-12">
                            <div class="form-group edit-box">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title"
                                    value="{{ old('title') }}">
                                @if ($errors->has('title'))
                                    <span style="color: red;">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="class">Class</label>
                                <select name="class" id="class_name" class="form-control">
                                    <option value="">Select Class</option>
                                    {{-- @foreach ($groups as $group)
                                        <option value="{{ $group->id . '-group' }}" class="text-info">
                                            {{ $group->name }}</option>
                                    @endforeach --}}
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id . '-class' }}" @if (old('class') == $class->id) selected @endif>
                                            {{ $class->name }}</option>
                                    @endforeach
                                </select>
                                @error('class')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="image">Image</label>
                                <input type="file" id="image" class="form-control" name="image"
                                    value="{{ old('image') }}">
                                @if ($errors->has('image'))
                                    <span style="color: red;">{{ $errors->first('image') }}</span>
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
                                <label for="start_time">Start Time</label>
                                <input type="time" id="start_time" class="form-control" name="start_time"
                                    value="{{ old('start_time') }}">
                                @if ($errors->has('start_time'))
                                    <span style="color: red;">{{ $errors->first('start_time') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="end_time">End Time</label>
                                <input type="time" id="end_time" class="form-control" name="end_time"
                                    value="{{ old('end_time') }}">
                                @if ($errors->has('end_time'))
                                    <span style="color: red;">{{ $errors->first('end_time') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group edit-box">
                                <label for="desc">Description</label>
                                <textarea name="desc"></textarea>
                                @if ($errors->has('desc'))
                                    <span style="color: red;">{{ $errors->first('desc') }}</span>
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
        CKEDITOR.replace('desc');
    </script>
@endsection
