<?php

namespace App\Http\Controllers\Admin;

use Razorpay\Api\Api;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\SpecialCourse;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Fee;
use App\Models\OtherPaymentDetails;
use App\Models\Transaction;
use App\Models\User, DB;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Notifications\PaymentSuccessMail;
use Illuminate\Support\Facades\Notification;

class RazorpayController extends Controller
{
    public function payment(Request $req, $feeId,$userId)
    {
        DB::beginTransaction();
        try {
            $user = User::find($userId);
            $fee = \App\Models\Fee::where('id', $feeId)->where('user_id', $user->id)->where('transaction_id', 0)->first();
            if ($fee) {
                /**
                 * This is an offline transaction
                 * So we manually provide transactionId
                 * Which is used for next transaction
                 */
                $transaction_count = Transaction::where('method','Cash payment')->count();
                $num_padded = sprintf("%05d", ($transaction_count + 1));
                $transaction_id = 'offline_pay_' . $num_padded;

                $newPayment = new Transaction();
                $newPayment->transactionId = $transaction_id;
                $newPayment->entity = 'payment';
                $newPayment->amount = $fee->amount;
                $newPayment->currency = 'INR';
                $newPayment->status = 'captured';
                $newPayment->method = 'Cash payment';
                $newPayment->captured = 1;
                $newPayment->created_at_time = time();
                $newPayment->save();

                /**
                 * Use this above transaction_id to the fees table
                 * So it's denoted that the payment is done 
                 */

                $fee->transaction_id = $newPayment->id;
                $fee->paid_on = date('Y-m-d');
                $fee->save();
                $newFee = false;

                if ($user->registration_type != 3 && $user->registration_type != 4) {

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
                if ($user->registration_type == 3) {
                    $paymentCount = Fee::where('user_id',$user->id)->count();

                    if ($paymentCount > 1 && $fee->flash_course_id > 0) {
                        $course = Course::where('id', $fee->flash_course_id)->first();

                        $user_details = User::find($fee->user_id);
                        if ($user_details->flash_course_id	 == '') {
                            $user_details->flash_course_id	 = $course->id;
                            $user_details->save();
                        }
                        else{
                            $all_available_courses_ids = explode(',', $user->flash_course_id);
                            if (!in_array($course->id, $all_available_courses_ids)) {
                                $user_details->flash_course_id	 = $user_details->flash_course_id	 . ','. $course->id;
                                $user_details->save();
                            }
                        }
                        $newFee = false;
                    }

                    if ($paymentCount > 1 && $fee->flash_course_id == 0) {
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
                if ($user->registration_type == 4) {
                    $paymentCount = Fee::where('user_id',$user->id)->count();

                    if ($paymentCount > 1) {
                        $video = Video::where('id', $fee->paid_video_id)->first();
                        // dd($video);

                        $user_details = User::find($fee->user_id);
                        $user_details->video_id = $user_details->video_id .','. $video->id;
                        $user_details->save();
                        // if ($user_details->special_course_ids == '') {
                        //     $user_details->special_course_ids = $course->id;
                        //     $user_details->save();
                        // }
                        // else{
                        //     $all_available_courses_ids = explode(',', $user->special_course_ids);
                        //     if (!in_array($course->id, $all_available_courses_ids)) {
                        //         $user_details->special_course_ids = $user_details->special_course_ids . ','. $course->id;
                        //         $user_details->save();
                        //     }
                        // }

                        // $next_date = date('Y-m-d',strtotime($course->start_date.'first day of +1 month'));
                        // $next_due_date = date('Y-m-d', strtotime($next_date. ' + 4 days'));
                        if ($video) {
                            $feeType = 'paid_video_fee';
                            $amount = $video->amount;
                            $newFee = false;
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
                    if ($fee->fee_type == 'class_fee' || $fee->fee_type == 'course_fee') {
                        $newFee->due_date = date("Y-m-d", strtotime("+1 month", strtotime($fee->due_date)));
                    }
                    if ($fee->fee_type == 'admission_fee') {
                        $newFee->due_date = $next_due_date;
                    }
                    $newFee->payment_month = date("F");
                    $newFee->amount = $amount;
                    $newFee->save();
                }
                
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        $user_id =  $user->id;
        createNotification($user_id, 0, 0, 'payment_student');

        Session::put('success', 'Payment successful.');
        return redirect()->route('admin.transaction.index')->with('success', 'Payment successful.');
    }
    public function paymentOld(Request $req, $feeId,$userId)
    {
        if (!empty($req->transactionId) && $req->transactionId > 0) {
            DB::beginTransaction();
            try {
                $user = User::find($userId);
                $fee = \App\Models\Fee::where('id', $feeId)->where('user_id', $user->id)->where('transaction_id', 0)->first();
                if ($fee) {
                    $transaction = \App\Models\Transaction::where('id', $req->transactionId)->first();
                    if ($transaction) {
                        $fee->transaction_id = $transaction->id;
                        $fee->paid_on = date('Y-m-d');
                        $fee->save();
                        $newFee = false;

                        if ($user->registration_type != 3 && $user->registration_type != 4) {

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
                        if ($user->registration_type == 3) {
                            $paymentCount = Fee::where('user_id',$user->id)->count();

                            if ($paymentCount > 1 && $fee->flash_course_id > 0) {
                                $course = Course::where('id', $fee->flash_course_id)->first();

                                $user_details = User::find($fee->user_id);
                                if ($user_details->flash_course_id	 == '') {
                                    $user_details->flash_course_id	 = $course->id;
                                    $user_details->save();
                                }
                                else{
                                    $all_available_courses_ids = explode(',', $user->flash_course_id);
                                    if (!in_array($course->id, $all_available_courses_ids)) {
                                        $user_details->flash_course_id	 = $user_details->flash_course_id	 . ','. $course->id;
                                        $user_details->save();
                                    }
                                }
                                $newFee = false;
                            }

                            if ($paymentCount > 1 && $fee->flash_course_id == 0) {
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
                        if ($user->registration_type == 4) {
                            $paymentCount = Fee::where('user_id',$user->id)->count();

                            if ($paymentCount > 1) {
                                $video = Video::where('id', $fee->paid_video_id)->first();
                                // dd($video);

                                $user_details = User::find($fee->user_id);
                                $user_details->video_id = $user_details->video_id .','. $video->id;
                                $user_details->save();
                                // if ($user_details->special_course_ids == '') {
                                //     $user_details->special_course_ids = $course->id;
                                //     $user_details->save();
                                // }
                                // else{
                                //     $all_available_courses_ids = explode(',', $user->special_course_ids);
                                //     if (!in_array($course->id, $all_available_courses_ids)) {
                                //         $user_details->special_course_ids = $user_details->special_course_ids . ','. $course->id;
                                //         $user_details->save();
                                //     }
                                // }

                                // $next_date = date('Y-m-d',strtotime($course->start_date.'first day of +1 month'));
                                // $next_due_date = date('Y-m-d', strtotime($next_date. ' + 4 days'));
                                if ($video) {
                                    $feeType = 'paid_video_fee';
                                    $amount = $video->amount;
                                    $newFee = false;
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
                            if ($fee->fee_type == 'class_fee' || $fee->fee_type == 'course_fee') {
                                $newFee->due_date = date("Y-m-d", strtotime("+1 month", strtotime($fee->due_date)));
                            }
                            if ($fee->fee_type == 'admission_fee') {
                                $newFee->due_date = $next_due_date;
                            }
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
        $user_id =  $user->id;
        createNotification($user_id, 0, 0, 'payment_student');

        Session::put('success', 'Payment successful.');
        return redirect()->route('admin.transaction.index')->with('success', 'Payment successful.');
    }
}
