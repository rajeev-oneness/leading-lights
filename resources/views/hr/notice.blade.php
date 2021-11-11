@extends('hr.layouts.master')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-bullhorn"></i>
                    </div>
                    <div> Notice/ announcement                                
                    </div>
                </div>
                   </div>
        </div>       
        
            <div class="card mb-3">                            
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-7">
                             <div class="card-header-title font-size-lg text-capitalize mb-4">
                                Holiday Notice
                            </div>
                            <div class="d-sm-flex align-items-center   mb-4">
                                <p class="des dec"><span class="mr-2"><i class="fa fa-circle"></i></span>Description</p>
                                <div class="d-sm-flex align-items-baseline">
                                     <p class="des  mr-2"><span class="mr-2"><i class="fa fa-circle"></i></span>Date</p>
                                    <form class="form">                                                 
                                     <input type="date" name="" class="form-control">
                                 </form>
                            </div>
                             </div>
                            <textarea cols="80" id="editor1" name="editor1" rows="10"></textarea>
                       
                            <button class="btn-pill btn btn-dark mt-4">Submit Now</button>
                        </div>
                         <div class="col-lg-5">
                                <div class="items d-sm-flex align-items-center">
                                    <div class="pdf-box">
                                         <img src="images/pdf.png" class="img-fluid mx-auto">
                                    </div>
                                    <div class="pdf-text">
                                         <h4>Lorem Ipsum</h4>
                                         <p>This is Photoshop's version  of Lorem Ipsum. </p>
                                         <div class="widget-content-left d-sm-flex align-items-center">
                                        <div class="widget-heading text-dark"><img src="assets/images/calander.png" class="img-fluid mx-auto"></div>
                                        <div class="widget-subheading ml-3">
                                           
                                             Today<br><span class="text">7:30 pm</span>
                                        </div>
                                    </div>
                                    </div>
                                </div>


                                            <div class="items d-sm-flex align-items-center">
                                    <div class="pdf-box">
                                         <img src="images/pdf.png" class="img-fluid mx-auto">
                                    </div>
                                    <div class="pdf-text">
                                         <h4>Lorem Ipsum</h4>
                                         <p>This is Photoshop's version  of Lorem Ipsum. </p>
                                         <div class="widget-content-left d-sm-flex align-items-center">
                                        <div class="widget-heading text-dark"><img src="assets/images/calander.png" class="img-fluid mx-auto"></div>
                                        <div class="widget-subheading ml-3">
                                           
                                             Today<br><span class="text">7:30 pm</span>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                            <div class="items d-sm-flex align-items-center">
                                    <div class="pdf-box">
                                         <img src="images/pdf.png" class="img-fluid mx-auto">
                                    </div>
                                    <div class="pdf-text">
                                         <h4>Lorem Ipsum</h4>
                                         <p>This is Photoshop's version  of Lorem Ipsum. </p>
                                         <div class="widget-content-left d-sm-flex align-items-center">
                                        <div class="widget-heading text-dark"><img src="assets/images/calander.png" class="img-fluid mx-auto"></div>
                                        <div class="widget-subheading ml-3">
                                           
                                             Today<br><span class="text">7:30 pm</span>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                            <div class="items d-sm-flex align-items-center">
                                    <div class="pdf-box">
                                         <img src="images/pdf.png" class="img-fluid mx-auto">
                                    </div>
                                    <div class="pdf-text">
                                         <h4>Lorem Ipsum</h4>
                                         <p>This is Photoshop's version  of Lorem Ipsum. </p>
                                         <div class="widget-content-left d-sm-flex align-items-center">
                                        <div class="widget-heading text-dark"><img src="assets/images/calander.png" class="img-fluid mx-auto"></div>
                                        <div class="widget-subheading ml-3">
                                           
                                             Today<br><span class="text">7:30 pm</span>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                            <div class="items d-sm-flex align-items-center">
                                    <div class="pdf-box">
                                         <img src="images/pdf.png" class="img-fluid mx-auto">
                                    </div>
                                    <div class="pdf-text">
                                         <h4>Lorem Ipsum</h4>
                                         <p>This is Photoshop's version  of Lorem Ipsum. </p>
                                         <div class="widget-content-left d-sm-flex align-items-center">
                                        <div class="widget-heading text-dark"><img src="assets/images/calander.png" class="img-fluid mx-auto"></div>
                                        <div class="widget-subheading ml-3">
                                           
                                             Today<br><span class="text">7:30 pm</span>
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
@endsection