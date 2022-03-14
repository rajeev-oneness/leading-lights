<div class="dashboard-menubar" id="sidebar">
    <div class="image-wrapper logo-wrapper customer-logo">
        <img src="{{ asset('img/logo-inverse.png') }}" class="img-fluid logo">
    </div>
    <img src="{{ asset('img/shadow.png') }}" class="img-fluid mx-auto w-100">
    <nav class="">
        <ul class=" menu">
            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
            </li>
            <?php if (Auth::check() && Auth::user()->role->id == 5) { ?>
            <li class="{{ Request::is('super-admin/admin*') ? 'active' : '' }}">
                <a href="{{ route('superAdmin.admin.index') }}"><i class="fa  fa-user-cog" aria-hidden="true"></i>Admin
                    Management</a>
            </li>
            <?php } ?>

            <li class="{{  (Request::is('admin/students*') || Request::is('admin/teachers*') || Request::is('admin/hr*')) ? 'active show' : ''}}">
                 <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">User Management</a>
                 <ul class="collapse list-unstyled {{  (Request::is('admin/students*') || Request::is('admin/teachers*') || Request::is('admin/hr*')) ? ' active show' : ''}}" id="pageSubmenu">
                    <li class="{{ Request::is('admin/students*') ? 'active-sidebar' : '' }}" >
                        <a href="{{ route('admin.students.index') }}"><i class="fas fa-user-graduate"
                                aria-hidden="true"></i>Student Management</a>          
                    </li>
                    <li class="{{ Request::is('admin/teachers*') ? 'active-sidebar' : '' }}">
                        <a href="{{ route('admin.teachers.index') }}"><i class="fa fa-user" aria-hidden="true"></i>Teacher
                            Management</a>
                    </li>
                    <li class="{{ Request::is('admin/hr*') ? 'active-sidebar' : '' }}">
                        <a href="{{ route('admin.hr.index') }}"><i class="fas fa-user-tie"></i></i>HR
                            Management</a>
                    </li>
                </ul>
             </li>
            <li class="{{ Request::is('admin/transaction*') ? 'active' : '' }}">
                <a href="{{ route('admin.transaction.index') }}"><i class="fas fa-wallet"></i>Transaction
                    Management</a>
            </li>
            
            <li class="{{  (Request::is('admin/vlog*') || Request::is('admin/video*') || Request::is('admin/special-courses*') || Request::is('admin/courses*')) || Request::is('admin/classes*') ? 'active show' : ''}}">
                <a href="#courseSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Course Management</a>
                <ul class="collapse list-unstyled {{  (Request::is('admin/vlog*') || Request::is('admin/video*') || Request::is('admin/classes*') || Request::is('admin/special-courses*') || Request::is('admin/courses*')) ? ' active show' : ''}}" id="courseSubmenu">
                    <li class="{{ Request::is('admin/vlog*') ? 'active-sidebar' : '' }}">
                        <a href="{{ route('admin.vlog.index') }}"><i class="fa fa-video-camera" aria-hidden="true"></i>VLOG
                            Management</a>
                    </li>
                    <li class="{{ Request::is('admin/video*') ? 'active-sidebar' : '' }}">
                        <a href="{{ route('admin.video.index') }}"><i class="fa fa-video-camera"
                                aria-hidden="true"></i>Free/Paid video Management</a>
                    </li>
                    <li class="{{ Request::is('admin/classes*') ? 'active-sidebar' : '' }}">
                        <a href="{{ route('admin.classes.index') }}"><i class="fas fa-chalkboard-teacher"></i>Regular Class
                            Management</a>
                    </li>
                    <li class="{{ Request::is('admin/special-courses*') ? 'active-sidebar' : '' }}">
                        <a href="{{ route('admin.special-courses.index') }}"><i class="fas fa-book-reader"></i>Special Course
                            Management</a>
                    </li>
                    <li class="{{ Request::is('admin/courses*') ? 'active-sidebar' : '' }}">
                        <a href="{{ route('admin.courses.index') }}"><i class="fas fa-book-open"></i>Flash
                            Course
                            Management</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('admin/subjects*') ? 'active' : '' }}">
                <a href="{{ route('admin.subjects.index') }}"><i class="fas fa-book-open"></i>Student
                    Subject
                    Management</a>
            </li>
            <li class="{{ Request::is('admin/groups*') ? 'active' : '' }}">
                <a href="{{ route('admin.groups.index') }}"><i class="fas fa-users"></i>Student Group
                    Management</a>
            </li>
            <li class="{{ Request::is('admin/teacher/role*') ? 'active' : '' }}">
                <a href="{{ route('admin.teacher.role.index') }}"><i class="fas fa-users"></i>Teacher Role
                    Management</a>
            </li>
            <li class="{{ Request::is('admin/qualification*') ? 'active' : '' }}">
                <a href="{{ route('admin.qualifications.index') }}"><i class="fas fa-chalkboard"></i>Academic
                    Qualification
                    Management</a>
            </li>
            <li class="{{ Request::is('admin/arrange-classes*') ? 'active' : '' }}">
                <a href="{{ route('admin.arrange_classes') }}"><i class="fas fa-chalkboard"></i>Arrange Class
                    Management</a>
            </li>
            <li class="{{  (Request::is('admin/exams*') || Request::is('admin/report*')) ? 'active show' : ''}}">
                <a href="#examSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Exam Management</a>
                <ul class="collapse list-unstyled {{ (Request::is('admin/exams*') || Request::is('admin/report*')) ? ' active show' : ''}}" id="examSubmenu">
                    <li class="{{ Request::is('admin/exams*') ? 'active-sidebar' : '' }}">
                        <a href="{{ route('admin.exams.index') }}"><i class="fas fa-chalkboard"></i>Manage
                            Exams</a>
                    </li>
                    <li class="{{ Request::is('admin/report*') ? 'active-sidebar' : '' }}">
                        <a href="{{ route('admin.report.index') }}"><i class="fa fa-file" aria-hidden="true"></i>Report
                            Generation</a>
                    </li>
                </ul>
            </li>
            <li class="{{  (Request::is('admin/notice*') || Request::is('admin/testimonial*')) || Request::is('admin/events*') ||
             Request::is('admin/announcement*') || Request::is('admin/holidays*') || Request::is('admin/cms*') || Request::is('admin/cms*') || Request::is('admin/banner*') ? 'active show' : ''}}">
                <a href="#contentSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Content Management</a>
                <ul class="collapse list-unstyled {{ (Request::is('admin/notice*') || Request::is('admin/testimonial*')) || Request::is('admin/events*') ||
                Request::is('admin/announcement*') || Request::is('admin/holidays*') || Request::is('admin/cms*') || Request::is('admin/cms*') || Request::is('admin/banner*') ? ' active show' : ''}}" id="contentSubmenu">
                    <li class="{{ Request::is('admin/notice*') ? 'active-sidebar' : '' }}">
                        <a href="{{ route('admin.notice.index') }}"><i class="fa fa-newspaper-o"></i></i>News
                            Management</a>
                    </li>
                    <li class="{{ Request::is('admin/testimonial*') ? 'active-sidebar' : '' }}">
                        <a href="{{ route('admin.testimonial.index') }}"><i class="fa fa-newspaper-o"></i></i>
                            Testimonial Managements</a>
                    </li>
                    <li class="{{ Request::is('admin/events*') ? 'active-sidebar' : '' }}">
                        <a href="{{ route('admin.events.index') }}"><i class="fa fa-calendar"
                                aria-hidden="true"></i></i>Event Management</a>
                    </li>
                    <li class="{{ Request::is('admin/announcement*') ? 'active-sidebar' : '' }}">
                        <a href="{{ route('admin.announcement.index') }}"><i class="fa fa-bullhorn"
                                aria-hidden="true"></i>Managing Announcement</a>
                    </li>
                    <li class="{{ Request::is('admin/holidays*') ? 'active-sidebar' : '' }}">
                        <a href="{{ route('admin.holidays.index') }}"><i class="fas fa-snowman"></i></i>Managing
                            Holidays</a>
                    </li>
                    <li class="{{ Request::is('admin/cms*') ? 'active-sidebar' : '' }}">
                        <a href="{{ route('admin.cms.index') }}"><i class="fas fa-file-alt"></i></i>Managing
                            CMS
                            pages/content</a>
                    </li>
                    <li class="{{ Request::is('admin/banner*') ? 'active-sidebar' : '' }}" id="banner">
                        <a href="{{ route('admin.banner.index') }}"><i class="fas fa-file-alt"></i>Banner
                            management</a>
                    </li>
                </ul>
            </li>

            <li class="{{ Request::is('admin/notification*') ? 'active' : '' }}">
                <a href="{{ route('admin.notification.index') }}"><i class="fas fa-bell"></i></i>Managing
                    Notification</a>
            </li>
            <li><a href="#"><i class="fas fa-user-graduate" aria-hidden="true"></i>PTM Schedule Management</a></li>
            <li>
                <a href="#" onclick="logOut()">
                    <i class="fa fa-sign-out-alt" aria-hidden="true"></i>{{ __('Logout') }}
                </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </li>
        </ul>
    </nav>
</div>
<script>  
    function logOut() {
        event.preventDefault();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You want to logout!",
            iconHtml: '<img src="{{ asset('img/logo.jpg') }}">',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                event.preventDefault();
                document.getElementById('logout-form').submit();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                // swalWithBootstrapButtons.fire(
                //     'Cancelled',
                //     'Your data  is safe :)',
                //     'error'
                // )
            }
        })
    }
</script>
