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
            <h5>Payment to be made</h5>
            <div class="tabs-animation">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover bg-table" id="payment_table">
                                <thead>
                                    <tr>
                                        <th>Sl. No</th>
                                        <th>Fees Type</th>
                                        <th>Next Due Date</th>
                                        <th>Total Cost(&#x20B9;)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->due_payment as $dueIndex => $duePayment)
                                        <tr>
                                            <td>{{$duePayment->id}}</td>
                                            <td>{{$duePayment->fee_type}}</td>
                                            <td>{{date('m d, Y',strtotime($duePayment->due_date))}}</td>
                                            <td>{{$duePayment->amount}}</td>
                                            <td>
                                                <form id="checkoutFormDetails{{$duePayment->id}}" action="{!! route('user.razorpaypayment') !!}" method="POST" >
                                                    @csrf
                                                    <input type="hidden" name="redirectURL" value="">
                                                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                                                            data-key="{{ env('RAZORPAY_KEY') }}"
                                                            data-amount="{{($duePayment->amount) * 100}}"
                                                            data-name="Leading Lights"
                                                            data-description=""
                                                            data-image="{{ asset('img/logo.jpg') }}"
                                                            data-theme.color="#ff7529">
                                                    </script>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <h5>Successful Payments</h5>
            <div class="tabs-animation">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover bg-table" id="payment_table1">
                                <thead>
                                    <tr>
                                        <th>Sl. No</th>
                                        <th>Fees Type</th>
                                        <th>Total Cost(&#x20B9;)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->success_payment as $successIndex => $successPayment)
                                        <tr>
                                            <td>{{$successPayment->id}}</td>
                                            <td>{{$successPayment->fee_type}}</td>
                                            <td>&#x20B9;{{$successPayment->amount}}</td>
                                            <td>
                                                <button class="mb-2 mr-2 btn-pill btn btn-dark btn-lg">Paid Successfully
                                                    <span class="ml-3">
                                                        <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                                    </span>
                                                </button>
                                                <a class="mb-2 mr-2 btn-pill btn btn-info btn-lg" href="{{ route('user.payment_receipt', $successPayment->id) }}"><i class="fa fa-download mr-2"></i>Download Receipt</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @include('teacher.layouts.static_footer')
    </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#payment_table').DataTable({
                order : [],
                // responsive: true
            });
            $('#payment_table1').DataTable({
                responsive: true,
                order : [],
            });
        });
        $('.razorpay-payment-button').addClass('mb-2 mr-2 btn-pill btn btn-primary btn-lg')
    </script>
@endsection
