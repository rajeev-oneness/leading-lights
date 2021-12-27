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
                        <li><a href="{{ route('admin.notice.index') }}">All News</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">Add news</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5>Edit News</h5>
                <hr>
                <form action="{{ route('admin.notice.update', $notice->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row m-0 pt-3">
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                {{-- <label for="name">Holiday Name</label> --}}
                                 <label for="title">Title<span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" id="title"
                                    value="{{ $notice->title }}">
                                @if ($errors->has('title'))
                                    <span style="color: red;">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                 <label for="date">Date</label>
                                <input type="date" id="date" class="form-control" name="date"
                                    value="{{ $notice->date }}">
                                @if ($errors->has('date'))
                                    <span style="color: red;">{{ $errors->first('date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group edit-box">
                                <label for="desc">Description<span class="text-danger">*</span></label>
                                <textarea name="desc">{{ $notice->desc }}</textarea>
                                @if ($errors->has('desc'))
                                    <span style="color: red;">{{ $errors->first('desc') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="actionbutton">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        CKEDITOR.replace('desc');
    </script>
@endsection
