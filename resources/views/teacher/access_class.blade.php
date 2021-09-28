@extends('teacher.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-window-restore"></i>
                        </div>
                        <div>Access Class
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabs-animation">
                <div class="row">
                    <div class="col-lg-12  text-right">
                        <button class="btn-pill btn btn-dark btn-lg mb-4">Arrange Class</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover bg-table">
                        <thead>
                            <tr>
                                <th>Subject</th>

                                <th>Date</th>
                                <th>Time</th>
                                <th>Duration</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-tr">
                                <td>Math</td>
                                <td>Today</td>
                                <td>8:00 am</td>
                                <td>3 hr</td>
                                <td><button class="btn-pill btn btn-dark btn-lg">Join Now</button>
                                    <button class="btn-pill btn-transition btn btn-outline-dark btn-lg"
                                        data-toggle="tooltip" title="" data-original-title="Attach Proper Reason">Not
                                        Join</button>
                                </td>
                            </tr>
                            <tr class="bg-tr">
                                <td>Math</td>
                                <td>04 . 09 . 2021</td>
                                <td>8:00 am</td>
                                <td>1.00 hr</td>
                                <td><button class="btn-pill btn btn-dark btn-lg">Join Now</button>
                                    <button class="btn-pill btn-transition btn btn-outline-dark btn-lg"
                                        data-toggle="tooltip" title="" data-original-title="Attach Proper Reason">Not
                                        Join</button>
                                </td>
                            </tr>
                            <tr class="bg-tr">
                                <td>Math</td>
                                <td>04 . 09 . 2021</td>
                                <td>8:00 am</td>
                                <td>1.00 hr</td>
                                <td><button class="btn-pill btn btn-dark btn-lg">Join Now</button>
                                    <button class="btn-pill btn-transition btn btn-outline-dark btn-lg"
                                        data-toggle="tooltip" title="" data-original-title="Attach Proper Reason">Not
                                        Join</button>
                                </td>
                            </tr>
                            <tr class="bg-tr">
                                <td>Math</td>
                                <td>04 . 09 . 2021</td>
                                <td>8:00 am</td>
                                <td>1.00 hr</td>
                                <td><button class="btn-pill btn btn-dark btn-lg">Join Now</button>
                                    <button class="btn-pill btn-transition btn btn-outline-dark btn-lg"
                                        data-toggle="tooltip" title="" data-original-title="Attach Proper Reason">Not
                                        Join</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
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
