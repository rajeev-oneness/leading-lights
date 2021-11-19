@extends('hr.layouts.master')
@section('content')
    <div class="app-main">
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
                    <div class="logo-src"><img src="assets/images/logo-inverse.png" class="img-fluid"></div>
                    <img src="images/shadow.png" class="img-fluid mx-auto w-100">
                    <ul class="vertical-nav-menu">
                        <li class="mm-active">
                            <a href="hr-profile.html">
                                <i class=" metismenu-icon fa fa-universal-access"></i>HR’s Profile
                            </a>
                        </li>
                        <li>
                            <a href="attendance.html">
                                <i class="metismenu-icon fa fa-users"></i>Attendance
                            </a>
                        </li>
                        <li>
                            <a href="manage-event.html">
                                <i class="metismenu-icon fa fa-music"></i>Manage Event
                            </a>
                        </li>
                        <li>
                            <a href="notice.html">
                                <i class="metismenu-icon fa fa-bullhorn"></i>Notice/ announcement
                            </a>
                        </li>
                        <li>
                            <a href="download-reports.html">
                                <i class="metismenu-icon fa fa-download"></i>Download report

                            </a>
                        </li>
                        <li>
                            <a href="settings.html">
                                <i class="metismenu-icon fa fa-cog"></i>Settings
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon">
                                <i class="fa fa-universal-access"></i>
                            </div>
                            <div>HR Profile
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tabs-animation">
                    <div class="bg-edit2 p-4">
                        <div class="row">
                            <div class="col-lg-5">
                                <img src="{{ asset($hr->image ? $hr->image : 'frontend/assets/images/avata2.jpg') }}"
                                    class="img-fluid mx-auto rounded">
                            </div>
                            <div class="col-lg-7 not2">
                                <p>Joined- {{ $hr->doj ? $hr->doj : 'N/A' }}</p>
                                <h4 class="mb-4">{{ $hr->first_name ? $hr->first_name : 'N/A' }}
                                    {{ $hr->last_name ? $hr->last_name : 'N/A' }}
                                    {{-- <span class="ml-3"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span> --}}
                                </h4>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-3">
                                        <label>Address:</label>
                                    </div>
                                    <div class="col-lg-4 col-sm-7">
                                        <p id="address">{{ $hr->address ? $hr->address : 'N/A' }}</p>
                                        <span class="text-danger" id="err_msg"></span>
                                    </div>
                                    <div class="col-lg-2 col-sm-2">
                                        <img src="https://img.icons8.com/ios-glyphs/30/000000/save--v1.png"
                                            style="display: none" id="save_address"
                                            onclick="saveAddress({{ Auth::user()->id }})" />
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-edit" onclick="changeAddress()"
                                            id="edit_address">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Mob. No:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $hr->mobile ? $hr->mobile : 'N/A' }}</p>
                                    </div>
                                    {{-- <div class="col-md-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </div> --}}
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email Id:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $hr->email ? $hr->email : 'N/A' }}</p>
                                    </div>
                                    {{-- <div class="col-md-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </div> --}}
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Employee ID:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $hr->id_no ? $hr->id_no : 'N/A' }}</p>
                                    </div>
                                    {{-- <div class="col-md-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </div> --}}
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Academic Qualification:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $hr->qualification ? $hr->qualification : 'N/A' }}</p>
                                    </div>
                                    {{-- <div class="col-md-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <div class="media flex-wrap w-100 align-items-center">
                                            <div class="media-body">
                                                <a href="javascript:void(0)">My Bio</a>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="card-body">
                    <p>{{ $hr->about_us ? $hr->about_us : 'N/A' }}
                        <span> <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span></p>
                </div> --}}


                                    <div class="card-body">
                                        <p><span id="bio">{{ $hr->about_us ? $hr->about_us : 'N/A' }}</span>
                                            <span class="text-danger" id="err_msg"></span>
                                            @if ($hr->status == 1)
                                                <span>
                                                    <img src="https://img.icons8.com/ios-glyphs/30/000000/save--v1.png"
                                                        style="display: none;float: right;" id="save_bio"
                                                        onclick="saveBio()" />
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-edit" onclick="changeBio()" id="edit_bio">
                                                        <path
                                                            d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                        </path>
                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                        </path>
                                                    </svg></span>
                                            @endif
                                        </p>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-7">
                            <div class="card">

                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-5">
                            <div class="card-hover-shadow-2x mb-3 card bg-card2">
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
                                                                <img src="assets/images/alart.png" class="img-fluid">

                                                            </div>
                                                            <div class="ml-3">
                                                                <div class="widget-subheading">Proin gravida nibh vel velit
                                                                    auctor aliquet. sollicitudin, lorem quis bibendum
                                                                    auctor, nisi elit consequat</div>

                                                                <div class="d-sm-flex align-items-center">

                                                                    <div class="widget-subheading">

                                                                        Today<br><span class="text">7:30 pm</span>
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
                                                                <img src="assets/images/alart.png" class="img-fluid">

                                                            </div>
                                                            <div class="ml-3">
                                                                <div class="widget-subheading">Proin gravida nibh vel velit
                                                                    auctor aliquet. sollicitudin, lorem quis bibendum
                                                                    auctor, nisi elit consequat</div>

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
                                                                <img src="assets/images/alart.png" class="img-fluid">

                                                            </div>
                                                            <div class="ml-3">
                                                                <div class="widget-subheading">Proin gravida nibh vel velit
                                                                    auctor aliquet. sollicitudin, lorem quis bibendum
                                                                    auctor, nisi elit consequat</div>

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
                                                                <img src="assets/images/alart.png" class="img-fluid">

                                                            </div>
                                                            <div class="ml-3">
                                                                <div class="widget-subheading">Proin gravida nibh vel velit
                                                                    auctor aliquet. sollicitudin, lorem quis bibendum
                                                                    auctor, nisi elit consequat</div>

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
                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
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
        function changeAddress() {
            document.getElementById('address').innerHTML = `
        <textarea class="form-control" row="10" cols="30" name="address_save" id="address_save">{{ $hr->address }}</textarea>
`;
            document.getElementById('edit_address').style = "display : none";
            document.getElementById('save_address').style = "display : block";
        }

        function saveAddress() {
            var address = document.getElementById("address_save").value;
            if (address.length > 255) {
                document.getElementById('err_msg').innerText = "You can update your address within 255 characters";
                return false;
            } else if (address == '') {
                document.getElementById('err_msg').innerText = 'This field can\'t be blank';
                return false;
            } else {
                $.ajax({
                    url: "{{ route('hr.updateProfile') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        address: address
                    },
                    dataType: 'json',
                    type: 'post',
                    success: function(response) {
                        location.reload();
                    }
                });
            }

        }


        function changeBio() {
            document.getElementById('bio').innerHTML =
                `<textarea class="form-control" row="10" cols="30" name="bio_edit" id="bio_edit">{{ $hr->about_us }}</textarea>`;
            document.getElementById('edit_bio').style = "display : none";
            document.getElementById('save_bio').style.cssText = "display : block;float:right";
        }

        function saveBio() {
            var bio = document.getElementById("bio_edit").value;
            if (bio.length > 255) {
                document.getElementById('err_msg').innerText = "You can update your bio within 255 characters";
                return false;
            } else if (bio == '') {
                document.getElementById('err_msg').innerText = 'This field can\'t be blank';
                return false;
            } else {
                $.ajax({
                    url: "{{ route('hr.updateBio') }}",
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
