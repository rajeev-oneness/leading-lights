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
                        <table class="table table-hover bg-table" id="payment_table">
                            <thead>
                                <tr>
                                    <th>Sl. No</th>
                                    <th>Fees Type</th>
                                    <th>Total Cost</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-tr">
                                    <td>1</td>
                                    <td>Admission Fees</td>
                                    <td> &#x20B9;1</td>
                                    <td>
                                        @if ($payment_details)
                                        {{-- <button class="mb-2 mr-2 btn-pill btn btn-info btn-lg">View Receipt</button> --}}
                                        <button class="mb-2 mr-2 btn-pill btn btn-dark btn-lg">Paid Successfully<span
                                                class="ml-3"><i class="fa fa-check-circle text-success"
                                                    aria-hidden="true"></i>
                                            </span></button>
                                        <a class="mb-2 mr-2 btn-pill btn btn-info btn-lg" href="{{ route('user.payment_receipt') }}"><i class="fa fa-download mr-2"></i>Download Receipt</a>
                                        @else
                                        <form action="{!! route('user.razorpaypayment') !!}" method="POST">
                                            @csrf
                                            <script src="https://checkout.razorpay.com/v1/checkout.js" 
                                            data-key="{{ env('RAZOR_KEY') }}" data-amount="100"
                                            data-name="Leading Lights" data-description="Payment"
                                            data-image="{{ asset('img/logo.jpg') }}" data-prefill.name="name"
                                            data-prefill.email="email" data-theme.color="#3399cc">
                                            </script>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
            $('#payment_table').DataTable();
        });
        $('.razorpay-payment-button').addClass('mb-2 mr-2 btn-pill btn btn-primary btn-lg')
    </script>
@endsection
