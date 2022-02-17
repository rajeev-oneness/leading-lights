@extends('admin.layouts.master')
@section('content')
<div class="dashboard-body" id="content">
				<div class="dashboard-content">
					<div class="row m-0 dashboard-content-header">
					<div class="col-lg-6 d-flex">
						<a id="sidebarCollapse" href="javascript:void(0);">
							<i class="fas fa-bars"></i>
						</a>
						<ul class="breadcrumb p-0">
							<li><a href="{{ route('admin.dashboard')}}">Home</a></li>
							<li class="text-white"><i class="fa fa-chevron-right"></i></li>
							<li><a href="{{ route('admin.transaction.index')}}">All Transaction List</a></li>
							<li class="text-white"><i class="fa fa-chevron-right"></i></li>
							<li><a href="#" class="active">Add Transaction</a></li>
						</ul>
					</div>
					@include('admin.layouts.navbar')
				</div>
				<hr>
				<div class="dashboard-body-content">
                        <h5>Payment to be made for <b>{{ $data->user_details->first_name }} {{ $data->user_details->last_name }}</b></h5>
                        <div class="tabs-animation">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="payment_table">
                                            <thead>
                                                <tr>
                                                    <th>Order Id</th>
                                                    <th>Fees Type</th>
                                                    @if ($data->user_details->registration_type != 3 && $data->user_details->registration_type != 4)
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
                                                                @if ($data->user_details->registration_type != 4)
                                                                     {{ $feeType }}
                                                                     <span class="badge badge-info">
                                                                        @if ($data->user_details->registration_type == 3)
                                                                            @php
                                                                                $paymentStatus = checkPaymentStatus($data->user_details->id);
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
                                                                        @elseif ($data->user_details->registration_type == 4)
                                                                            {{-- One Time Payment --}}
                                                                        @else
                                                                            {{ getNameofClassOrCourse($duePayment) }}
                                                                        @endif
                                                                    </span>
                                                                @endif
                                                                @if ($data->user_details->registration_type == 4)
                                                                        One Time Payment
                                                                @endif
            
                                                        </span>
                                                        </td>
                                                        @if ($data->user_details->registration_type != 3 && $data->user_details->registration_type != 4)
                                                        <td>
                                                            @if ($duePayment->fee_type != 'admission_fee')
                                                                {{date('M d, Y',strtotime($duePayment->due_date))}}
                                                            @endif
                                                        </td>
                                                        @endif
                                                        {{-- @if ($data->user_details->registration_type == 3)
                                                            @php
                                                                $paymentStatus = checkPaymentStatus($data->user_details->id);
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
                                                                if ($data->user_details->registration_type == 3) {
            
                                                                    $paymentStatus = checkPaymentStatus($data->user_details->id);
                                                                    if ($paymentStatus == 1) {
                                                                        $extraDate = extraDateFineCalculation(0,$duePayment->course_id,$duePayment->due_date,$data->user_details->id);
            
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
                                                                elseif ($data->user_details->registration_type == 4) {
                                                                    $amount = $duePayment->amount;
                                                                }
                                                                // elseif ($data->user_details->registration_type == 1) {
                                                                //     if ($duePayment->course_id > 0) {
                                                                //         $amount = $duePayment->amount;
                                                                //     }
                                                                // }
                                                                else {
                                                                        if ($duePayment->class_id > 0 && $duePayment->course_id > 0) {
                                                                            $extraDate = extraDateFineCalculation($duePayment->class_id,$duePayment->course_id,$duePayment->due_date,$data->user_details->id);
                                                                        }
                                                                        if ($duePayment->class_id == 0 && $duePayment->course_id > 0) {
                                                                            $extraDate = extraDateFineCalculation(0,$duePayment->course_id,$duePayment->due_date,$data->user_details->id);
                                                                        }
                                                                        if ($duePayment->class_id > 0 && $duePayment->course_id == 0) {
                                                                            $extraDate = extraDateFineCalculation($duePayment->class_id,0,$duePayment->due_date,$data->user_details->id);
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
                                                                <input type="hidden" name="redirectURL" value="{{route('admin.razorpaypayment',[$duePayment->id,$data->user_details->id])}}">
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
				</div>
				</div>
			</div>
            <script>
                $(document).ready(function() {
                    $('#payment_table').DataTable({
                        order : []
                    });
                });
                $('.razorpay-payment-button').addClass('mb-2 mr-2 btn-pill btn btn-primary btn-lg');
            </script>

@endsection