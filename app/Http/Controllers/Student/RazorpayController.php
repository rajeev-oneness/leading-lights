<?php

namespace App\Http\Controllers\Student;

use Razorpay\Api\Api;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\SpecialCourse;
use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\OtherPaymentDetails;
use App\Models\User, DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Notifications\PaymentSuccessMail;
use Illuminate\Support\Facades\Notification;

class RazorpayController extends Controller
{
    public function payment(Request $req, $feeId)
    {
        if (!empty($req->transactionId) && $req->transactionId > 0) {
            DB::beginTransaction();
            try {
                $user = Auth::user();
                $fee = \App\Models\Fee::where('id', $feeId)->where('user_id', $user->id)->where('transaction_id', 0)->first();
                if ($fee) {
                    $transaction = \App\Models\Transaction::where('id', $req->transactionId)->first();
                    if ($transaction) {
                        $fee->transaction_id = $transaction->id;
                        $fee->paid_on = date('Y-m-d');
                        $fee->save();
                        $newFee = false;

                        if (Auth::user()->registration_type != 3) {

                            if ($fee->class_id != 0) {
                                // dd('test1');
                                $class = \App\Models\Classes::where('id', $fee->class_id)->first();
                                if ($class) {
                                    $next_date = date('Y-m-d',strtotime('first day of +2 month'));
                                    $next_due_date = date('Y-m-d', strtotime($next_date. ' + 4 days'));

                                    $feeType = 'class_fee';
                                    $amount = $class->monthly_fees;
                                    $newFee = true;
                                }
                            } elseif ($fee->course_id != 0) {
                                $course = \App\Models\SpecialCourse::where('id', $fee->course_id)->first();

                                $user_details = User::find($fee->user_id);
                                $all_available_courses_ids = explode(',', $user->special_course_ids);
                                if (!in_array($course->id, $all_available_courses_ids)) {
                                    $user_details->special_course_ids = $user_details->special_course_ids . ','. $course->id;
                                    $user_details->save();
                                }

                                $next_date = date('Y-m-d',strtotime($course->start_date.'first day of +1 month'));
                                $next_due_date = date('Y-m-d', strtotime($next_date. ' + 4 days'));
                                if ($course) {
                                    $feeType = 'course_fee';
                                    $amount = $course->monthly_fees;
                                    $newFee = true;
                                }

                            }
                        }
                        if (Auth::user()->registration_type == 3) {
                            $paymentCount = Fee::where('user_id',Auth::user()->id)->count();

                            if ($paymentCount > 1) {
                                $course = SpecialCourse::where('id', $fee->course_id)->first();

                                $user_details = User::find($fee->user_id);
                                if ($user_details->special_course_ids == '') {
                                    $user_details->special_course_ids = $course->id;
                                    $user_details->save();
                                }
                                else{
                                    $all_available_courses_ids = explode(',', $user->special_course_ids);
                                    if (!in_array($course->id, $all_available_courses_ids)) {
                                        $user_details->special_course_ids = $user_details->special_course_ids . ','. $course->id;
                                        $user_details->save();
                                    }
                                }

                                $next_date = date('Y-m-d',strtotime($course->start_date.'first day of +1 month'));
                                $next_due_date = date('Y-m-d', strtotime($next_date. ' + 4 days'));
                                if ($course) {
                                    $feeType = 'course_fee';
                                    $amount = $course->monthly_fees;
                                    $newFee = true;
                                }
                            }

                        }
                        if ($newFee && $amount > 0) {
                            // dd($amount);
                            $newFee = new \App\Models\Fee;
                            $newFee->user_id = $fee->user_id;
                            $newFee->class_id = $fee->class_id;
                            $newFee->course_id = $fee->course_id;
                            $newFee->fee_type = $feeType;
                            $newFee->due_date = date("Y-m-d", strtotime("+1 month", strtotime($fee->due_date)));
                            // $newFee->due_date = $next_due_date;
                            $newFee->payment_month = date("F");
                            $newFee->amount = $amount;
                            $newFee->save();
                        }
                    }
                }
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
            }
        }
        $user_id =  Auth::user()->id;
        createNotification($user_id, 0, 0, 'payment_student');

        Session::put('success', 'Payment successful.');
        return redirect()->back()->with('success', 'Payment successful.');
    }

