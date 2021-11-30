<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction,Session,DB;
use Razorpay\Api\Api,Exception;

class PaymentController extends Controller
{
    public function storeRazorePayPayment(Request $req)
    {
        $req->validate([
            'razorpay_payment_id' => 'required|string',
            'redirectURL' => 'required',
        ]);
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($req->razorpay_payment_id);
        if($payment){
            try{
                $response = $payment->capture(array('amount' => $payment['amount']));
                if($response){
                    $newPayment = new Transaction();
                    $newPayment->transactionId = $response->id;
                    $newPayment->entity = emptyCheck($response->entity);
                    $newPayment->amount = ($response->amount / 100);
                    $newPayment->currency = emptyCheck($response->currency);
                    $newPayment->status = emptyCheck($response->status);
                    $newPayment->order_id = emptyCheck($response->order_id);
                    $newPayment->invoice_id = emptyCheck($response->invoice_id);
                    $newPayment->international = emptyCheck($response->international);
                    $newPayment->method = emptyCheck($response->method);
                    $newPayment->amount_refunded = emptyCheck($response->amount_refunded);
                    $newPayment->refund_status = emptyCheck($response->refund_status);
                    $newPayment->captured = emptyCheck($response->captured);
                    $newPayment->description = emptyCheck($response->description);
                    $newPayment->card_id = emptyCheck($response->card_id);
                    $newPayment->bank = emptyCheck($response->bank);
                    $newPayment->wallet = emptyCheck($response->wallet);
                    $newPayment->vpa = emptyCheck($response->vpa);
                    $newPayment->email = emptyCheck($response->email);
                    $newPayment->contact = emptyCheck($response->contact);
                    $newPayment->created_at_time = $response->created_at;
                    $newPayment->save();
                    return redirect($req->redirectURL.'?transactionId='.$newPayment->id);
                }
                return response()->json(['error' => true,'message' => 'Something went wrong please try after some time']);
            }catch(Exception $e){
                return response()->json(['error' => true,'message' => $e->getMessage()]);
            }
        }
        return response()->json(['error' => true,'message' => 'Payment Not done, your money will be refunded withing 7 days']);
    }
}
