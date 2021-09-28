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
                        <li><a href="{{ route('admin.banner.index') }}">All banners</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">Edit banner</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar');
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5>Edit Page</h5>
                <hr>
                <form action="{{ route('admin.banner.update', $page_details->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row m-0 pt-3">
                        <div class="col-lg-12">
                            <div class="form-group edit-box">
                                <label for="name">Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ $page_details->name }}">
                                @if ($errors->has('name'))
                                    <span style="color: red;">{{ $errors->first('name') }}</span>
                                @endif
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

                                @if ($page_details->image)
                                    <img src="{{ asset($page_details->image) }}" alt="" height="100" width="100">
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="name">Status</label>
                                <select class="form-control" name="status">
                                    <option value="1" @if ($page_details->status == 1) selected @endif>Active</option>
                                    <option value="0" @if ($page_details->status == 0) selected @endif>Inactive</option>
                                </select>
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
        CKEDITOR.replace('page_content');
        if (CKEDITOR.status == 'loaded') {
            // The API can now be fully used.
            CKEDITOR.instances["page_content"].setReadOnly(true);
        }
    </script>
@endsection
