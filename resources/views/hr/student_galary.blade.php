@extends('hr.layouts.master')
@section('content')
    <style>
        .popover,
        .tooltip {
            opacity: unset;
        }

    </style>
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-bullhorn"></i>
                        </div>
                        <div> Student Galary
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabs-animation">
                <div class="card mb-3">
                    <div class="card-body">
                        @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row mt-4">
                                    <div class="col-lg-12">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="card-header-title font-size-lg text-capitalize mb-4">
                                                    Image upload
                                                </div>
                                                <form class="form" id="documentUploadForm"
                                                    action="{{ route('hr.student_galary') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="file-upload">
                                                        <button class="file-upload-btn" type="button"
                                                            onclick="$('.file-upload-input').trigger( 'click' )">Add File</button>
                                                        {{-- <button class="file-upload-btn" type="button">Add Image</button> --}}

                                                        <div class="image-upload-wrap">
                                                            <input class="file-upload-input" type='file' accept="pdf/*"
                                                                id="img_upload" name="upload_file" />
                                                            <div class="drag-text">
                                                                <h3>Drag and drop an image or select add image</h3>
                                                            </div>
                                                        </div>
                                                        <div class="file-upload-content">
                                                            <img class="file-upload-image" src="#" alt="your image" />
                                                            {{-- <div class="image-title-wrap">
                                            <button type="button" onclick="removeUpload()" class="remove-image">Remove
                                                <span class="image-title">Uploaded Image</span></button>
                                        </div> --}}
                                                            {{-- <img id="img_prv" style="max-width: 150px;max-height: 150px" class="img-thumbnail" src=""> --}}
                                                        </div>
                                                        @if ($errors->has('upload_file'))
                                                            <span style="color: red;"
                                                                id="file_err">{{ $errors->first('upload_file') }}</span>
                                                        @endif
                                                        <span id="choose_file"></span>
                                                        <div class="file_error" style="color : red;">Please Fill This field.
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn-pill btn btn-dark mt-4" name="submit"
                                                        id="button_submit">Submit</button>
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
            <section id="services" class="all_corce_list">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sub-heading text-center wow fadeInDown" data-wow-duration="2s">
                                <h2>Galary</h2>
                            </div>
                        </div>
                    </div>
                    @if ($photos->count() > 0)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row m-0">
                                @foreach ($photos as $photo)
                                    <div class="col-12 col-lg-4 mb-3 pl-1 pr-1">
                                        <a>
                                            <div class="item card border-0 cou_list">
                                                <div class="features-box">
                                                    <div class="">
                                                        <img src="
                                                                {{ asset($photo->image) }}" class="img-fluid mx-auto">
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @else
                        <h5 class="text-center">No photos available</h5>
                    @endif
                </div>
            </section>
        </div>
        @include('hr.layouts.static_footer')
    </div>
    <script>
        $(document).ready(function() {
            var validated = false;
            $('.file_error').hide();
        });
        $(document).on('change', 'input[name^="upload_file"]', function(ev) {
            var file_name = this.files[0].name;
            $('#file_err').html('');
            $("#choose_file").html(`One file chosen: <span class="text-info">${file_name}</span>`);
        });
    </script>
@endsection
