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
                   $payment->amount = $response->amount;
                   $payment->payment_method = $response->method;
                   $payment->invoice_no = $response->id;
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
