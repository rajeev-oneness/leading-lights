<div class="app-sidebar sidebar-shadow">
    <!--     <div class="app-header__logo">
            <div class="logo-src"></div>
            <div class="header__pane ml-auto">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div> -->
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button"
                class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <div class="logo-src"><img src="{{ asset('frontend/assets/images/logo-inverse.png') }}" class="img-fluid">
            </div>
            <img src="{{ asset('frontend/images/shadow.png') }}" class="img-fluid mx-auto w-100">
            <ul class="vertical-nav-menu">
                <li class="{{ Request::is('teacher/profile') ? 'mm-active' : '' }}">
                    <a href="{{ route('teacher.profile') }}">
                        <i class="metismenu-icon fa fa-text-height"></i>Teachers Profile
                    </a>
                </li>
                @if (Auth::user()->is_special_approved == 1)

                <li class="{{ Request::is('teacher/attendance') ? 'mm-active' : '' }}">
                    <a href="{{ route('teacher.attendance') }}">
                        <i class="metismenu-icon fa fa-history"></i>Attendance
                    </a>
                </li>
                <li class="{{ Request::is('teacher/assigned-groups') ? 'mm-active' : '' }}">
                    <a href="{{ route('teacher.assigned_groups') }}">
                        <i class="metismenu-icon fa fa-users"></i>Assigned Groups
                    </a>
                </li>
                <li class="{{ Request::is('teacher/access-class') ? 'mm-active' : '' }}">
                    <a href="{{ route('teacher.class') }}">
                        <i class="metismenu-icon fa fa-window-restore"></i>Access Class
                    </a>
                </li>
                <li class="{{ Request::is('teacher/home-task*') ? 'mm-active' : '' }}">
                    <a href="{{ route('teacher.homeTask') }}">
                        <i class="metismenu-icon fas fa-tasks"></i>Home task
                    </a>
                </li>
                <li class="{{ Request::is('teacher/task-submission') ? 'mm-active' : '' }}">
                    <a href="{{ route('teacher.studentSubmission') }}">
                        <i class="metismenu-icon fa fa-subscript"></i>Student’s Task submission

                    </a>
                </li>
                <li class="{{ Request::is('teacher/video-call') ? 'mm-active' : '' }}">
                    <a href="{{ route('teacher.videoCall') }}">
                        <i class="metismenu-icon fa fa-play"></i>Arrange video call

                    </a>
                </li>
                <li class="{{ Request::is('teacher/exam*') ? 'mm-active' : '' }}">
                    <a href="{{ route('teacher.exam.index') }}">
                        <i class="metismenu-icon fa fa-book"></i>Manage Exam

                    </a>
                </li>
                <li class="{{ Request::is('teacher/student*') ? 'mm-active' : '' }}">
                    <a href="{{ route('teacher.examSubmission') }}">
                        <i class="metismenu-icon fa fa-subscript"></i>Student’s Exam submission

                    </a>
                </li>
                <li class="{{ Request::is('teacher/change-password') ? 'mm-active' : '' }}">
                    <a href="{{ route('teacher.changePassword') }}">
                        <i class="metismenu-icon fa fa-cog"></i>Settings
                    </a>
                </li>
                @endif

            </ul>
        </div>
    </div>
</div>
