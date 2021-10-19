@extends('teacher.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-text-height"></i>
                        </div>
                        <div>Teacher Profile
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabs-animation">
                <div class="bg-edit2 p-4">
                    <div class="row">
                        <div class="col-lg-5 col-sm-4">
                            <img src="{{ asset($teacher->image ? $teacher->image : 'frontend/assets/images/avata3.jpg') }}"
                                class="img-fluid mx-auto">
                        </div>
                        <div class="col-lg-7 col-sm-8 not2">
                            <p>Joined-
                                {{ Auth::user()->created_at ? date('d-m-Y', strtotime(Auth::user()->created_at)) : 'N/A' }}
                            </p>
                            <h4 class="mb-4">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<span
                                    class="ml-3">
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> -->
                                </span></h4>
                            <div class="row">
                                <div class="col-lg-4 col-sm-3">
                                    <label>Address:</label>
                                </div>
                                <div class="col-lg-6 col-sm-7">
                                    <p id="address">{{ $teacher->address ? $teacher->address : 'N/A' }}</p>
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
                                <div class="col-lg-4 col-sm-3">
                                    <label>Mob. No:</label>
                                </div>
                                <div class="col-lg-6 col-sm-7">
                                    <p>{{ $teacher->mobile ? $teacher->mobile : 'N/A' }}</p>
                                </div>
                                <div class="col-lg-2 col-sm-2">
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-3">
                                    <label>Email Id:</label>
                                </div>
                                <div class="col-lg-6 col-sm-7">
                                    <p>{{ $teacher->email ? $teacher->email : 'N/A' }}</p>
                                </div>
                                <div class="col-lg-2 col-sm-2">
                                    <!--  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-3">
                                    <label>Employee ID:</label>
                                </div>
                                <div class="col-lg-6 col-sm-7">
                                    <p>{{ $teacher->id_no ? $teacher->id_no : 'N/A' }}</p>
                                </div>
                                <div class="col-lg-2 col-sm-2">
                                    <!--  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-3">
                                    <label>Academic Qualification:</label>
                                </div>
                                <div class="col-lg-6 col-sm-7">
                                    <p id="qualification">{{ $teacher->qualification ? $teacher->qualification : 'N/A' }}
                                    </p>
                                </div>
                                <div class="col-lg-2 col-sm-2">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="card-header-title font-size-lg text-capitalize mb-4">
                                        Expertise in Subject Area
                                    </div>
                                    <p><span id="special_subject">Math / Physice / Chemistry</span><span
                                            class="ml-3"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="card-header-title font-size-lg text-capitalize mb-4">
                                        My Certificate & Documents
                                    </div>
                                    <ul class="list">
                                        @forelse ($certificates as $certificate)
                                            <li><img src="{{ asset($certificate->image) }}"
                                            class="img-fluid mx-auto w-100"></li>
                                        @empty
                                               <li>Not Available</li>
                                        @endforelse
                                    </ul>
                                    <div class="file-upload">
                                        <button class="file-upload-btn" type="button"
                                            onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
                                        {{-- <button class="file-upload-btn" type="button">Add Image</button> --}}

                                        <div class="image-upload-wrap">
                                            <input class="file-upload-input" type='file'
                                                accept="image/*" id="img_upload" name="image"/>
                                            <div class="drag-text">
                                                <h3>Drag and drop a file or select add Image</h3>
                                            </div>
                                        </div>
                                        <div class="file-upload-content">
                                            <img class="file-upload-image" src="#" alt="your image" />
                                            {{-- <div class="image-title-wrap">
                                                <button type="button" onclick="removeUpload()" class="remove-image">Remove
                                                    <span class="image-title">Uploaded Image</span></button>
                                            </div> --}}
                                            {{-- <img id="img_prv" style="max-width: 150px;max-height: 150px" class="img-thumbnail" src=""> --}}
                                        </div>
                                        <span id="mgs_ta">
                                    </div>
                                    <div class="d-sm-flex align-items-baseline justify-content-between">
                                        <div class="">
                                            <label class=" check mr-3">
                                            Today’s Attendance: </label>
                                            <input type="checkbox" class="switch_1">
                                        </div>
                                        <label class="check">PRESENT<span class="ml-2"><i
                                                    class="fa fa-check-circle text-success"></i></span></label>
                                    </div>   

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
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="card-shadow-primary profile-responsive card-border mb-3 card">
                                            <div class="dropdown-menu-header">
                                                <div class="dropdown-menu-header-inner">

                                                    <img src="{{ asset('frontend/images/teacher1.jpg') }}"
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
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="card-shadow-primary profile-responsive card-border mb-3 card">
                                            <div class="dropdown-menu-header">
                                                <div class="dropdown-menu-header-inner">

                                                    <img src="{{ asset('frontend/images/teacher2.jpg') }}"
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
                                                                  <img src="
                                                            {{ asset('frontend/assets/images/alart.png') }} " class="
                                                            
                                                            
                                                            
                                                            img-fluid">

                                                        </div>
                                                        <div class="ml-3">
                                                            <div class="widget-subheading"><i>Proin gravida nibh
                                                                    vel velit auctor aliquet. sollicitudin, lorem
                                                                    quis bibendum auctor, nisi elit consequat</i>
                                                            </div>

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
                                                            {{ asset('frontend/assets/images/alart.png') }} " class="
                                                            
                                                            
                                                            
                                                            img-fluid">

                                                        </div>
                                                        <div class="ml-3">
                                                            <div class="widget-subheading"><i>Proin gravida nibh
                                                                    vel velit auctor aliquet. sollicitudin, lorem
                                                                    quis bibendum auctor, nisi elit consequat</i>
                                                            </div>

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
                                                            {{ asset('frontend/assets/images/alart.png') }} " class="
                                                            
                                                            
                                                            
                                                            img-fluid">

                                                        </div>
                                                        <div class="ml-3">
                                                            <div class="widget-subheading"><i>Proin gravida nibh
                                                                    vel velit auctor aliquet. sollicitudin, lorem
                                                                    quis bibendum auctor, nisi elit consequat</i>
                                                            </div>

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
                                                            {{ asset('frontend/assets/images/alart.png') }} " class="img-fluid">

                                                        </div>
                                                        <div class="ml-3">
                                                            <div class="widget-subheading"><i>Proin gravida nibh
                                                                    vel velit auctor aliquet. sollicitudin, lorem
                                                                    quis bibendum auctor, nisi elit consequat</i>
                                                            </div>

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

    <script>
        function changeAddress() {
            document.getElementById('address').innerHTML = `
            <textarea class="form-control" row="10" cols="30" name="address_save" id="address_save">{{ $teacher->address }}</textarea>
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
                    url: "{{ route('teacher.updateProfile') }}",
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

        $("#img_upload").on('change',function(ev) {
            console.log("here inside");
 
            var filedata=this.files[0];
            var imgtype=filedata.type;
            
            var match=['image/jpeg','image/jpg'];

            if(!(imgtype==match[0])||(imgtype==match[1])){
                $('#mgs_ta').html('<p style="color:red">Plz select a valid type image..only jpg jpeg allowed</p>');
 
            }else{
                $('#mgs_ta').empty();

                 //---image preview
                var reader=new FileReader();
 
                reader.onload=function(ev){
                $('#img_prv').attr('src',ev.target.result).css('width','150px').css('height','150px');
                }

                reader.readAsDataURL(this.files[0]);
                 /// preview end

                  //upload
 
                var postData=new FormData();
                postData.append('file',this.files[0]);
 
                $.ajax({
                    headers:{'X-CSRF-Token':$('meta[name=csrf_token]').attr('content')},
                    async:true,
                    type:"post",
                    url:"{{ route('teacher.certificate_upload') }}",
                    data: postData,
                    contentType:false,
                    processData:false,
                    success:function(){
                        location.reload();
                    }
                });
            }
        })
    </script>
@endsection
