@extends('student.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-graduation-cap"></i>
                        </div>
                        <div>Diary
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div id="dairy_calendar"></div>
                        </div>
                    </div>
                </div>
                {{-- @foreach ($events as $event)
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="media flex-wrap w-100 align-items-center">
                                <div class="media-body">
                                    <a href="javascript:void(0)">{{ $event->title }}</a>
                                </div>
                                <div>
                                    <span>{{ date('M d, Y', strtotime($event->start_date)) }}
                                        @if ($event->end_date)
                                            - {{ date('M d, Y', strtotime($event->end_date)) }}
                                        @endif
                                    </span>
                                    <br>
                                    <span class="text-success">{{ date('h:i A', strtotime($event->start_time)) }}
                                        @if ($event->end_time)
                                            - {{ date('h:i A', strtotime($event->end_time)) }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet.
                                Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem
                                nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan
                                ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat
                                consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia
                                nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus
                                condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum
                                fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut
                                aliquam massa nisl quis neque. Suspendisse in orci enim. </p>
                        </div>
                    </div>
                </div>
                @endforeach --}}
                {{-- <p>Latest Events</p> --}}
                <div class="col-lg-5">
                    <h3>Latest Events</h3>
                    @if (!$events->isEmpty())
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($events as $key => $event)
                                <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                                    
                                    <div class="items align-items-center">
                                        <div class="pdf-box">
                                            <img src="{{ asset($event->image) }}"
                                                class="img-fluid rounded  mx-auto w-100 mb-3">
                                        </div>
                                        <div class="pdf-text">
                                            <h4>{{ $event->title }}</h4>
                                            {!! $event->desc !!}
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
                                   
                                </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        @else
                           <p class="alert alert-danger"> No events are available </p>
                        @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('teacher.layouts.static_footer')
    </div>
    <script src='https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js'></script>

    <script>
        $(document).ready(function() {
            $('#dairy_calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                displayEventTime: true,
                themeSystem: 'bootstrap4',
                events: "{{ route('user.dairy') }}",

                eventRender: function(event, element) {
                    element.find('.fc-title').append("<br/>" + event.description);
                },
                // eventMouseover: function(calEvent, jsEvent) {
                //     var tooltip =
                //         '<div class="tooltipevent" style="width:100px;height:100px;background:#ccc;position:absolute;z-index:10001;">' +
                //         calEvent.end_time + '</div>';
                //     var $tooltip = $(tooltip).appendTo('body');

                //     $(this).mouseover(function(e) {
                //         $(this).css('z-index', 10000);
                //         $tooltip.fadeIn('500');
                //         $tooltip.fadeTo('10', 1.9);
                //     }).mousemove(function(e) {
                //         $tooltip.css('top', e.pageY + 10);
                //         $tooltip.css('left', e.pageX + 20);
                //     });
                // },
                // eventMouseout: function(calEvent, jsEvent) {
                //     $(this).css('z-index', 8);
                //     $('.tooltipevent').remove();
                // },
            });
        })
    </script>
@endsection
