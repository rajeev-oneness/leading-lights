<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="brand-logo text-center">
        <img src="{{ public_path('img/logo.jpg') }}">
    </div>
    <p  class="text-success"><strong>Congratulation Your payment is successful.</strong><i class="fa fa-check-circle text-success" aria-hidden="true"></i></p>
    <table class="table table-striped table-bordered table-sm">
        <tbody>
            <tr>
                <td>Student Name</td>
                <td>{{ $user_details->first_name }} {{ $user_details->last_name }}</td>
            </tr>
            <tr>
                <td>Student UID</td>
                <td>{{ $user_details->id_no }}</td>
            </tr>
            <tr>
                <td>Class Enrollment</td>
                <td>
                    @if($userClass = $user_details->class_details)
                        {{$userClass->name}}
                    @endif
                </td>
            </tr>
            @if ($user_details->special_course_id)
                <tr>
                    <td>
                        Course Enrollment
                    </td>
                    <td>
                        @php
                            $course_details = App\Models\SpecialCourse::select('title')->whereIn('id', explode(',',$user_details->special_course_id))->pluck('title');
                            if(count($course_details) > 0){
                                echo implode(',',$course_details);
                            }else{
                                echo 'N/A';
                            }
                        @endphp
                    </td>
                </tr>
            @endif
            
        </tbody>
    </table>
    <p  class="text-success"><strong>Payment Information</strong></p>
    <table  class="table table-striped table-bordered table-sm">
        <tbody>
            <tr>
                <td>
                    @php
                        $feeType = 'Admission Fees';
                        switch($fee_details->fee_type){
                            case 'admission_fee' : $feeType = 'Admission Fees with 1 month class fee';break;
                            case 'course_fee' : $feeType = 'Course Fee';break;
                            case 'class_fee' : $feeType = 'Class Fee';break;
                        }
                        echo $feeType;
                    @endphp
                </td>
                <td>Rs. {{ $fee_details->amount }}</td>
            </tr>
            @if($transaction = $fee_details->transaction_details)
            <tr>
                <td>Transaction Id</td>
                <td>{{ $transaction->transactionId }}</td>
            </tr>
            <tr>
                <td>Payment Method</td>
                <td>{{ $transaction->method }}</td>
            </tr>
            <tr>
                <td>Date</td>
                <td>{{ date('d-m-Y h:i A', strtotime($transaction->created_at)) }}</td>
            </tr>
            @endif
        </tbody>
    </table>
</body>
</html>
