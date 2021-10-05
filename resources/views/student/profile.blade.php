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
                    <div>Students Profile
                    </div>
                </div>
            </div>
        </div>
        <div class="tabs-animation">
            <div class="bg-edit p-4">
                <div class="row">
                    <div class="col-lg-3">
                        <img src="{{ asset($student->image ? $student->image :'frontend/assets/images/avata1.jpg') }}" class="img-fluid mx-auto">
                    </div>
                    <div class="col-lg-4 not2">
                        <p>Joined- {{ Auth::user()->created_at ? date('d-m-Y', strtotime(Auth::user()->created_at)) : 'N/A' }}</p>
                        <h4 class="mb-4">{{ Auth::user()->first_name }}
                            {{ Auth::user()->last_name }}<span class="ml-3">
                                <!-- <img src="assets/images/edit.png" class="img-fluid mx-auto"> -->
                            </span></h4>
                        <div class="row">
                            <div class="col-md-4">
                                <label>DOB :</label>
                            </div>
                            <div class="col-md-6">
                                <p id="dob">{{ Auth::user()->dob ? Auth::user()->dob : 'N/A' }}</p>
                            </div>
                            <div class="col-md-2">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Age :</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $student_age ? $student_age : 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Sex :</label>
                            </div>
                            <div class="col-md-6">
                                <p id="gender">{{ $student->gender ? $student->gender : 'N/A' }}</p>
                            </div>
                            <div class="col-md-2">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Class :</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $student->class ? $student->class : 'N/A' }}</p>
                            </div>
                            <div class="col-md-2">
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Student Id :</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $student->id_no ? $student->id_no : 'N/A' }}</p>
                            </div>
                            <div class="col-md-2">
                                <!-- <img src="assets/images/edit.png" class="img-fluid mx-auto"> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="media flex-wrap w-100 align-items-center">
                                    <div class="media-body">
                                        <a href="javascript:void(0)">My Bio</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <p><span id="bio">{{ $student->about_us ? $student->about_us : 'N/A' }}</span>
                                    <span class="text-danger" id="err_msg"></span>
                                    <span>
                                        <img src="https://img.icons8.com/ios-glyphs/30/000000/save--v1.png"
                                            style="display: none;float: right;" id="save_bio"
                                            onclick="saveBio()" />
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"
                                            onclick="changeBio()" id="edit_bio">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                            </path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                            </path>
                                        </svg></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header-title font-size-lg text-capitalize ">
                                My Classes
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12 col-lg-6 col-xl-6">
                                    <div class="card-shadow-primary profile-responsive card-border mb-3 card">
                                        <div class="dropdown-menu-header">
                                            <div class="dropdown-menu-header-inner">

                                                <img src="{{ asset('frontend/assets/images/pro1.png') }}"
                                                    class="img-fluid mx-auto d-block w-100">

                                            </div>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="bg-warm-flame list-group-item">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper justify-content-between">
                                                        <div class="widget-content-left mr-3">
                                                            <div class="icon-wrapper m-0">
                                                                <span class="head">Drawing</span>
                                                            </div>
                                                        </div>

                                                        <div class="widget-content-left d-sm-flex align-items-center">
                                                            <div class="widget-heading text-dark"><img
                                                                    src="{{ asset('frontend/assets/images/calander.png') }}"
                                                                    class="img-fluid mx-auto"></div>
                                                            <div class="widget-subheading">

                                                                Today<br /><span class="text">7:30
                                                                    pm</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6 col-xl-6">
                                    <div class="card-shadow-primary profile-responsive card-border mb-3 card">
                                        <div class="dropdown-menu-header">
                                            <div class="dropdown-menu-header-inner">

                                                <img src="{{ asset('frontend/assets/images/pro2.png') }}"
                                                    class="img-fluid mx-auto d-block w-100">

                                            </div>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="bg-warm-flame list-group-item">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper justify-content-between">
                                                        <div class="widget-content-left mr-3">
                                                            <div class="icon-wrapper m-0">
                                                                <span class="head">Abacus</span>
                                                            </div>
                                                        </div>

                                                        <div class="widget-content-left d-sm-flex align-items-center">
                                                            <div class="widget-heading text-dark"><img
                                                                    src="{{ asset('frontend/assets/images/calander.png') }}"
                                                                    class="img-fluid mx-auto"></div>
                                                            <div class="widget-subheading">

                                                                Today<br /><span class="text">7:30
                                                                    pm</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--  <div class="col-md-12 col-lg-6 col-xl-4">
                            <div class="card-shadow-primary profile-responsive card-border mb-3 card">
                                <div class="dropdown-menu-header">
                                    <div class="dropdown-menu-header-inner">
                                        
                                            <img src="assets/images/pro3.png" class="img-fluid mx-auto d-block w-100">
                                        
                                    </div>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="bg-warm-flame list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper justify-content-between">
                                                <div class="widget-content-left mr-3">
                                                    <div class="icon-wrapper m-0">
                                                        <span class="head">Live Class</span>
                                                    </div>
                                                </div>
                                                
                                                <div class="widget-content-left d-sm-flex align-items-center">
                                                    <div class="widget-heading text-dark"><img src="assets/images/calander.png" class="img-fluid mx-auto"></div>
                                                    <div class="widget-subheading">
                                                        
                                                            Today<br/><span class="text">7:30 pm</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>                                   
                                </ul>
                            </div>                            
                        </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-5">
                    <div class="card-hover-shadow-2x mb-3 card bg-card">
                        <div class="card-header-tab card-header">
                            <div class="card-header-title font-size-lg text-capitalize font-weight-normal not">
                                Notifications
                            </div>

                        </div>
                        <div class="scroll-area-lg">
                            <div class="scrollbar-container ps ps--active-y">
                                <div class="p-2">
                                    <ul class="todo-list-wrapper list-group list-group-flush">
                                        <li class="list-group-item">

                                            <div class="widget-content p-0">
                                                <div class="d-sm-flex align-items-center not">
                                                    <div class="">
                                                                    <img src="
                                                        {{ asset('frontend/assets/images/alart.png') }}"
                                                        class="img-fluid">

                                                    </div>
                                                    <div class="ml-3">
                                                        <div class="widget-subheading"><i>Proin gravida
                                                                nibh vel velit auctor aliquet. sollicitudin,
                                                                lorem quis bibendum auctor, nisi elit
                                                                consequat</i></div>

                                                        <div class="d-sm-flex align-items-center">

                                                            <div class="widget-subheading">

                                                                Today<br><span class="text">7:30
                                                                    pm</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">

                                            <div class="widget-content p-0">
                                                <div class="d-sm-flex align-items-center not">
                                                    <div class="">
                                                                    <img src="
                                                        {{ asset('frontend/assets/images/alart.png') }}"
                                                        class="img-fluid">

                                                    </div>
                                                    <div class="ml-3">
                                                        <div class="widget-subheading"><i>Proin gravida
                                                                nibh vel velit auctor aliquet. sollicitudin,
                                                                lorem quis bibendum auctor, nisi elit
                                                                consequat</i></div>

                                                        <div class="d-sm-flex align-items-center">

                                                            <div class="widget-subheading">

                                                                Today<br><span class="text">7:30
                                                                    pm</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">

                                            <div class="widget-content p-0">
                                                <div class="d-sm-flex align-items-center not">
                                                    <div class="">
                                                                    <img src="
                                                        {{ asset('frontend/assets/images/alart.png') }}"
                                                        class="img-fluid">

                                                    </div>
                                                    <div class="ml-3">
                                                        <div class="widget-subheading"><i>Proin gravida
                                                                nibh vel velit auctor aliquet. sollicitudin,
                                                                lorem quis bibendum auctor, nisi elit
                                                                consequat</i></div>

                                                        <div class="d-sm-flex align-items-center">

                                                            <div class="widget-subheading">

                                                                Today<br><span class="text">7:30
                                                                    pm</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">

                                            <div class="widget-content p-0">
                                                <div class="d-sm-flex align-items-center not">
                                                    <div class="">
                                                                    <img src="
                                                        {{ asset('frontend/assets/images/alart.png') }}"
                                                        class="img-fluid">

                                                    </div>
                                                    <div class="ml-3">
                                                        <div class="widget-subheading"><i>Proin gravida
                                                                nibh vel velit auctor aliquet. sollicitudin,
                                                                lorem quis bibendum auctor, nisi elit
                                                                consequat</i></div>

                                                        <div class="d-sm-flex align-items-center">

                                                            <div class="widget-subheading">

                                                                Today<br><span class="text">7:30
                                                                    pm</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;">
                                    </div>
                                </div>
                                <div class="ps__rail-y" style="top: 0px; height: 400px; right: 0px;">
                                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 232px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="app-wrapper-footer">
        <div class="app-footer">
            <div class="app-footer__inner">
                <div class="app-footer-right">
                    <ul class="header-megamenu nav">
                        <li class="nav-item">
                            <a class="nav-link">
                                Copyright &copy; 2021 | All Right Reserved
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script>
    function changeBio() {
        document.getElementById('bio').innerHTML =
            `<textarea class="form-control" row="10" cols="30" name="bio_edit" id="bio_edit">{{ $student->about_us }}</textarea>`;
        document.getElementById('edit_bio').style = "display : none";
        document.getElementById('save_bio').style.cssText = "display : block;float:right";
    }
    function saveBio() {
        var bio = document.getElementById("bio_edit").value;
        if (bio.length > 255) {
            document.getElementById('err_msg').innerText = "You can update your bio within 255 characters";
            return false;
        } else if(bio == ''){
            document.getElementById('err_msg').innerText = 'This field can\'t be blank';
            return false;
        } else {
            $.ajax({
                url: "{{ route('user.updateProfile') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    bio: bio
                },
                dataType: 'json',
                type: 'post',
                success: function(response) {
                    location.reload();
                }
            });
        }

    }
</script>
@endsection
