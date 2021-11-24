<div class="app-sidebar sidebar-shadow">
    <!--      <div class="app-header__logo">
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
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            {{-- "{{ asset('frontend/assets/images/logo-inverse.png') }}" --}}
            <div class="logo-src"><img src="{{ asset('frontend/assets/images/logo-inverse.png') }}"
                    class="img-fluid"></div>
            <img src="{{ asset('frontend/images/shadow.png') }}" class="img-fluid mx-auto w-100">
            <ul class="vertical-nav-menu">
                <li class="{{ Request::is('hr/profile') ? 'mm-active' : '' }}">
                    <a href="{{ route('hr.profile') }}">
                        <i class=" metismenu-icon fa fa-universal-access"></i>HR’s Profile
                    </a>
                </li>
                @if (Auth::user()->status == 1)
                <li class="{{ Request::is('hr/attendance*') ? 'mm-active' : '' }}">
                    <a href="{{ route('hr.attendance') }}">
                        <i class="metismenu-icon fa fa-users"></i>Attendance
                    </a>
                </li>
                <li class="{{ Request::is('hr/event-management') ? 'mm-active' : '' }}">
                    <a href="{{ route('hr.manage-event') }}">
                        <i class="metismenu-icon fa fa-music"></i>Manage Event
                    </a>
                </li>
                <li class="{{ Request::is('hr/announcement') ? 'mm-active' : '' }}">
                    <a href="{{ route('hr.announcement') }}">
                        <i class="metismenu-icon fa fa-bullhorn"></i>Announcement
                    </a>
                </li>
                <li class="{{ Request::is('hr/download_report') ? 'mm-active' : '' }}">
                    <a href="{{ route('hr.download_report') }}">
                        <i class="metismenu-icon fa fa-download"></i>Download report

                    </a>
                </li>
                <li class="{{ Request::is('hr/change-password') ? 'mm-active' : '' }}">
                    <a href="{{ route('hr.changePassword') }}">
                        <i class="metismenu-icon fa fa-cog"></i>Settings
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
