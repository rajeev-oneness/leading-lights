<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>
  <body>
    <h2 class="text-center">Leading Lights</h2>
    <div class="brand-logo text-center pt-5">
        <img src="{{ public_path('img/logo.jpg') }}">
    </div>
    <p>Congratulation Your payment is successful.<i class="fa fa-check-circle text-success"
      aria-hidden="true"></i></p>
    <p><strong>Name of Student:</strong> {{ $user_details->first_name }} {{ $user_details->last_name }}</p>
    <p><strong>Student Id :</strong> {{ $user_details->id_no }}</p>
    @php
        $class_details = App\Models\Classes::where('id',$user_details->class)->first('name')
    @endphp
    <p><strong>Class :</strong> {{ $class_details->name }}</span>
    <p><strong class="text-success">Your payment details is below: </strong> </p>
    <p><strong>Payment Id: </strong> {{ $payment_details->invoice_no }}</p>
    @if ($user_details->special_course_id)
    <p><strong>Payment For: </strong> {{ $payment_details->fees_type === 'monthly_fees' ? 'Monthly Fees for '.date('F',strtotime($payment_details->payment_month)) : 'Admission Fees'}}</p>  
    @else
    <p><strong>Payment For: </strong> {{ $payment_details->fees_type === 'monthly_fees' ? 'Monthly Fees for '.date('F',strtotime($payment_details->payment_month)) : 'Admission Fees with 1 month advance'}}</p>   
    @endif
    <p><strong>Amount: Rs</strong>{{ $payment_details->amount }}</p>
    <p><strong>Payment Method: </strong>{{ $payment_details->payment_method }}</p>
    <p><strong>Date: </strong>{{ date('Y-m-d',strtotime($payment_details->created_at)) }}</p>
    <p><strong>Time: </strong>{{ getAsiaTime24($payment_details->created_at) }}</p>
  </body>
</html>