    public function payment_old(Request $request)
    {
        $input = $request->all();
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if (count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                if ($response) {
                    $payment = new Payment();
                    $payment->user_id = Auth::user()->id;
                    $payment->amount = ($response->amount / 100);
                    // dd($payment->amount);
                    $payment->payment_method = $response->method;
                    $payment->invoice_no = $response->id;
                    $payment->status = 1;
                    $payment->save();

                    // Other payment details

                    if ($request->fees_type === 'admission_fee') {
                        if (Auth::user()->special_course_ids) {
                            $special_course_ids = explode(',', Auth::user()->special_course_ids);
                            foreach ($special_course_ids as $course_id) {
                                $course_details[] = SpecialCourse::find($course_id);
                            }

                            foreach ($course_details as $key => $course) {

                                $other_payment_details = new OtherPaymentDetails();
                                $other_payment_details->fees_type = 'admission_fee';
                                $other_payment_details->payment_id = $payment->id;
                                $other_payment_details->user_id = Auth::user()->id;
                                $other_payment_details->course_id = $course->id;

                                $course_start_date = $course->start_date;
                                $next_date = date('Y-m-d', strtotime($course_start_date . 'first day of +1 month'));
                                $next_due_date = date('Y-m-d', strtotime($next_date . ' + 4 days'));
                                $other_payment_details->payment_month = $course_start_date;
                                $other_payment_details->next_due_date = $next_due_date;

                                $other_payment_details->save();
                            }
                        } else {
                            $other_payment_details = new OtherPaymentDetails();
                            $other_payment_details->fees_type = 'admission_fee';
                            $other_payment_details->payment_id = $payment->id;
                            $other_payment_details->user_id = Auth::user()->id;
                            $other_payment_details->class_id = $request->class_id;

                            $next_date = date('Y-m-d', strtotime('first day of +2 month'));
                            $other_payment_details->next_due_date = date('Y-m-d', strtotime($next_date . ' + 4 days'));
                            $other_payment_details->payment_month = date('Y-m-d', strtotime('first day of +1 month'));
                            $other_payment_details->save();
                        }
                        // $payment->payment_month = $payment_month;
                        // $payment->next_due_date = $next_due_date;
                    }
                    if ($request->fees_type === 'monthly_fees') {
                        if ($request->type === 'course') {
                            $other_payment_details = new OtherPaymentDetails();
                            $other_payment_details->payment_id = $payment->id;
                            $other_payment_details->user_id = Auth::user()->id;
                            $other_payment_details->course_id = $request->course_id;
                            $other_payment_details->fees_type = 'monthly_fees';

                            $previous_payment = OtherPaymentDetails::where('user_id', Auth::user()->id)->where('course_id', $request->course_id)->orderBy('id', 'desc')->first();
                            // $course_details = SpecialCourse::find($request->course_id);
                            $next_due_date = date('Y-m-d', strtotime("+1 months", strtotime($previous_payment->next_due_date)));

                            $other_payment_details->payment_month = $previous_payment->next_due_date;
                            $other_payment_details->next_due_date = $next_due_date;
                            $other_payment_details->save();
                        } elseif ($request->type === 'new_course') {
                            // dd(explode(',',$request->course_id));
                            $all_corses = $request->course_id;
                            foreach ($all_corses as $key => $course_id) {
                                $other_payment_details = new OtherPaymentDetails();
                                $other_payment_details->payment_id = $payment->id;
                                $other_payment_details->user_id = Auth::user()->id;
                                $other_payment_details->course_id = $course_id;
                                $other_payment_details->class_id = Auth::user()->class;
                                $other_payment_details->fees_type = 'monthly_fees';

                                // $previous_payment = OtherPaymentDetails::where('user_id',Auth::user()->id)->where('course_id',$request->course_id)->orderBy('id', 'desc')->first();
                                $course_details = SpecialCourse::find($course_id);
                                $next_due_date = date('Y-m-d', strtotime("+1 months", strtotime($course_details->start_date)));

                                $other_payment_details->payment_month = $course_details->start_date;
                                $other_payment_details->next_due_date = $next_due_date;
                                $other_payment_details->save();

                                $user_details = User::find(Auth::user()->id);
                                if ($user_details->special_course_ids) {
                                    $user_details->special_course_ids = $user_details->special_course_ids . ',' . $course_id;
                                } else {
                                    $user_details->special_course_ids = $user_details->special_course_ids . $course_id;
                                }
                                $user_details->save();
                            }
                            Session::put('success', 'Payment successful, your order will be despatched in the next 48 hours.');
                            return redirect()->route('user.payment')->with('success', 'Payment successful, your order will be despatched in the next 48 hours.');
                        } else {
                            $other_payment_details = new OtherPaymentDetails();
                            $other_payment_details->payment_id = $payment->id;
                            $other_payment_details->user_id = Auth::user()->id;
                            $other_payment_details->class_id = $request->class_id;
                            $other_payment_details->fees_type = 'monthly_fees';

                            $previous_payment = OtherPaymentDetails::where('user_id', Auth::user()->id)->where('class_id', $request->class_id)->orderBy('id', 'desc')->first();
                            //Next date for payment
                            $next_due_date = date('Y-m-d', strtotime("+1 months", strtotime($previous_payment->next_due_date)));

                            $other_payment_details->payment_month = $previous_payment->next_due_date;
                            $other_payment_details->next_due_date = $next_due_date;
                            $other_payment_details->save();
                        }
                    }


                    // Notification::route('mail', Auth::user()->email)->notify(new PaymentSuccessMail($payment));

                }
            } catch (\Exception $e) {
                return  $e->getMessage();
                Session::put('error', $e->getMessage());
                return redirect()->back();
            }
        }

        Session::put('success', 'Payment successful, your order will be despatched in the next 48 hours.');
        return redirect()->back()->with('success', 'Payment successful, your order will be despatched in the next 48 hours.');
    }
}
