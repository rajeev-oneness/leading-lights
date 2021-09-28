@extends('teacher.layouts.master')
@section('content')
<div class="app-main__outer" >
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-upload"></i>
                    </div>
                    <div>Upload home task
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header-title mb-4">
                            Upload home task
                        </div>
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <select class="form-control">
                                <option selected>Class vi (Six)</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            
                            <select class="form-control">
                                <option selected>Subject</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="d-sm-flex align-items-center justify-content-between  mb-4">
                            <div class="d-sm-flex align-items-baseline">
                                <p class="des  mr-2"><span class="mr-2"><i class="fa fa-circle"></i></span>Submission Date</p>
                                <form class="form">
                                    <input type="date" name="" class="form-control">
                                </form>
                            </div>
                            <div class="d-sm-flex align-items-baseline">
                                <p class="des  mr-2"><span class="mr-2"><i class="fa fa-circle"></i></span>Submittd by</p>
                                <form class="form">
                                    <input type="time" name="" class="form-control">
                                </form>
                            </div>
                        </div>
                        <!--  <p class="des dec"><span class="mr-2"><i class="fa fa-circle"></i></span>Set Quiestion Mannually</p>
                        <textarea cols="80" id="editor1" name="editor1" rows="10"></textarea> -->
                        <div class="card-header-title mb-4">
                        Upload Quiestion Paper as a Document                                        </div>
                        <div class="file-upload">
                            <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
                            <div class="image-upload-wrap">
                                <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                                <div class="drag-text">
                                    <h3>Drag and drop a file or select add Image</h3>
                                </div>
                            </div>
                            <div class="file-upload-content">
                                <img class="file-upload-image" src="#" alt="your image" />
                                <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <div class="chiller_cb">
                                <input id="myCheckbox" type="checkbox" checked="">
                                <label for="myCheckbox">This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh
                                    Aenean sollicitudin, lorem quis bibendum auctor, nisi elit conse
                                sagittis sem nibh id elit. </label>
                                <span></span>
                            </div>
                        </div>
                        <button class="btn-pill btn btn-dark mt-4">Assign Now</button>
                        
                        
                    </div>
                    <!--  <div class="col-lg-5">
                        <div class="card-header-title mb-4">
                        Upload Quiestion Paper as a Document                                        </div>
                        <div class="file-upload">
                            <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
                            <div class="image-upload-wrap">
                                <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                                <div class="drag-text">
                                    <h3>Drag and drop a file or select add Image</h3>
                                </div>
                            </div>
                            <div class="file-upload-content">
                                <img class="file-upload-image" src="#" alt="your image" />
                                <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <div class="chiller_cb">
                                <input id="myCheckbox" type="checkbox" checked="">
                                <label for="myCheckbox">This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh
                                    Aenean sollicitudin, lorem quis bibendum auctor, nisi elit conse
                                sagittis sem nibh id elit. </label>
                                <span></span>
                            </div>
                        </div>
                        <button class="btn-pill btn btn-dark mt-4">Assign Now</button>
                    </div> -->
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
    </div></div>
@endsection