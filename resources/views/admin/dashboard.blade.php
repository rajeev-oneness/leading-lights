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
                    {{-- <li><a href="dashboard.html">Home</a></li> --}}
                    {{-- <li class="text-white"><i class="fa fa-chevron-right"></i></li> --}}
                    <li><a href="{{ route('admin.dashboard') }}" class="active">Dashboard</a></li>

                </ul>
            </div>
            @include('admin.layouts.navbar')
        </div>
        <hr>
        <div class="dashboard-body-content-upper p-0">
            <div class="row m-0">
                <div class="col-12 col-md-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <a href="{{ route('admin.teachers.index') }}">
                            <div class="card-body gpcVCf">
                                <div class="icon-sec w-25">
                                    {{-- <img src="{{ asset('img/Total-Customers.png') }}">
                                    --}}
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="text-sec">
                                    <h3>{{ $teachers_count }}<span>Total Teachers</span></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <a href="{{ route('admin.students.index') }}">
                            <div class="card-body gpcVCf">
                                <div class="icon-sec w-25">
                                    {{-- <img src="{{ asset('img/new-Customers.png') }}">
                                    --}}
                                    <i class="fas fa-user-graduate" aria-hidden="true"></i>
                                </div>
                                <div class="text-sec">
                                    <h3>{{ $students_count }} <span>Total Students</span></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <a href="{{ route('admin.hr.index') }}">
                            <div class="card-body gpcVCf">
                                <div class="icon-sec w-25">
                                    {{-- <img src="{{ asset('img/new-Customers.png') }}">
                                    --}}
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <div class="text-sec">
                                    <h3>{{ $hr_count }} <span>Total HR</span></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <a href="{{ route('admin.vlog.index') }}">
                            <div class="card-body gpcVCf">
                                <div class="icon-sec w-25">
                                    <i class="fas fa-video"></i>
                                </div>
                                <div class="text-sec">
                                    <h3>{{ $vlog_count }} <span>Total VLOG</span></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <a href="{{ route('admin.video.index') }}">
                            <div class="card-body gpcVCf">
                                <div class="icon-sec w-25">
                                    <i class="fas fa-video"></i>
                                </div>
                                <div class="text-sec">
                                    <h3>{{ $video_count }} <span>Total Videos</span></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <a href="{{ route('admin.classes.index') }}">
                            <div class="card-body gpcVCf">
                                <div class="icon-sec w-50">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <div class="text-sec">
                                    <h3>{{ $regular_class_count }} <span> No of Regular Classes</span></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <a href="{{ route('admin.courses.index') }}">
                            <div class="card-body gpcVCf">
                                <div class="icon-sec w-50">
                                    <i class="fas fa-book-reader"></i>
                                </div>
                                <div class="text-sec">
                                    <h3>{{ $flash_course_count }} <span> No of Flash Courses</span></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <a href="{{ route('admin.groups.index') }}">
                            <div class="card-body gpcVCf">
                                <div class="icon-sec w-50">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="text-sec">
                                    <h3>{{ $group_count }} <span> No of Student Groups</span></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <a href="{{ route('admin.testimonial.index') }}">
                            <div class="card-body gpcVCf">
                                <div class="icon-sec w-50">
                                    <i class="fas fa-newspaper-o"></i>
                                </div>
                                <div class="text-sec">
                                    <h3>{{ $testimonials_count }} <span> No of Testimonials</span></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <a href="{{ route('admin.notice.index') }}">
                            <div class="card-body gpcVCf">
                                <div class="icon-sec w-50">
                                    <i class="fas fa-newspaper-o"></i>
                                </div>
                                <div class="text-sec">
                                    <h3>{{ $news_count }} <span> No of News</span></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <a href="{{ route('admin.holidays.index') }}">
                            <div class="card-body gpcVCf">
                                <div class="icon-sec w-50">
                                    <i class="fas fa-snowman"></i>
                                </div>
                                <div class="text-sec">
                                    <h3>{{ $holiday_count }} <span> No of Holidays</span></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <a href="{{ route('admin.subjects.index') }}">
                            <div class="card-body gpcVCf">
                                <div class="icon-sec w-50">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                <div class="text-sec">
                                    <h3>{{ $subject_count }} <span> Available Subjects</span></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <a href="{{ route('admin.exams.index') }}">
                            <div class="card-body gpcVCf">
                                <div class="icon-sec w-50">
                                    <i class="fas fa-chalkboard"></i>
                                </div>
                                <div class="text-sec">
                                    <h3>{{ $this_week_exam_count }} <span> No of exam organized in this week</span></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <a href="{{ route('admin.arrange_classes') }}">
                            <div class="card-body gpcVCf">
                                <div class="icon-sec w-50">
                                    <i class="fas fa-chalkboard"></i>
                                </div>
                                <div class="text-sec">
                                    <h3>{{ $this_week_arrange_class_count }} <span> No of class scheduled in this week</span></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <a href="{{ route('admin.events.index') }}">
                            <div class="card-body gpcVCf">
                                <div class="icon-sec w-50">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <div class="text-sec">
                                    <h3>{{ $this_week_no_of_events }} <span> No of events scheduled in this week</span></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <a href="{{ route('admin.announcement.index') }}">
                            <div class="card-body gpcVCf">
                                <div class="icon-sec w-50">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <div class="text-sec">
                                    <h3>{{ $this_week_no_of_announcement }} <span> No of announcement scheduled in this week</span></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
