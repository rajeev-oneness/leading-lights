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
                        <!-- Button trigger modal -->
                        <button type="button" class="btn-pill btn btn-dark btn-lg mb-4" data-toggle="modal"
                            data-target="#exampleModal">
                            Arrange Class
                        </button>
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
    </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Arrange Class</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Subject</label>
                                <select name="subject" id="subject" class="form-control">
                                    <option value="">Select subject</option>
                                    <option value="Math">Math</option>
                                    <option value="Physics">Physics</option>
                                    <option value="Chemistry">Chemistry</option>
                                    <option value="History">History</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Class</label>
                                <select name="class" id="class" class="form-control">
                                    <option value="">Select classes</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->name }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" name="date" id="date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Time</label>
                                <input type="time" class="form-control" name="time" id="time">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Duration(hr)</label>
                                <input type="number" class="form-control" name="duration" id="duration">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="meeting_url">Live class URL(Zoon,Meet etc)</label>
                                <input type="text" class="form-control" name="meeting_url" id="meeting_url">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary float-right">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
