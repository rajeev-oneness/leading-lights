@extends('teacher.layouts.master')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div>Attendance
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div id="calendar-bg-events"></div>
                    </div>
                </div>
                <div class="card bg-holidday">
                    <div class="card-body">
                        <div class="card-header-title mb-4">
                            Holiday Lest
                        </div>
                        <div class="d-sm-flex">
                            <img src="images/holiday.png" class="img-fluid">
                            <div class="durga">
                                <img src="images/durga.png" class="img-fluid mb-3">
                                <h5>Oct: 25, 26, 27</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
                    <li class="nav-item">
                        <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                            <span>Students</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
                            <span>Teachers</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12">
                                <table  class="table table-hover bg-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Roll</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-tr">
                                            <td>John Doe</td>
                                            <td>1</td>
                                            <td><span class="mr-2"><i class="fa fa-check-circle text-success"></i></span>PRESENT</td>
                                        </tr>
                                        <tr class="bg-tr">
                                            <td>John Doe</td>
                                            <td>1</td>
                                            <td><span class="mr-2"><i class="fa fa-check-circle text-success"></i></span>PRESENT</td>
                                        </tr>
                                        <tr class="bg-tr">
                                            <td>John Doe</td>
                                            <td>1</td>
                                            <td>
                                                <div class="d-sm-flex justify-content-around align-items-center">
                                                    <div class="d-sm-flex ab">
                                                        <span class="mr-2"><i class="fa fa-exclamation-circle text-danger"></i></span>ABSENT
                                                    </div>
                                                    <div class="">
                                                        Applied leave
                                                        1 Casual Leave Applied
                                                    </div>
                                                </div>
                                                <!-- <span class="mr-2"><i class="fa fa-exclamation-circle text-danger"></i></span>ABSENT Applied leave
                                            1 Casual Leave Applied</td> -->
                                        </tr>
                                        <tr class="bg-tr">
                                            <td>John Doe</td>
                                            <td>1</td>
                                            <td><span class="mr-2"><i class="fa fa-check-circle text-success"></i></span>PRESENT</td>
                                        </tr>
                                        <tr class="bg-tr">
                                            <td>John Doe</td>
                                            <td>1</td>
                                            <td><span class="mr-2"><i class="fa fa-check-circle text-success"></i></span>PRESENT</td>
                                        </tr>
                                        <tr class="bg-tr">
                                            <td>John Doe</td>
                                            <td>1</td>
                                            <td>
                                                <div class="d-sm-flex justify-content-around align-items-center">
                                                    <div class="d-sm-flex ab">
                                                        <span class="mr-2"><i class="fa fa-exclamation-circle text-danger"></i></span>ABSENT
                                                    </div>
                                                    <div class="">
                                                        Applied leave
                                                        1 Casual Leave Applied
                                                    </div>
                                                </div>
                                                <!-- <span class="mr-2"><i class="fa fa-exclamation-circle text-danger"></i></span>ABSENT Applied leave
                                            1 Casual Leave Applied</td> -->
                                        </tr>
                                        <tr class="bg-tr">
                                            <td>John Doe</td>
                                            <td>1</td>
                                            <td><span class="mr-2"><i class="fa fa-check-circle text-success"></i></span>PRESENT</td>
                                        </tr>
                                        <tr class="bg-tr">
                                            <td>John Doe</td>
                                            <td>1</td>
                                            <td><span class="mr-2"><i class="fa fa-check-circle text-success"></i></span>PRESENT</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                        <table  class="table table-hover bg-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Roll</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-tr">
                                    <td>John Doe</td>
                                    <td>1</td>
                                    <td><span class="mr-2"><i class="fa fa-check-circle text-success"></i></span>PRESENT</td>
                                </tr>
                                <tr class="bg-tr">
                                    <td>John Doe</td>
                                    <td>1</td>
                                    <td><span class="mr-2"><i class="fa fa-check-circle text-success"></i></span>PRESENT</td>
                                </tr>
                                <tr class="bg-tr">
                                    <td>John Doe</td>
                                    <td>1</td>
                                    <td>
                                        <div class="d-sm-flex justify-content-around align-items-center">
                                            <div class="d-sm-flex ab">
                                                <span class="mr-2"><i class="fa fa-exclamation-circle text-danger"></i></span>ABSENT
                                            </div>
                                            <div class="">
                                                Applied leave
                                                1 Casual Leave Applied
                                            </div>
                                        </div>
                                        <!-- <span class="mr-2"><i class="fa fa-exclamation-circle text-danger"></i></span>ABSENT Applied leave
                                    1 Casual Leave Applied</td> -->
                                </tr>
                                <tr class="bg-tr">
                                    <td>John Doe</td>
                                    <td>1</td>
                                    <td><span class="mr-2"><i class="fa fa-check-circle text-success"></i></span>PRESENT</td>
                                </tr>
                                <tr class="bg-tr">
                                    <td>John Doe</td>
                                    <td>1</td>
                                    <td><span class="mr-2"><i class="fa fa-check-circle text-success"></i></span>PRESENT</td>
                                </tr>
                                <tr class="bg-tr">
                                    <td>John Doe</td>
                                    <td>1</td>
                                    <td>
                                        <div class="d-sm-flex justify-content-around align-items-center">
                                            <div class="d-sm-flex ab">
                                                <span class="mr-2"><i class="fa fa-exclamation-circle text-danger"></i></span>ABSENT
                                            </div>
                                            <div class="">
                                                Applied leave
                                                1 Casual Leave Applied
                                            </div>
                                        </div>
                                        <!-- <span class="mr-2"><i class="fa fa-exclamation-circle text-danger"></i></span>ABSENT Applied leave
                                    1 Casual Leave Applied</td> -->
                                </tr>
                                <tr class="bg-tr">
                                    <td>John Doe</td>
                                    <td>1</td>
                                    <td><span class="mr-2"><i class="fa fa-check-circle text-success"></i></span>PRESENT</td>
                                </tr>
                                <tr class="bg-tr">
                                    <td>John Doe</td>
                                    <td>1</td>
                                    <td><span class="mr-2"><i class="fa fa-check-circle text-success"></i></span>PRESENT</td>
                                </tr>
                                
                            </tbody>
                        </table>
                        
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
    </div></div>
</div>
@endsection