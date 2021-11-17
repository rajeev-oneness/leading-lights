<?php

namespace App\Http\Middleware;

use App\Models\Attendance;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionTimeOut
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
        if (! session()->has('lastActivityTime')) {
            session(['lastActivityTime' => now()]);
        }
        if (now()->diffInMinutes(session('lastActivityTime')) >= (500) ) {  
            if (Auth::check() && Auth::user()->role_id == 3) {
                $user = Attendance::where('user_id',Auth::user()->id)->where('logout_time',null)->first();
                $user->logout_time = getAsiaTime24(date('Y-m-d H:i:s'));
                $user->save();
                auth()->logout();
                session()->forget('lastActivityTime');
                return redirect(route('teacher_login'));
            }
            // if (Auth::check() && Auth::user()->role_id == 4) {
            //     auth()->logout();
            //     session()->forget('lastActivityTime');
            //     return redirect(route('login'));
            // }
     
        }
        return $next($request);
    }
}
