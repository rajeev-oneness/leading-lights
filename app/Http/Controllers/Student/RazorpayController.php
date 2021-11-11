<?php

namespace App\Http\Controllers\Student;

use Razorpay\Api\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RazorpayController extends Controller
{
    public function payment(Request $request)
    {        
        $input = $request->all(); 
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) 
        {
            try 
            {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
                if ($response) {
                    $payment = new Payment();
                    $payment->user_id = Auth::user()->id;
                    $payment->amount = $response->amount/100;
                    $payment->payment_method = $response->method;
                    $payment->invoice_no = $response->id;
                    
                    if ($request->fees_type === 'admission_fee') {
                        $payment->fees_type = 'admission_fee';
                        if (Auth::user()->special_course_id) {
                            $next_due_date = date('Y-m-d',strtotime('first day of +1 month'));
                            $payment_month = date('Y-m-d');
                        }else{
                            $next_date = date('Y-m-d',strtotime('first day of +2 month'));
                            $next_due_date = date('Y-m-d', strtotime($next_date. ' + 4 days'));
                            $payment_month = date('Y-m-d',strtotime('first day of +1 month'));
                        }
                        $payment->payment_month = $payment_month;
                        $payment->next_due_date = $next_due_date;
                    }
                    if ($request->fees_type === 'monthly_fees') {
                        $previous_payment = Payment::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->first();
                        //Next date for payment 
                        $next_due_date = $previous_payment->next_due_date;

                        $next_date = date('Y-m-d',strtotime("+1 months",strtotime($previous_payment->next_due_date)));
                        $payment->payment_month = $next_due_date;
                        $payment->fees_type = 'monthly_fees';
                        $payment->next_due_date = $next_date;
                    } 
                    $payment->status = 1;
                    $payment->save(); 
                   
                }

            } 
            catch (\Exception $e) 
            {
                return  $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }            
        }
        
        Session::put('success', 'Payment successful, your order will be despatched in the next 48 hours.');
        return redirect()->back()->with('success', 'Payment successful, your order will be despatched in the next 48 hours.');
    }

}
