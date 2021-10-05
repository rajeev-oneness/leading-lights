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
                <!--   <div class="col-lg-5 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="calendar-bg-events"></div>
                        </div>
                    </div>
                    <div class="card bg-holidday">
                        <div class="card-body">
                            <div class="card-header-title font-size-lg text-capitalize mb-3 font-weight-bold">
                                Holiday Lest
                            </div>
                            <div class="d-sm-flex">
                                <img src="images/holiday.png" class="img-fluid mx-auto d-block">
                                <div class="durga">
                                    <img src="images/durga.png" class="img-fluid mx-auto d-block">
                                    <h5>Oct: 25, 26, 27</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="col-lg-12 col-sm-12">
                    <div class="tab-content">
                        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-hover bg-table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="bg-tr">
                                                <td>07 . 09 . 2021</td>
                                                <td>11.00 am</td>
                                                <td>8.00pm</td>
                                                <td>
                                                    <!-- <button class="btn-pill btn btn-dark btn-lg">Submit</button> -->
                                                    <span class="mr-2"><i
                                                            class="fa fa-check-circle text-success"></i></span>PRESENT
                                                    <button class="btn-pill btn-transition btn btn-outline-dark btn-lg"
                                                        data-toggle="modal" data-target=".bd-example-modal-sm"
                                                        data-toggle="tooltip" title=""
                                                        data-original-title="Attach Proper Reason">Not Join !</button>
                                                </td>
                                            </tr>
                                            <tr class="bg-tr">
                                                <td>07 . 09 . 2021</td>
                                                <td>11.00 am</td>
                                                <td>8.00pm</td>
                                                <td>
                                                    <!-- <button class="btn-pill btn btn-dark btn-lg">Submit</button> -->
                                                    <span class="mr-2"><i
                                                            class="fa fa-exclamation-circle text-danger"></i></span>ABSENT
                                                    <button class="btn-pill btn-transition btn btn-outline-dark btn-lg"
                                                        data-toggle="modal" data-target=".bd-example-modal-sm"
                                                        data-toggle="tooltip" title=""
                                                        data-original-title="Attach Proper Reason">Not Join !</button>
                                                </td>
                                            </tr>
                                            <tr class="bg-tr">
                                                <td>07 . 09 . 2021</td>
                                                <td>11.00 am</td>
                                                <td>8.00pm</td>
                                                <td>
                                                    <!-- <button class="btn-pill btn btn-dark btn-lg">Submit</button> -->
                                                    <span class="mr-2"><i
                                                            class="fa fa-check-circle text-success"></i></span>PRESENT
                                                    <button class="btn-pill btn-transition btn btn-outline-dark btn-lg"
                                                        data-toggle="modal" data-target=".bd-example-modal-sm"
                                                        data-toggle="tooltip" title=""
                                                        data-original-title="Attach Proper Reason">Not Join !</button>
                                                </td>
                                            </tr>
                                            <tr class="bg-tr">
                                                <td>07 . 09 . 2021</td>
                                                <td>11.00 am</td>
                                                <td>8.00pm</td>
                                                <td>
                                                    <!-- <button class="btn-pill btn btn-dark btn-lg">Submit</button> -->
                                                    <span class="mr-2"><i
                                                            class="fa fa-exclamation-circle text-danger"></i></span>ABSENT
                                                    <button class="btn-pill btn-transition btn btn-outline-dark btn-lg"
                                                        data-toggle="modal" data-target=".bd-example-modal-sm"
                                                        data-toggle="tooltip" title=""
                                                        data-original-title="Attach Proper Reason">Not Join !</button>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Please attach your proper reason</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
                        laoreet rutrum faucibus dolor auctor.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
