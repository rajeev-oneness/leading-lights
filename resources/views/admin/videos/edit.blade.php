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
                    <li><a href="{{ route('admin.video.index') }}">All Video List</a></li>
                    <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                    <li><a href="#" class="active">Edit Video</a></li>
                </ul>
            </div>
            @include('admin.layouts.navbar')
        </div>
        <hr>
        <div class="dashboard-body-content">
            <h5>Edit Video</h5>
            <hr>
            <form action="{{ route('admin.video.update',$video->id) }}" method="POST"
                enctype="multipart/form-data" id="videoForm">
                @csrf
                @method('PUT')
                <div class="row m-0 pt-3">
                    <div class="col-lg-12">
                        <div class="form-group edit-box">
                            <label for="title">Title<span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" id="title"
                                value="{{ $video->title }}">
                            @if($errors->has('title'))
                                <span style="color: red;">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group edit-box">
                            <label for="video_link">Video Link<span class="text-danger">*</span></label>
                            <input type="text" name="video_link" class="form-control" id="video_link"
                                value="{{ $video->video_link }}">
                            @if($errors->has('video_link'))
                                <span style="color: red;">{{ $errors->first('video_link') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group edit-box">
                            <label for="video">Thumbnail Video<span class="text-danger">*</span></label>
                            <input type="file" name="video" class="form-control" id="video"
                                value="{{ $video->video }}">
                            @if($errors->has('video'))
                                <span style="color: red;">{{ $errors->first('video') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group edit-box">
                            <label for="name">Video type</label>
                            <select class="form-control" name="video_type">
                                <option value="1" @if($video->video_type == 1) selected @endif>Paid</option>
                                <option value="0" @if($video->video_type == 0) selected @endif>Free</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group edit-box">
                            <label for="video">Paid Video<span class="text-danger paid_video">*</span></label>
                            <input type="file" name="paid_video" class="form-control" id="paid_video"
                                value="{{ $video->paid_video }}">
                            @if($errors->has('paid_video'))
                                <span style="color: red;">{{ $errors->first('paid_video') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group edit-box">
                            <label for="name">Amount<span class="text-danger amount"></span></label>
                            <input type="number" name="amount" id="amount" min="0" class="form-control" value="{{ $video->amount }}" disabled>
                            <span class="text-danger amount_err"></span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group edit-box">
                            <label for="description">Description<span class="text-danger">*</span></label>
                            <textarea name="description">{{ $video->description }}</textarea>
                            @if($errors->has('description'))
                                <span
                                    style="color: red;">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>
                    {{-- <div class="col-lg-6">
                        <div class="form-group edit-box">
                            <label for="name">Status</label>
                            <select class="form-control" name="status">
                                <option value="1" @if($video->status == 1) selected @endif>Active</option>
                                <option value="0" @if($video->status == 0) selected @endif>Inactive</option>
                            </select>
                        </div>
                    </div> --}}
                </div>
                <div class="form-group d-flex justify-content-end">
                    <button type="submit" class="actionbutton" id="btnSubmit" >Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
        console.log($('#video_type').val());
        if ($('#video_type').val() == "0") {
            $('#amount').prop('disabled', true);
            $('.amount').text('');
            $('#paid_video').prop('disabled', true);
             $('.paid-video').text('');
        } else {
            $('#amount').prop('disabled', false);
            $('.amount').text('*');
            $('#paid_video').prop('disabled', false);
            $('.paid-video').text('*');
        }
    } );
    CKEDITOR.replace('description');

    $('#video_type').on('change', function () {
        if ($('#video_type').val() == "0") {
            $('#amount').prop('disabled', true);
            $('.amount').text('');
            $('#paid_video').prop('disabled', true);
            $('.paid-video').text('');
        } else {
            $('#amount').prop('disabled', false);
            $('.amount').text('*');
            $('#paid_video').prop('disabled', false);
            $('.paid-video').text('*');
        }
    });

    $('#btnSubmit').on('click', function (e) {
        e.preventDefault();
        if ($('#video_type').val() == "1") {
            if ($('#amount').val() == '') {
                $('.amount_err').text('This field is required');
                $('#btnSubmit').prop('disabled', true);
                document.getElementById("btnSubmit").style.cursor = 'no-drop';
            } else {
                $("#videoForm").submit();
                $('.amount_err').text('');
                $('#btnSubmit').prop('disabled', false);
                document.getElementById("btnSubmit").style.cursor = 'pointer';
            }
        } else {
            $("#videoForm").submit();
            $('.amount_err').text('');
            $('#btnSubmit').prop('disabled', false);
            document.getElementById("btnSubmit").style.cursor = 'pointer';
        }
    });

</script>
@endsection
