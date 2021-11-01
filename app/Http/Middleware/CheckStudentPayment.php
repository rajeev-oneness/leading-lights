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
            if (isset($payment_details) && Auth::user()->status == 1) {
                return $next($request);
            }else{
                return redirect()->route('user.payment');
            }           
        } else {
            return redirect()->route('login');
        }
    }
}
