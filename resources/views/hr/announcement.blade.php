@extends('hr.layouts.master')
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

            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-7">
                            {{-- <div class="card-header-title font-size-lg text-capitalize mb-4">
                                Announcement
                            </div>
                            <div class="d-sm-flex align-items-center   mb-4">
                                <p class="des dec"><span class="mr-2"><i class="fa fa-circle"></i></span>Description</p>
                                <div class="d-sm-flex align-items-baseline">
                                     <p class="des  mr-2"><span class="mr-2"><i class="fa fa-circle"></i></span>Date</p>
                                    <form class="form">                                                 
                                        <input type="date" name="" class="form-control">
                                    </form>
                                </div>
                             </div>
                            <textarea cols="80" id="editor1" name="editor1" rows="10"></textarea> --}}
                            <form class="form" action="{{ route('hr.announcement.store') }}" method="POST"
                                enctype="multipart/form-data">
                                <form action="{{ route('hr.announcement.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group d-flex justify-content-between">
                                                <label>
                                                    <i class="fa fa-circle color-icon mr-2"></i>
                                                    Title</label>
                                                <input type="text" name="title" class="w-89"
                                                    value="{{ old('title') }}">
                                                @error('title')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <label><i class="fa fa-circle color-icon mr-2"></i>Class</label>
                                                <select class="w-89" id="choices-multiple-remove-button" multiple
                                                    name="class_id[]">
                                                    <option value="">Select Classes</option>
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
                                            <div class="d-flex justify-content-between align-items-center">
                                                <label>
                                                    <i class="fa fa-circle color-icon mr-2"></i>Date
                                                </label>

                                                <input type="date" name="date" class="form-control w-75 datepicker"
                                                    value="{{ old('date') }}">
                                                @error('date')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn-pill btn btn-dark mt-4" type="submit">Submit Now</button>
                                </form>

                                {{-- <button class="btn-pill btn btn-dark mt-4">Submit Now</button> --}}
                        </div>
                        <div class="col-lg-5">
                            <div class="card-header-title mb-4">
                                Recent Announcement </div>
                            @foreach ($announcements as $announcement)
                                <div class="items d-sm-flex align-items-center">
                                    {{-- <div class="pdf-box">
                                         <img src="images/pdf.png" class="img-fluid mx-auto">
                                    </div> --}}
                                    <div class="pdf-text">
                                        <h4>{{ \Illuminate\Support\Str::limit($announcement->title, 15) }}</h4>
                                        {{-- <p>This is Photoshop's version  of Lorem Ipsum. </p> --}}
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
            format: 'yyyy-mm-dd',
            startDate: new Date(),
            daysOfWeekDisabled: [0]
        });
    </script>

@endsection
