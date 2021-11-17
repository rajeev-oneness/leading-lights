<div class="navbar-wrapper">
    <nav class="navbar navbar-expand-lg wow fadeInDown">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('frontend/images/logo.png') }}" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">

                <ul class="navbar-nav ml-auto m-0 ml-lg-auto p-3 p-lg-0">
                    <li class="d-inline d-lg-none">
                        <button data-toggle="collapse" data-target="#nav" class="close float-right">&times;</button>
                    </li>
                    <li class="nav-item active"> <a class="nav-link" href="#about">About Us</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="#services">Courses </a> </li>
                    <li class="nav-item"> <a class="nav-link" href="#gallery">Gallery </a> </li>
                    <li class="nav-item"> <a class="nav-link" href="#vlog">Vlog </a> </li>
                    <li class="nav-item"> <a class="nav-link" href="#events"> Events </a> </li>
                    <li class="nav-item"> <a class="nav-link" href="#testimonials">Testimonials </a> </li>
                    <li class="nav-item"> <a class="nav-link " href="#footer">Contact Us</a></li>
                    <li class="nav-item dropdown"><a href="#" class="btn btn-gsm nav-link dropdown-toggle"
                            id="navbardrop" data-toggle="dropdown" aria-expanded="false"><span
                                class="mr-2"><img src="{{ asset('frontend/images/user.png') }}" class="img-fluid"></span>Login
                            <!-- <span  class="ml-2"><img src="images/caret.png" class="img-fluid"></span> -->
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('login') }}">Student</a>
                            <a class="dropdown-item" href="{{ route('hr_login') }}">Hr</a>
                            <a class="dropdown-item" href="{{ route('teacher_login') }}">Teacher</a>
                        </div>

                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>