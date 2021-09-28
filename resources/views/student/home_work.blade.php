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
                        <div>Homework
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabs-animation">
                <div class="card mb-3">
                    <div class="card-body">
                        <table class="table table-hover bg-table">
                            <thead>
                                <tr>
                                    <th>Class</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                    <th>Feedback</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-tr">
                                    <td>Math</td>
                                    <td>Today</td>
                                    <td>8:00 am</td>
                                    <td><button class="btn-pill btn btn-primary">Download Task</button>
                                        <input class="btn-pill btn btn-primary" type="file" placeholder="Upload">
                                        <button class="btn-pill btn btn-primary">Submit task</button>
                                    </td>
                                    <td> <button class="btn-pill btn-transition btn btn-outline-dark">Very Good</button>
                                    </td>
                                </tr>
                                <tr class="bg-tr">
                                    <td>Math</td>
                                    <td>Today</td>
                                    <td>8:00 am</td>
                                    <td><button class="btn-pill btn btn-primary">Download Task</button>
                                        <input class="btn-pill btn btn-primary" type="file" placeholder="Upload">
                                        <button class="btn-pill btn btn-primary">Submit task</button>
                                    </td>
                                    <td> <button class="btn-pill btn-transition btn btn-outline-dark">Very Good</button>
                                    </td>
                                </tr>
                                <tr class="bg-tr">
                                    <td>Math</td>
                                    <td>Today</td>
                                    <td>8:00 am</td>
                                    <td><button class="btn-pill btn btn-primary">Download Task</button>
                                        <input class="btn-pill btn btn-primary" type="file" placeholder="Upload">
                                        <button class="btn-pill btn btn-primary">Submit task</button>
                                    </td>
                                    <td> <button class="btn-pill btn-transition btn btn-outline-dark">Very Good</button>
                                    </td>
                                </tr>
                                <tr class="bg-tr">
                                    <td>Math</td>
                                    <td>Today</td>
                                    <td>8:00 am</td>
                                    <td><button class="btn-pill btn btn-primary">Download Task</button>
                                        <input class="btn-pill btn btn-primary" type="file" placeholder="Upload">
                                        <button class="btn-pill btn btn-primary">Submit task</button>
                                    </td>
                                    <td> <button class="btn-pill btn-transition btn btn-outline-dark">Very Good</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
