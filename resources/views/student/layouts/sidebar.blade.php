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
            <div class="logo-src"><img
                    src="{{ asset('frontend/assets/images/logo-inverse.png') }}" class="img-fluid">
            </div>
            <img src="{{ asset('frontend/images/shadow.png') }}" class="img-fluid mx-auto w-100">
            <ul class="vertical-nav-menu">
                <li class="{{ Request::is('user/profile') ? 'mm-active' : '' }}">
                    <a href="{{ route('user.profile') }}">
                        <i class="fa fa-graduation-cap metismenu-icon"></i>Students Profile
                    </a>
                </li>
                @if (Auth::user()->status == 1)
                <li class="{{ Request::is('user/attendance') ? 'mm-active' : '' }}">
                    <a href="{{ route('user.attendance') }}">
                        <i class="metismenu-icon fa fa-history"></i>Attendance
                    </a>
                </li>
                <li class="{{ Request::is('user/classes') ? 'mm-active' : '' }}">
                    <a href="{{ route('user.classes') }}">
                        <i class="metismenu-icon fa fa-users"></i>Classes
                    </a>
                </li>
                <li class="{{ Request::is('user/dairy') ? 'mm-active' : '' }}">
                    <a href="{{ route('user.dairy') }}">
                        <i class="metismenu-icon fa fa-address-card"></i>Diary
                    </a>
                </li>
                <li class="{{ Request::is('user/homework') ? 'mm-active' : '' }}">
                    <a href="{{ route('user.homework') }}">
                        <i class="metismenu-icon fa fa-book"></i>Homework
                    </a>
                </li>
                <li class="{{ Request::is('user/exam*') ? 'mm-active' : '' }}">
                    <a href="{{ route('user.exam.index') }}">
                        <i class="metismenu-icon fa fa-desktop"></i>Exam
                    </a>
                </li>
                <li class="{{ Request::is('user/courses*') ? 'mm-active' : '' }}">
                    <a href="{{ route('user.available_courses') }}">
                        <i class="metismenu-icon fa fa-book"></i>Join New Course
                    </a>
                </li>
                @endif
                <li class="{{ Request::is('user/payment') ? 'mm-active' : '' }}">
                    <a href="{{ route('user.payment') }}">
                        <i class="metismenu-icon fa fa-credit-card"></i>Payments
                    </a>
                </li>
                @if (Auth::user()->status == 1)
                <li class="{{ Request::is('user/change-password') ? 'mm-active' : '' }}">
                    <a href="{{ route('user.changePassword') }}">
                        <i class="metismenu-icon fa fa-cog"></i>Settings
                    </a>
                </li>
                @endif

            </ul>
        </div>
    </div>
</div>