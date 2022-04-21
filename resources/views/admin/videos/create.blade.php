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
                    <li><a href="#" class="active">Add Video</a></li>
                </ul>
            </div>
            @include('admin.layouts.navbar')
        </div>
        <hr>
        <div class="dashboard-body-content">
            <h5>Add Video</h5>
            <hr>
            <form action="{{ route('admin.video.store') }}" method="POST"
                enctype="multipart/form-data" id="videoForm">
                @csrf
                <div class="row m-0 pt-3">
                    <div class="col-lg-12">
                        <div class="form-group edit-box">
                            <label for="title">Title<span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" id="title"
                                value="{{ old('title') }}">
                            @if($errors->has('title'))
                                <span style="color: red;">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group edit-box">
                            <label for="title">Video Link<span class="text-danger">*</span></label>
                            <input type="text" name="video_link" class="form-control" id="video_link"
                                value="{{ old('video_link') }}">
                            @if($errors->has('video_link'))
                                <span style="color: red;">{{ $errors->first('video_link') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="form-group edit-box">
                            <label for="video">Video<span class="text-danger">*</span></label>
                            <input type="file" name="video" class="form-control" id="video"
                                value="{{ old('video') }}">
                            @if($errors->has('video'))
                                <span style="color: red;">{{ $errors->first('video') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group edit-box">
                            <label for="name">Video type</label>
                            <select class="form-control" name="video_type" id="video_type">
                                <option value="0">Free</option>
                                <option value="1">Paid</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group edit-box">
                            <label for="video">Paid Video<span class="text-danger paid-video">*</span></label>
                            <input type="file" name="paid_video" class="form-control" id="paid_video"
                                disabled>
                            @if($errors->has('paid_video'))
                                <span style="color: red;">{{ $errors->first('paid_video') }}</span>
                            @endif
                            <span class="text-danger paid_video_err"></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group edit-box">
                            <label for="name">Amount<span class="text-danger amount"></span></label>
                            <input type="number" name="amount" id="amount" min="0" class="form-control" disabled>
                            <span class="text-danger amount_err"></span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group edit-box">
                            <label for="description">Description<span class="text-danger">*</span></label>
                            <textarea name="description"></textarea>
                            @if($errors->has('description'))
                                <span
                                    style="color: red;">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group d-flex justify-content-end">
                    <button type="submit" class="actionbutton" id="btnSubmit">SAVE</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('description');

    $('#video_type').on('change',function() {
            if ($('#video_type').val() == "0") {
                $('#amount').prop('disabled', true);
                $('.amount').text('');
                $('#paid_video').prop('disabled', true);
                $('.paid-video').text('');
            }else{
                $('#amount').prop('disabled', false);
                $('.amount').text('*');
                $('#paid_video').prop('disabled', false);
                $('.paid-video').text('*');
            }
        });

    $('#btnSubmit').on('click',function (e) {
        e.preventDefault();
        var errorFlagOne = 0;
        if ($('#video_type').val() == "1") {
            if ($('#amount').val() == '') {
                $('.amount_err').text('This field is required');
                $('#btnSubmit').prop('disabled', true);
                document.getElementById("btnSubmit").style.cursor = 'no-drop';
                errorFlagOne = 1;
            }
            if ($('#paid_video').val() == '') {
                $('.paid_video_err').text('This field is required');
                $('#btnSubmit').prop('disabled', true);
                document.getElementById("btnSubmit").style.cursor = 'no-drop';
                errorFlagOne = 1;
            }
            if (errorFlagOne == 1) {
                return false;
            }
            else{
                $("#videoForm").submit();
                $('.amount_err').text('');
                $('#btnSubmit').prop('disabled', false);
                document.getElementById("btnSubmit").style.cursor = 'pointer';
            }
        }else{
            $("#videoForm").submit();
            $('.amount_err').text('');
            $('#btnSubmit').prop('disabled', false);
            document.getElementById("btnSubmit").style.cursor = 'pointer';
        }
     });
</script>
@endsection
