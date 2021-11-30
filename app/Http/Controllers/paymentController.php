<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction,Session,DB;
use Razorpay\Api\Api,Exception;

class paymentController extends Controller
{
    public function storerazorePayPayment(Request $req)
    {
        $req->validate([
            'stripeToken' => 'required|string',
            'amount' => 'required',
            'redirectURL' => 'required|string',
            'currency' => 'required|string',
        ]);
        \Stripe\Stripe::setApiKey('sk_test_4eC39HqLyjWDarjtT1zdp7dc');
        $payment = \Stripe\Charge::create ([
            "amount" => 100 * $req->amount,
            "currency" => $req->currency,
            "source" => $req->stripeToken,
            "description" => "Test payment",
        ]);
        if($payment->status == 'succeeded'){
            $newPayment = new Transaction();
            $newPayment->transactionId = $payment->id;
            $newPayment->order_id = emptyCheck($payment->balance_transaction);
            $newPayment->amount = $payment->amount;
            $newPayment->currency = emptyCheck($payment->currency);
            $newPayment->status = emptyCheck($payment->status);
            $newPayment->captured = emptyCheck($payment->captured);
            $newPayment->description = emptyCheck($payment->description);
            $newPayment->method = $payment->payment_method;
            $newPayment->amount_refunded = emptyCheck($payment->amount_refunded);
            $newPayment->refund_status = emptyCheck($payment->refunded);
            $newPayment->created_at_time = $payment->created;
            $newPayment->bank = $payment->payment_method_details->type;
            $newPayment->save();
            return redirect($req->redirectURL.'?transactionId='.$newPayment->id);
        }
        $error['stripePaymentGateway'] = 'Something went wrong please try after some time';
        return back()->withErrors($error)->withInput($req->all());
    }
}
