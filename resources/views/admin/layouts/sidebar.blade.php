<div class="dashboard-menubar" id="sidebar">
    <div class="image-wrapper logo-wrapper customer-logo">
        <img src="{{ asset('img/logo-inverse.png') }}" class="img-fluid logo">
    </div>
    <img src="{{ asset('img/shadow.png') }}" class="img-fluid mx-auto w-100">
    <nav class="">
        <ul class=" menu">
            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a
                    href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
            <?php if (Auth::check() && Auth::user()->role->id == 5) { ?>
            <li class="{{ Request::is('super-admin/admin *') ? 'active' : '' }}"><a
                    href="{{ route('superAdmin.admin.index') }}"><i class="fas fa-user-graduate"
                        aria-hidden="true"></i>Admin Management</a></li>
            <?php } ?>

            <li class="{{ Request::is('admin/students*') ? 'active' : '' }}"><a
                    href="{{ route('admin.students.index') }}"><i class="fas fa-user-graduate"
                        aria-hidden="true"></i>Student Management</a></li>


            <li class="{{ Request::is('admin/teachers*') ? 'active' : '' }}"><a
                    href="{{ route('admin.teachers.index') }}"><i class="fa fa-user"
                        aria-hidden="true"></i>Teacher
                    Management</a></li>
            <li class="{{ Request::is('admin/hr*') ? 'active' : '' }}"><a href="{{ route('admin.hr.index') }}"><i
                        class="fa fa-user" aria-hidden="true"></i>HR
                    Management</a></li>
            <li class="{{ Request::is('admin/transaction*') ? 'active' : '' }}"><a
                    href="{{ route('admin.transaction.index') }}"><i class="fas fa-wallet"></i>Transaction
                    Management</a>
            </li>
            <li class="{{ Request::is('admin/vlog*') ? 'active' : '' }}"><a
                    href="{{ route('admin.vlog.index') }}"><i class="fa fa-video-camera" aria-hidden="true"></i>VLOG
                    Management</a></li>
            <li class="{{ Request::is('admin/video*') ? 'active' : '' }}"><a
                    href="{{ route('admin.video.index') }}"><i class="fa fa-video-camera"
                        aria-hidden="true"></i>Free/Paid video Management</a></li>
            <li class="{{ Request::is('admin/qualification*') ? 'active' : '' }}"><a
                    href="{{ route('admin.qualifications.index') }}"><i class="fas fa-chalkboard"></i>Academic
                    Qualification
                    Management</a></li>
            <li class="{{ Request::is('admin/classes*') ? 'active' : '' }}"><a
                    href="{{ route('admin.classes.index') }}"><i class="fas fa-chalkboard"></i>Student Class
                    Management</a></li>
            <li class="{{ Request::is('admin/subjects*') ? 'active' : '' }}"><a
                    href="{{ route('admin.subjects.index') }}"><i class="fas fa-book-open"></i>Student Subject
                    Management</a></li>
            <li class="{{ Request::is('admin/groups*') ? 'active' : '' }}"><a
                    href="{{ route('admin.groups.index') }}"><i class="fas fa-users"></i>Student Group
                    Management</a></li>
            <li class="{{ Request::is('admin/arrange-classes*') ? 'active' : '' }}"><a
                    href="{{ route('admin.arrange_classes') }}"><i class="fas fa-chalkboard"></i>Arrange Class
                    Management</a></li>
            <li class="{{ Request::is('admin/exams*') ? 'active' : '' }}"><a
                    href="{{ route('admin.exams.index') }}"><i class="fas fa-chalkboard"></i>Manage Exams</a></li>
            <li class="{{ Request::is('admin/special-courses*') ? 'active' : '' }}"><a
                    href="{{ route('admin.special-courses.index') }}"><i class="fas fa-book-open"></i>Course
                    Management</a>
            </li>
            <li class="{{ Request::is('admin/courses*') ? 'active' : '' }}"><a
                    href="{{ route('admin.courses.index') }}"><i class="fas fa-book-open"></i>Flash Course
                    Management</a>
            </li>
            <li><a href="#"><i class="fa fa-file" aria-hidden="true"></i>Report Generation</a></li>
            <li class="{{ Request::is('admin/events*') ? 'active' : '' }}"><a
                    href="{{ route('admin.events.index') }}"><i class="fa fa-calendar"
                        aria-hidden="true"></i></i>Event Management</a></li>
            <li class="{{ Request::is('admin/announcement*') ? 'active' : '' }}"><a
                    href="{{ route('admin.announcement.index') }}"><i class="fa fa-bullhorn"
                        aria-hidden="true"></i>Managing Announcement</a></li>
            <li class="{{ Request::is('admin/holidays*') ? 'active' : '' }}"><a
                    href="{{ route('admin.holidays.index') }}"><i class="fas fa-snowman"></i></i>Managing
                    Holidays</a>
            </li>
            <li class="{{ Request::is('admin/notification*') ? 'active' : '' }}"><a
                    href="{{ route('admin.notification.index') }}"><i class="fas fa-bell"></i></i>Managing
                    Notification</a></li>
            <li class="{{ Request::is('admin/cms*') ? 'active' : '' }}"><a
                    href="{{ route('admin.cms.index') }}"><i class="fas fa-file-alt"></i></i>Managing CMS
                    pages/content</a></li>
            <li class="{{ Request::is('admin/banner*') ? 'active' : '' }}"><a
                    href="{{ route('admin.banner.index') }}"><i class="fas fa-file-alt"></i>Banner management</a>
            </li>
            <li><a href="#"><i class="fas fa-user-graduate" aria-hidden="true"></i>PTM Schedule Management</a></li>
            <li>
                <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
</div>
