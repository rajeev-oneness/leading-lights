@extends('hr.layouts.master')
@section('title')
	Event
@endsection
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
                        <div> Manage Event
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
            <div class="tabs-animation">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <img src="{{ asset('frontend/images/event.jpg') }}" class="img-fluid mb-4">
                                {{-- <div class="card-header-title mb-4">
                                    Summer Camp
                                </div> --}}

                                <form class="form" action="{{ route('hr.manage-event.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-2 des dec"><i
                                                class="fa fa-circle color-icon mr-2"></i>Title<span
                                                class="text-danger">*</span> </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="title" name="title" class="form-control"
                                                value="{{ old('title') }}">
                                            @error('title')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 des dec"><i
                                                class="fa fa-circle color-icon mr-2"></i>Class<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <select name="class" id="class_name" class="form-control">
                                                <option value="all">All Students</option>
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
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 des dec"><i
                                                class="fa fa-circle color-icon mr-2"></i>Image<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="file" id="image" name="image"
                                                accept="image/png, image/gif, image/jpeg" class="form-control">
                                            @error('image')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <span for="start_date" class="des dec"><i
                                                    class="fa fa-circle color-icon mr-2 mb-2"></i>Start Date<span
                                                    class="text-danger">*</span></span>
                                            <input type="text" id="start_date" name="start_date"
                                                class="form-control datepicker" value="{{ old('start_date') }}">
                                            @error('start_date')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <span for="end_date" class="des dec"><i
                                                    class="fa fa-circle color-icon mr-2 mb-2"></i>End Date</span>
                                            <input type="text" id="end_date" name="end_date" class="form-control datepicker"
                                                value="{{ old('end_date') }}">
                                            @error('end_date')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <span for="start_time" class="des dec"><i
                                                    class="fa fa-circle color-icon mr-2 mb-2"></i>Start Time<span
                                                    class="text-danger">*</span></span>
                                            <input type="time" id="start_time" name="start_time"
                                                class="form-control" value="{{ old('start_time') }}">
                                            @error('start_time')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <span for="end_time" class="des dec"><i
                                                    class="fa fa-circle color-icon mr-2 mb-2"></i>End Time<span
                                                    class="text-danger">*</span></span>
                                            <input type="time" id="end_time" name="end_time"
                                                class="form-control" value="{{ old('end_time') }}">
                                            @error('end_time')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-sm-flex align-items-top   mb-4">
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
                            </div>
                            <div class="col-lg-4">
                                <div class="card-header-title mb-4">
                                    Recent Event </div>
                                @if ($events->count() > 0)
                                @foreach ($events as $event)
                                    <div class="items align-items-center">
                                        <div class="pdf-box">
                                            <img src="{{ asset($event->image) }}"
                                                class="img-fluid rounded  mx-auto w-100 mb-3">
                                        </div>
                                        <div class="pdf-text">
                                            <h4>{{ \Illuminate\Support\Str::limit($event->title, 15) }}</h4>
                                            <p>{!! $event->desc !!}</p>
                                            <div
                                                class="widget-content-left d-sm-flex align-items-center justify-content-flex-start">
                                                <div class="widget-heading text-dark"><img
                                                        src="{{ asset('frontend/assets/images/calander.png') }}"
                                                        class="img-fluid mx-auto"></div>
                                                <div class="widget-subheading ml-3">
                                                    {{ date('M d, Y', strtotime($event->start_date)) }}
                                                    @if ($event->end_date)
                                                        - {{ date('M d, Y', strtotime($event->end_date)) }}
                                                    @endif
                                                    <br><span
                                                        class="text">{{ date('h:i A', strtotime($event->start_time)) }}
                                                        @if ($event->end_time)
                                                            - {{ date('h:i A', strtotime($event->end_time)) }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- @foreach ($events as $event)
                                    <div class="items d-sm-flex align-items-center">
                                        <div class="pdf-box w-40">
                                            <img src="{{ asset($event->image) }}"
                                                class="img-fluid rounded  w-100 mx-auto">
                                        </div>
                                        <div class="pdf-text">
                                            <h4>{{ \Illuminate\Support\Str::limit($event->title, 15) }}</h4>
                                            <p>{!! \Illuminate\Support\Str::limit($event->desc, 50) !!}</p>
                                            <div class="widget-content-left d-sm-flex align-items-center">
                                                <div class="widget-heading text-dark"><img
                                                        src="{{ asset('frontend/assets/images/calander.png') }}"
                                                        class="img-fluid mx-auto"></div>
                                                <div class="widget-subheading ml-3">
                                                    {{ date('M d, Y', strtotime($event->start_date)) }}
                                                    @if ($event->end_date)
                                                        - {{ date('M d, Y', strtotime($event->end_date)) }}
                                                    @endif
                                                    <br><span
                                                        class="text">{{ date('h:i A', strtotime($event->start_time)) }}
                                                        @if ($event->end_time)
                                                            - {{ date('h:i A', strtotime($event->end_time)) }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach --}}
                                {{-- <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                      <li class="page-item"><a class="page-link">{{ $events->links() }}</a></li>
                                    </ul>
                                  </nav> --}}
                                {{ $events->links() }}
                                @else
                                No events available
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @include('hr.layouts.static_footer')
    </div>
    <script>
        $('#class_name').on('click', function() {
            var class_name = $('#class_name').val();
            var after_split = class_name.split("-")[1];
            if (after_split === 'group') {
                $('.datepicker').datepicker('destroy').datepicker({
                    format: 'yyyy-mm-dd',
                    startDate: new Date(),
                    // daysOfWeekDisabled: [0]
                });
            } else {
                $('.datepicker').datepicker('destroy').datepicker({
                    format: 'yyyy-mm-dd',
                    startDate: new Date(),
                    daysOfWeekDisabled: [0]
                });
            }
        })
        setTimeout(() => {
            $('.alert-success').css('display', 'none');
            $('.alert-warning').css('display', 'none');
        }, 4000);
        $('.clockpicker').clockpicker({
            placement: 'bottom',
            align: 'right',
            donetext: 'Done',
            'default': 'now',
            // autoclose: true,
        });
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: new Date(),
            daysOfWeekDisabled: [0]
        });
    </script>
@endsection
