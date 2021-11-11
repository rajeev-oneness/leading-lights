<?php

namespace App\Http\Middleware;

use App\Models\Payment;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckStudentPayment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $payment_details = Payment::where('user_id',Auth::user()->id)->first();
        if (Auth::check() && Auth::user()->role->id == 4) {
            if ($payment_details && Auth::user()->status == 1) {
                $next_due_date = $payment_details->next_due_date;
                $additional_next_due_date = date('Y-m-d',strtotime($next_due_date.'+2 day'));
                if ($additional_next_due_date < date('Y-m-d') && Auth::user()->special_course_id) {
                    return redirect()->route('user.payment');
                }
                return $next($request);
            }
            return redirect()->route('user.payment');
          
        }
        return redirect()->route('login');
    }
}
