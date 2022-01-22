@extends('student.layouts.master')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-upload"></i>
                    </div>
                    <div>Available Video
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header-title mb-4">
                            Available Video
                        </div>
                        <hr>
                        @if($videos->count() > 0)
                            <form action="{{ route('user.add_video') }}" method="post">
                                @csrf
                                <div class="row course_item m-0">
                                    @foreach($videos as $video)
                                        <div class="col-md-4 plr-2">
                                            <div class="items card" id="course_box{{ $video->id }}">
                                                <div class="course-box">
                                                    <h4>{{ $video->title }}</h4>
                                                    {!! $video->description !!}
                                                    <hr>
                                                    <ul class="mb-0">
                                                        <li class="font-weight-bold">Download Full Video</li>
                                                        <li>Pay INR <b>{{ $video->amount }}</b>
                                                        </li>
                                                    </ul>
                                                    <div class="sec_check">
                                                        <input class="form-check-input-field largerCheckbox" type="checkbox"
                                                        value="{{ $video->id }}" id="video_id{{ $video->id }}"
                                                        name="video_id[]">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('video_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <hr>
                                <span class="err-text text-danger"></span>
                                <input type="submit" value="Proceed" class="btn-pill btn btn-primary btn-lg"
                                    id="submit_btn">
                            </form>
                        @else
                            <div class="card-header-title mb-4">
                                <h5 class="text-bold text-danger">Currently no paid video
                                    available</h5>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('student.layouts.static_footer')
</div>
<script>
    $('input[type="checkbox"]').click(function () {
        if ($(this).prop('checked') == true) {
            let video_id = $(this)[0].value;
            $(`#course_box${video_id}`).addClass('bg-dark');
        }
        if ($(this).prop('checked') == false) {
            let video_id = $(this)[0].value;
            $(`#course_box${video_id}`).removeClass('bg-dark');
        }
    });

</script>
@endsection
