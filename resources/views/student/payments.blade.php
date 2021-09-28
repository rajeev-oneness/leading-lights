@extends('student.layouts.master')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-credit-card"></i>
                    </div>
                    <div>Payments
                    </div>
                </div>
            </div>
        </div>
        <div class="tabs-animation">
            <div class="card mb-3">
                <div class="card-body">
                    <table  class="table table-hover bg-table">
                        <thead>
                            <tr>
                                <th>Invoice Id</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Total Cost</th>
                                <th>Total Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-tr">
                                <td>RDK59KIOL</td>
                                <td>03 . 09 . 2021</td>
                                <td>8:00 am</td>
                                <td>2000.00 rs</td>
                                <td><button class="mb-2 mr-2 btn-pill btn btn-info btn-lg">View Receipt</button>
                                    <button class="mb-2 mr-2 btn-pill btn btn-dark btn-lg">Paid Successfully<span class="ml-3"><i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                    </span></button>                                          </td>
                                </tr>
                                <tr class="bg-tr">
                                    <td>RDK59KIOL</td>
                                    <td>03 . 09 . 2021</td>
                                    <td>8:00 am</td>
                                    <td>2000.00 rs</td>
                                    <td><button class="mb-2 mr-2 btn-pill btn btn-primary btn-lg">Pay Now</button>
                                    </td>
                                </tr>
                                <tr class="bg-tr">
                                    <td>RDK59KIOL</td>
                                    <td>03 . 09 . 2021</td>
                                    <td>8:00 am</td>
                                    <td>2000.00 rs</td>
                                    <td><button class="mb-2 mr-2 btn-pill btn btn-primary btn-lg">Pay Now</button>
                                    </td>
                                </tr>
                                <tr class="bg-tr">
                                    <td>RDK59KIOL</td>
                                    <td>03 . 09 . 2021</td>
                                    <td>8:00 am</td>
                                    <td>2000.00 rs</td>
                                    <td><button class="mb-2 mr-2 btn-pill btn btn-primary btn-lg">Pay Now</button>
                                    </td>
                                </tr>
                                <tr class="bg-tr">
                                    <td>RDK59KIOL</td>
                                    <td>03 . 09 . 2021</td>
                                    <td>8:00 am</td>
                                    <td>2000.00 rs</td>
                                    <td><button class="mb-2 mr-2 btn-pill btn btn-primary btn-lg">Pay Now</button>
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
        </div></div>
    </div>
</div>
@endsection