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
                                @if (!$admission_payment_details)
                                    <tr class="bg-tr">
                                        <td>1</td>
                                        <td>Admission Fees</td>
                                        <td>N/A</td>
                                        <td> &#x20B9;
                                            @if (Auth::user()->special_course_id === null)
                                                @php
                                                    $amount = $class_details->admission_fees + $class_details->monthly_fees;
                                                @endphp
                                                {{ $amount }}
                                            @else
                                                @php
                                                    $amount = $special_course_details->monthly_fees;
                                                @endphp
                                                {{ $amount }}
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{!! route('user.razorpaypayment') !!}" method="POST">
                                                @csrf
                                                <input type="hidden" name="fees_type" value="admission_fee">
                                                <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZOR_KEY') }}"
                                                                                                data-amount="{{ $amount * 100 }}" data-name="Leading Lights"
                                                                                                data-description="Payment" data-image="{{ asset('img/logo.jpg') }}"
                                                                                                data-prefill.name="name" data-prefill.email="email" data-theme.color="#FFFFFF
                                                                                                 ">
                                                </script>
                                            </form>

                                        </td>
                                    </tr>
                                @endif
                                @if ($previous_payment)
                                    <tr class="bg-tr">
                                        <td>1</td>
                                        <td>Monthly Fees <span
                                                class="badge badge-primary">{{ date('F', strtotime($previous_payment->next_due_date)) }}</span>
                                        </td>
                                        @php
                                            if (Auth::user()->special_course_id) {
                                                $amount = $special_course_details->monthly_fees;
                                            } else {
                                                if (!empty($extra_date)) {
                                                    $extra_date_fees = $extra_date * 10;
                                                    $amount = $class_details->monthly_fees + $extra_date_fees;
                                                } else {
                                                    $amount = $class_details->monthly_fees;
                                                }
                                            }
                                        @endphp
                                        <td>{{ $previous_payment->next_due_date }}</td>
                                        <td>&#x20B9;{{ $amount }}
                                            @if (!Auth::user()->special_course_id && !empty($extra_date))
                                                <span class="badge badge-warning" data-toggle="tooltip" data-placement="top"
                                                    title="Late fine">+{{ $extra_date_fees }}</span>
                                            @endif

                                        </td>
                                        <td>
                                            <form action="{!! route('user.razorpaypayment') !!}" method="POST">
                                                @csrf
                                                <input type="hidden" name="fees_type" value="monthly_fees">
                                                <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZOR_KEY') }}"
                                                                                                data-amount="{{ $amount * 100 }}" data-name="Leading Lights"
                                                                                                data-description="Payment" data-image="{{ asset('img/logo.jpg') }}"
                                                                                                data-prefill.name="name" data-prefill.email="email"
                                                                                                data-theme.color="#FFFFFF">
                                                </script>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <h5>Successful Payments</h5>
            <div class="tabs-animation">
                <div class="card mb-3">
                    <div class="card-body">
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
                                @if ($admission_payment_details)
                                    <tr class="bg-tr">
                                        <td>1</td>
                                        <td>Admission Fees</td>
                                        <td> &#x20B9;{{ $admission_payment_details->amount }}</td>
                                        <td>
                                            {{-- <button class="mb-2 mr-2 btn-pill btn btn-info btn-lg">View Receipt</button> --}}
                                            <button class="mb-2 mr-2 btn-pill btn btn-dark btn-lg">Paid Successfully<span
                                                    class="ml-3"><i class="fa fa-check-circle text-success"
                                                        aria-hidden="true"></i>
                                                </span></button>
                                            <a class="mb-2 mr-2 btn-pill btn btn-info btn-lg"
                                                href="{{ route('user.payment_receipt', $admission_payment_details->id) }}"><i
                                                    class="fa fa-download mr-2"></i>Download Receipt</a>
                                        </td>
                                    </tr>
                                @endif
                                @if ($monthly_payment_details)
                                    @foreach ($monthly_payment_details as $key => $payment)
                                        <tr class="bg-tr">
                                            <td>{{ $key + 2 }}</td>
                                            <td>Monthly Fees <span
                                                    class="badge badge-primary">{{ date('F', strtotime($payment->payment_month)) }}</span>
                                            </td>
                                            <td> &#x20B9;{{ $payment->amount }}</td>
                                            <td>
                                                {{-- <button class="mb-2 mr-2 btn-pill btn btn-info btn-lg">View Receipt</button> --}}
                                                <button class="mb-2 mr-2 btn-pill btn btn-dark btn-lg">Paid
                                                    Successfully<span class="ml-3"><i
                                                            class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                                    </span></button>
                                                <a class="mb-2 mr-2 btn-pill btn btn-info btn-lg"
                                                    href="{{ route('user.payment_receipt', $payment->id) }}"><i
                                                        class="fa fa-download mr-2"></i>Download Receipt</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
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
            $('#payment_table').DataTable({
                // responsive: true
            });
            $('#payment_table1').DataTable({
                responsive: true
            });
        });
        $('.razorpay-payment-button').addClass('mb-2 mr-2 btn-pill btn btn-primary btn-lg')
    </script>
@endsection
