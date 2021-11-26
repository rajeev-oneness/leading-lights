<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    {{-- <h2 class="text-center">Leading Lights</h2> --}}
    <div class="brand-logo text-center">
        <img src="{{ public_path('img/logo.jpg') }}">
    </div>
    <p  class="text-success"><strong>Congratulation Your payment is successful.</strong><i class="fa fa-check-circle text-success" aria-hidden="true"></i></p>
    <table class="table table-striped table-bordered table-sm">
        <tbody>
            <tr>
                <td>
                    Student Name
                </td>
                <td>
                    {{ $user_details->first_name }} {{ $user_details->last_name }}
                </td>
            </tr>
            <tr>
                <td>
                   Student UID
                </td>
                <td>
                   {{ $user_details->id_no }}
                </td>
            </tr>
            <tr>
                <td>
                    Class
                </td>
                <td>
                    @php
                        $class_details = App\Models\Classes::where('id', $user_details->class)->first('name');
                    @endphp
                    {{ $class_details->name }}
                </td>
            </tr>
            @if ($user_details->special_course_id)
                <tr>
                    <td>
                        Course
                    </td>
                    <td>
                        @php
                            $course_details = App\Models\SpecialCourse::where('id', $user_details->special_course_id)->first('title');
                         @endphp
                        {{ $course_details->title }}
                    </td>
                </tr>
            @endif
            @if (!$user_details->special_course_id)
            <tr>
                <td>
                    Academic Session 
                </td>
                <td>
                     {{ date('Y',strtotime($payment_details->created_at)) }}
                     - {{ date('Y',strtotime($payment_details->created_at.'+1 year')) }}
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
                    {{ $payment_details->fees_type === 'monthly_fees' ? 'Monthly Fees' : 'Admission Fees' }}
                </td>
                <td>
                    Rs. {{ $payment_details->amount }}
                </td>
            </tr>
            <tr>
                <td>
                    Payment For
                </td>
                <td>
                    @if ($user_details->special_course_ids)
                    <span class="text-info">
                        {{ $payment_details->fees_type === 'monthly_fees' ? 'Monthly Fees for ' . date('F', strtotime($payment_details->payment_month)) : 'Admission Fees' }}
                    </span>
                    @else
                    <span class="text-info">
                        {{ $payment_details->fees_type === 'monthly_fees' ? 'Monthly Fees for ' . date('F', strtotime($payment_details->payment_month)) : 'Admission Fees with 1 month advance' }}
                    </span>
                @endif
                </td>
            </tr>
            <tr>
                <td>
                    Transaction Id
                </td>
                <td>
                    {{ $payment_details->invoice_no }}
                </td>
            </tr>
            <tr>
                <td>
                    Payment Method
                </td>
                <td>
                    {{ $payment_details->payment_method }}
                </td>
            </tr>
            <tr>
                <td>
                   Date
                </td>
                <td>
                    {{ date('d-m-Y', strtotime($payment_details->created_at)) }} {{ date('h:i A',strtotime(getAsiaTime24($payment_details->created_at))) }}
                </td>
            </tr>
        </tbody>
    </table>

    {{-- <p><strong>Payment Id: </strong> {{ $payment_details->invoice_no }}</p>
    @if ($user_details->special_course_id)
        <p><strong>Payment For: </strong>
            {{ $payment_details->fees_type === 'monthly_fees' ? 'Monthly Fees for ' . date('F', strtotime($payment_details->payment_month)) : 'Admission Fees' }}
        </p>
    @else
        <p><strong>Payment For: </strong>
            {{ $payment_details->fees_type === 'monthly_fees' ? 'Monthly Fees for ' . date('F', strtotime($payment_details->payment_month)) : 'Admission Fees with 1 month advance' }}
        </p>
    @endif
    <p><strong>Amount: Rs</strong>{{ $payment_details->amount }}</p>
    <p><strong>Payment Method: </strong>{{ $payment_details->payment_method }}</p>
    <p><strong>Date: </strong>{{ date('Y-m-d', strtotime($payment_details->created_at)) }}</p>
    <p><strong>Time: </strong>{{ getAsiaTime24($payment_details->created_at) }}</p> --}}
</body>

</html>
