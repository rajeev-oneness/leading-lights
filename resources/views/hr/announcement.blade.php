@extends('hr.layouts.master')
@section('title')
	Announcement
@endsection
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-bullhorn"></i>
                        </div>
                        <div> Announcement
                        </div>
                    </div>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-7">
                            <img src="{{ asset('frontend/images/event.jpg') }}" class="img-fluid mb-4">
                            <form action="{{ route('hr.announcement.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group justify-content-between">
                                            <label>
                                                <i class="fa fa-circle color-icon mr-2"></i>
                                                Title<span class="text-danger">*</span></label>
                                            <input type="text" name="title" class="w-89 form-control"
                                                value="{{ old('title') }}">
                                            @error('title')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="justify-content-between align-items-center">
                                            <label><i class="fa fa-circle color-icon mr-2"></i>Class<span
                                                    class="text-danger">*</span></label>
                                            <select class="w-89 form-control" name="class_id">
                                                <option value="all">All Students</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('class_id')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="justify-content-between align-items-center">
                                            <label>
                                                <i class="fa fa-circle color-icon mr-2"></i>Date<span
                                                    class="text-danger">*</span>
                                            </label>

                                            <input type="text" name="date" class="form-control datepicker"
                                                value="{{ old('date') }}" autocomplete="off">
                                            @error('date')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="d-sm-flex align-items-top mt-4">
                                    <p class="des dec"><span class="mr-2"><i
                                                class="fa fa-circle"></i></span>Description<span
                                            class="text-danger">*</span></p>

                                </div>
                                <textarea cols="10" id="editor1" name="desc" rows="5"></textarea>
                                @error('desc')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                                <br>
                                <button class="btn-pill btn btn-dark mt-4" type="submit">Submit Now</button>
                            </form>

                            {{-- <button class="btn-pill btn btn-dark mt-4">Submit Now</button> --}}
                        </div>
                        <div class="col-lg-5">
                            <div class="card-header-title section__title mb-sm-4">
                                Recent Announcement </div>
                            @if ($announcements->count() > 0)
                            @foreach ($announcements as $announcement)
                                <div class="items d-sm-flex align-items-center">
                                    {{-- <div class="pdf-box">
                                         <img src="images/pdf.png" class="img-fluid mx-auto">
                                    </div> --}}
                                    <div class="pdf-text">
                                        <h4>{{ $announcement->title }}</h4>
                                        <p>{!! $announcement->description ? $announcement->description : 'N/A' !!}</p>
                                        <div class="widget-content-left d-sm-flex align-items-center">
                                            <div class="widget-heading text-dark">
                                                <img src="{{ asset('frontend/assets/images/calander.png') }}"
                                                    class="img-fluid mx-auto">
                                            </div>
                                            <div class="widget-subheading ml-3">

                                                {{ date('M d, Y', strtotime($announcement->date)) }}<br>
                                                {{-- <span class="text">7:30 pm</span> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{ $announcements->links() }}
                            @else
                                No announcement available
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('hr.layouts.static_footer')
    </div>

    <script>
        $(document).ready(function() {

            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
                // maxItemCount:5,
                // searchResultLimit:5,
                // renderChoiceLimit:5
            });
        });
        $('#class_id').on('change', function() {
            let class_id = $('#class_id').val();
            $(".choices-multiple-remove-button").html('<option value="">** Loading...</option>');
            $(".choices-multiple-remove-button").html('<option value="">--Select a Country--</option>');
            $.ajax({
                url: "{{ route('admin.getStudentsByClass') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    class_id: class_id
                },
                dataType: 'json',
                type: 'post',
                beforeSend: function() {
                    $(".choices-multiple-remove-button").html(
                        '<option value="">** Loading....</option>');
                },
                success: function(response) {
                    if (response.msg == 'success') {
                        $('#choices-multiple-remove-button').html('');
                    }
                }
            });
        });



        $('.datepicker').datepicker({
            format: 'dd-M-yyyy',
            startDate: new Date(),
            daysOfWeekDisabled: [0],
            autoclose : true
        });
    </script>

@endsection
