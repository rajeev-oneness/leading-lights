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
                <li class="mm-active">
                    <a href="{{ route('teacher.profile') }}">
                        <i class="metismenu-icon fa fa-text-height"></i>Teachers Profile
                    </a>
                </li>
                <li>
                    <a href="{{ route('teacher.attendance') }}">
                        <i class="metismenu-icon fa fa-users"></i>Attendance
                    </a>
                </li>
                <li>
                    <a href="{{ route('teacher.class') }}">
                        <i class="metismenu-icon fa fa-window-restore"></i>Access Class
                    </a>
                </li>
                <li>
                    <a href="{{ route('teacher.homeTask') }}">
                        <i class="metismenu-icon fa fa-upload"></i>Upload home task
                    </a>
                </li>
                <li>
                    <a href="{{ route('teacher.studentSubmission') }}">
                        <i class="metismenu-icon fa fa-subscript"></i>Student’s submission

                    </a>
                </li>
                <li>
                    <a href="{{ route('teacher.videoCall') }}">
                        <i class="metismenu-icon fa fa-play"></i>Arrange video call

                    </a>
                </li>
                <li>
                    <a href="{{ route('teacher.manageExam') }}">
                        <i class="metismenu-icon fa fa-book"></i>Manage Exam

                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon fa fa-cog"></i>Settings
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>