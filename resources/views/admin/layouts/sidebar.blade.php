<div class="dashboard-menubar" id="sidebar">
  <div class="image-wrapper logo-wrapper customer-logo">
      <img src="{{ asset('img/WeVouch_Logo.png') }}" class="img-fluid logo">
  </div>
  <nav class="border-top">
<!-- <button class="toggle-mob-menu" aria-expanded="false" aria-label="open menu">
<i class="fa fa-bars menu-button"></i>
</button> -->
<ul class="menu">
<li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard</a></li>
      <li class="{{ Request::is('admin/students*') ? 'active' : '' }}"><a href="{{ route('admin.students.index') }}"><i class="fas fa-user-graduate" aria-hidden="true"></i>Student Management</a></li>
      <li class="{{ Request::is('admin/teachers*') ? 'active' : '' }}"><a href="{{ route('admin.teachers.index') }}"><i class="fa fa-user" aria-hidden="true"></i>Teacher Management</a></li>
      <li class="{{ Request::is('admin/transaction*') ? 'active' : '' }}"><a href="{{ route('admin.transaction.index') }}"><i class="fas fa-user-graduate" aria-hidden="true"></i>Transaction Management</a></li>
      <li class="{{ Request::is('admin/vlog*') ? 'active' : '' }}"><a href="{{ route('admin.vlog.index') }}"><i class="fas fa-user-graduate" aria-hidden="true"></i>VLOG Management</a></li>
      <li class="{{ Request::is('admin/video*') ? 'active' : '' }}"><a href="{{ route('admin.video.index') }}"><i class="fas fa-user-graduate" aria-hidden="true"></i>Free/Paid video management</a></li>
      <li class="{{ Request::is('admin/classes*') ? 'active' : '' }}"><a href="{{ route('admin.classes.index') }}"><i class="fas fa-user-graduate" aria-hidden="true"></i>Class management</a></li>
      <li class="{{ Request::is('admin/courses*') ? 'active' : '' }}"><a href="{{ route('admin.courses.index') }}"><i class="fas fa-user-graduate" aria-hidden="true"></i>Flash Course Management</a></li>
      <li><a href="#"><i class="fas fa-user-graduate" aria-hidden="true"></i>Report Generation</a></li>
      <li class="{{ Request::is('admin/announcement*') ? 'active' : '' }}"><a href="{{ route('admin.announcement.index') }}"><i class="fas fa-user-graduate" aria-hidden="true"></i>Managing Announcement</a></li>
      <li class="{{ Request::is('admin/holidays*') ? 'active' : '' }}"><a href="{{ route('admin.holidays.index') }}"><i class="fas fa-user-graduate" aria-hidden="true"></i>Managing Holidays</a></li>
      <li><a href="#"><i class="fas fa-user-graduate" aria-hidden="true"></i>Managing Notification</a></li>
      <li class="{{ Request::is('admin/cms*') ? 'active' : '' }}"><a href="{{ route('admin.cms.index') }}"><i class="fas fa-user-graduate" aria-hidden="true"></i>Managing CMS pages/content</a></li>
      <li class="{{ Request::is('admin/banner*') ? 'active' : '' }}"><a href="{{ route('admin.banner.index') }}"><i class="fas fa-user-graduate" aria-hidden="true"></i>Banner management</a></li>
      <li><a href="#"><i class="fas fa-user-graduate" aria-hidden="true"></i>PTM Schedule Management</a></li>
      <li>
        <a href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
             <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
      </li>		
  </ul>
</nav>
</div>