@extends('student.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-upload"></i>
                        </div>
                        <div>Cart
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-header-title mb-4">
                                Cart
                            </div>
                            <div class="row">
                                @foreach ($all_courses as $course_id)
                                @php
                                    $course_details = App\Models\SpecialCourse::find($course_id);
                                    // $special_course_total_amount = 0;
                                    // foreach ($course_details as $key => $course) {
                                    //     $special_course_total_amount += $course->monthly_fees;
                                    // }
                                    // $amount = $special_course_total_amount;
                                @endphp
                                <div class="col-md-4">
                                    <div class="items align-items-center">
                                        <div class="pdf-text">
                                            <h4>{{ $course_details->title }}</h4>
                                            <ul>
                                                <li><b>Monthly Fees :</b> &#8377;{{ $course_details->monthly_fees }}</li>
                                                <li><b>Start Date : </b>{{ $course_details->start_date }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="font-weight-bold">
                                Total amount: <span class="float-right text-success">&#8377;{{ $total_amount }}</span>
                            </div>
                            <hr>
                            <form action="{!! route('user.razorpaypayment') !!}" method="POST">
                                @csrf
                                <input type="hidden" name="fees_type" value="monthly_fees">
                                @foreach ($all_courses as $course_id)
                                    <input type="hidden" name="course_id[]" value="{{ $course_id }}">
                                @endforeach
                                <input type="hidden" name="type" value="new_course">
                                <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZOR_KEY') }}"data-amount="{{ $total_amount * 100 }}" data-name="Leading Lights" data-description="Payment"
                                data-image="{{ asset('img/logo.jpg') }}" data-prefill.name="name"data-prefill.email="email"data-theme.color="#FFFFFF">
                                </script>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('student.layouts.static_footer')
    </div>
    <script>
        $('.razorpay-payment-button').addClass('btn-pill btn btn-success btn-lg float-right');
        $('.razorpay-payment-button').prop('value', 'Proceed to pay');
    </script>
@endsection
