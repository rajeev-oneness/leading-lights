<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckTeacherPermission
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
        if ($user && $user->role_id == 3) {
            if($user->group_access == 1 || $user->class_access == 1){
                return $next($request);
            }
            return redirect()->route('teacher.profile');
        }
        return redirect()->route('teacher_login');
    }
}
