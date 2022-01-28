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
                                        <th>Order Id</th>
                                        <th>Fees Type</th>
                                        @if (Auth::user()->registration_type != 3 && Auth::user()->registration_type != 4)
                                            <th>Next Due Date</th>
                                        @endif
                                        <th>Total Cost(&#x20B9;)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->due_payment as $dueIndex => $duePayment)
                                    @php
                                        $user_id = $duePayment->user_id;
                                        $class_id = $duePayment->class_id;
                                        $course_id = $duePayment->course_id;
                                        $flash_course_id = $duePayment->flash_course_id;

                                    @endphp
                                        <tr>
                                            <td>{{$duePayment->id}}</td>
                                            <td>
                                                @php
                                                    $feeType = 'Admission Fees';
                                                    switch($duePayment->fee_type){
                                                        case 'admission_fee' : $feeType = 'Admission Fees with 1 month class fee';break;
                                                        case 'course_fee' : $feeType = 'Course Fee';break;
                                                        case 'class_fee' : $feeType = 'Class Fee';break;
                                                        case 'flash_course_fee' : $feeType = 'Flash Course Fee';break;
                                                    }
                                                    // echo $feeType. ' ('.getNameofClassOrCourse($duePayment).')';
                                                @endphp
                                                <span>
                                                    @if (Auth::user()->registration_type != 4)
                                                         {{ $feeType }}
                                                         <span class="badge badge-info">
                                                            @if (Auth::user()->registration_type == 3)
                                                                @php
                                                                    $paymentStatus = checkPaymentStatus(Auth::user()->id);
                                                                @endphp
                                                                @if ($paymentStatus == 1)
                                                                    @if ($flash_course_id > 0)
                                                                         {{ getNameofFlashCourse($duePayment) }}
                                                                    @endif
                                                                    @if ($course_id > 0)
                                                                        {{ getNameofClassOrCourse($duePayment) }}
                                                                    @endif
                                                                @else
                                                                    {{ getNameofFlashCourse($duePayment) }}
                                                                @endif
                                                            @elseif (Auth::user()->registration_type == 4)
                                                                {{-- One Time Payment --}}
                                                            @else
                                                                {{ getNameofClassOrCourse($duePayment) }}
                                                            @endif
                                                        </span>
                                                    @endif
                                                    @if (Auth::user()->registration_type == 4)
                                                            One Time Payment
                                                    @endif
                                                    
                                            </span>
                                            </td>
                                            @if (Auth::user()->registration_type != 3 && Auth::user()->registration_type != 4)
                                            <td>
                                                @if ($duePayment->fee_type != 'admission_fee')
                                                    {{date('M d, Y',strtotime($duePayment->due_date))}}
                                                @endif
                                            </td>
                                            @endif
                                            {{-- @if (Auth::user()->registration_type == 3)
                                                @php
                                                    $paymentStatus = checkPaymentStatus(Auth::user()->id);
                                                @endphp
                                                @if ($paymentStatus == 1)
                                                    <td>
                                                        @if ($duePayment->fee_type != 'admission_fee')
                                                            {{date('M d, Y',strtotime($duePayment->due_date))}}
                                                        @endif
                                                    </td>
                                                @endif
                                            @endif --}}
                                            <td>
                                                @php
                                                    if (Auth::user()->registration_type == 3) {

                                                        $paymentStatus = checkPaymentStatus(Auth::user()->id);
                                                        if ($paymentStatus == 1) {
                                                            $extraDate = extraDateFineCalculation(0,$duePayment->course_id,$duePayment->due_date,Auth::user()->id);

                                                            if ($extraDate > 0) {
                                                                $fine = $extraDate * 10;
                                                                $amount = $duePayment->amount + $fine;
                                                            }else{
                                                                $amount = $duePayment->amount;
                                                            }
                                                        } else {
                                                            $amount = $duePayment->amount;
                                                        }


                                                    }
                                                    elseif (Auth::user()->registration_type == 4) {
                                                        $amount = $duePayment->amount;
                                                    }
                                                    // elseif (Auth::user()->registration_type == 1) {
                                                    //     if ($duePayment->course_id > 0) {
                                                    //         $amount = $duePayment->amount;
                                                    //     }
                                                    // }
                                                    else {
                                                            if ($duePayment->class_id > 0 && $duePayment->course_id > 0) {
                                                                $extraDate = extraDateFineCalculation($duePayment->class_id,$duePayment->course_id,$duePayment->due_date,Auth::user()->id);
                                                            }
                                                            if ($duePayment->class_id == 0 && $duePayment->course_id > 0) {
                                                                $extraDate = extraDateFineCalculation(0,$duePayment->course_id,$duePayment->due_date,Auth::user()->id);
                                                            }
                                                            if ($duePayment->class_id > 0 && $duePayment->course_id == 0) {
                                                                $extraDate = extraDateFineCalculation($duePayment->class_id,0,$duePayment->due_date,Auth::user()->id);
                                                            }

                                                            if ($extraDate > 0) {
                                                                $fine = $extraDate * 10;
                                                                $amount = $duePayment->amount + $fine;
                                                            }else{
                                                                $amount = $duePayment->amount;
                                                            }
                                                    }
                                                @endphp
                                                <span>&#x20B9;{{ $amount }}
                                                    @if (isset($fine))
                                                        <span data-toggle="tooltip" data-placement="top" title="Fine" class="badge badge-warning">+&#x20B9;{{ $fine }}</span>
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <form action="{!! route('payment.capture') !!}" method="POST" id="payment_form">
                                                    @csrf
                                                    <input type="hidden" name="redirectURL" value="{{route('user.razorpaypayment',$duePayment->id)}}">
                                                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                                                            data-key="{{ env('RAZORPAY_KEY') }}"
                                                            data-amount="{{($amount) * 100}}"
                                                            data-name="Leading Lights"
                                                            data-description=""
                                                            data-image="{{ asset('img/logo.jpg') }}"
                                                            data-theme.color="#F0FFF0">
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
                                        <th>Order Id</th>
                                        @if (Auth::user()->registration_type == 4)
                                            <th>Video Title</th>
                                        @else
                                            <th>Fees Type</th>
                                        @endif
                                        <th>Payment Date</th>
                                        <th>Total Cost(&#x20B9;)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->success_payment as $successIndex => $successPayment)
                                        <tr>
                                            <td>{{$successPayment->id}}</td>
                                            <td>
                                                @php
                                                    $feeType = 'Admission Fees';
                                                    switch($successPayment->fee_type){
                                                        case 'admission_fee' : $feeType = 'Admission Fees with 1 month class fee';break;
                                                        case 'course_fee' : $feeType = 'Course Fee';break;
                                                        case 'class_fee' : $feeType = 'Class Fee';break;
                                                        case 'flash_course_fee' : $feeType = 'Flash Course Fee';break;
                                                    }
                                                    // echo $feeType. ' ('.getNameofClassOrCourse($duePayment).')';

                                                    $user_id = $duePayment->user_id;
                                                    $class_id = $successPayment->class_id;
                                                    $course_id = $successPayment->course_id;
                                                    $flash_course_id = $successPayment->flash_course_id;
                                                @endphp
                                                <span>
                                                    @if (Auth::user()->registration_type == 4)
                                                        <span  data-toggle="tooltip" data-placement="top" title="{{ getNameOfPaidVideo($successPayment) }}">
                                                         <span class="text-success font-weight-bold">  {{ Str::limit(getNameOfPaidVideo($successPayment),50) }} </span>
                                                        </span>
                                                    @endif
                                                    @if(Auth::user()->registration_type != 4)
                                                        {{ $feeType }} 
                                                        <span class="badge badge-info">
                                                            @if (Auth::user()->registration_type == 3)
                                                                @if ($flash_course_id >  0)
                                                                    {{ getNameofFlashCourse($successPayment) }}
                                                                @elseif($course_id > 0)
                                                                    {{ getNameofClassOrCourse($successPayment) }}
                                                                @endif
                                                            @else
                                                                {{ getNameofClassOrCourse($successPayment) }}
                                                            @endif
                                                        </span>
                                                    @endif
                                                </span>   
                                            </td>
                                            <td>{{ date('d-F-y',strtotime($successPayment->updated_at)) }}</td>
                                            <td>&#x20B9;{{$successPayment->amount}}</td>
                                            <td>
                                                <button class="mb-2 mr-2 btn-pill btn btn-dark btn-lg">Paid Successfully
                                                    <span class="ml-3">
                                                        <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                                    </span>
                                                </button>
                                                @if (Auth::user()->registration_type == 4)
                                                    @php
                                                        $video_details = App\Models\Video::find($successPayment->paid_video_id);
                                                        $file_path = $video_details->paid_video;
                                                        $file_extension= explode('.',$file_path)[1];
                                                    @endphp
                                                    <a class="mb-2 mr-2 btn-pill btn btn-info btn-lg" href="{{ asset($file_path) }}" download><i class="fa fa-download mr-2"></i>Download Video</a>
                                                @else  
                                                    <a class="mb-2 mr-2 btn-pill btn btn-info btn-lg" href="{{ route('user.payment_receipt', $successPayment->id) }}"><i class="fa fa-download mr-2"></i>Download Receipt</a>
                                                @endif
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
        $('.razorpay-payment-button').addClass('mb-2 mr-2 btn-pill btn btn-primary btn-lg');
    </script>
@endsection
