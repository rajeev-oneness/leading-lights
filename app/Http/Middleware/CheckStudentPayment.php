<?php

namespace App\Http\Middleware;

use App\Models\Fee;
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
        $user = Auth::user();
        if ($user && $user->role_id == 4) {
            $fee = Fee::where('user_id',$user->id)->where('transaction_id','>',0)->count();
            if($fee > 0){
                return $next($request);
            }
            return redirect()->route('user.payment');
        }
        return redirect()->route('login');
    }
}
