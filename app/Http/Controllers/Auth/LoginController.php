<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $req)
    {
        $req->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $inactive_user = User::where('email',$req->email)->where('status',0)->where('rejected',0)->first();
        $user = User::where('email', $req->email)->first();
        if ($user) {
            if ($user->role_id == 4) {
                if ($inactive_user) {
                    auth()->logout();
                    return back()->with('error', 'Your account is not active.')->withInput();
                }
                if (Hash::check($req->password, $user->password)) {
                    Auth::login($user);
                    return redirect()->intended('/home');
                } else {
                    $errors['password'] = 'You have entered wrong password';
                }
            } else {
                $errors['email'] = 'This email is not register with us';
            }
        } else {
            $errors['email'] = 'This email is not register with us';
        }
        return back()->withErrors($errors)->withInput($req->all());
    }

    public function logout(Request $request)
    {
        //Attendance
        $check_attendance = Attendance::where('user_id',Auth::user()->id)
        ->whereDate('date','=',date('Y-m-d'))
        ->where('logout_time','=',null)
        ->first();
        // dd( $check_attendance);
        if (Auth::user()->role_id == 3) {
            $check_attendance->user_id = Auth::user()->id;
            $check_attendance->date = date('Y-m-d');
            $check_attendance->logout_time = getAsiaTime24(date('y-m-d H:i:s'));
            $check_attendance->save();
        }

        if (Auth::check() && Auth::user()->role_id == 2) {
            auth()->guard()->logout();
            $request->session()->invalidate();
            return redirect()->route('hr_login');
        }
        if (Auth::check() && Auth::user()->role_id == 3) {
            auth()->guard()->logout();
            $request->session()->invalidate();
            return redirect()->route('teacher_login');
        }
        if (Auth::check() && Auth::user()->role_id == 4) {
            auth()->guard()->logout();
            $request->session()->invalidate();
            return redirect()->route('login');
        }
        
    }

    public function teacher_login(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('auth.teacher_login');
        } else if ($request->method() == 'POST') {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
            $inactive_user = User::where('email',$request->email)->where('status',0)->first();
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if ($user->role_id == 3) {
                    if ($inactive_user) {
                        auth()->logout();
                        return back()->with('error', 'Your account is not active.');
                    }
                    if (Hash::check($request->password, $user->password)) {
                        Auth::login($user);

                        //Attendance
                        // $check_attendance = Attendance::where('user_id',Auth::user()->id)
                        // ->whereDate('date','=',date('Y-m-d'))
                        // ->first();
                        // if ($check_attendance) {
                        //     $check_attendance->logout_time = getAsiaTime24(date('y-m-d h:i:s'));
                        //     $check_attendance->save();
                        // }else{
                            $attendance = new Attendance();
                            $attendance->user_id = Auth::user()->id;
                            $attendance->date = date('Y-m-d');
                            $attendance->login_time = getAsiaTime24(date('Y-m-d H:i:s'));
                            $attendance->logout_time = null;
                            $attendance->save();
                        // }
                        
                        return redirect()->intended('/home');
                    } else {
                        $errors['password'] = 'You have entered wrong password';
                    }
                }else{
                    $errors['email'] = 'This email is not register with us';
                }
                
            } else {
                $errors['email'] = 'This email is not register with us';
            }
            return back()->withErrors($errors)->withInput($request->all());
        }
    }

    public function hr_login(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('auth.hr_login');
        } else if ($request->method() == 'POST') {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
            $user = User::where('email', $request->email)->first();
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if ($user->role_id == 2) {
                    if (Hash::check($request->password, $user->password)) {
                        Auth::login($user);
                        return redirect()->intended('/home');
                    } else {
                        $errors['password'] = 'You have entered wrong password';
                    }
                }else{
                    $errors['email'] = 'This email is not register with us';
                }
                
            } else {
                $errors['email'] = 'This email is not register with us';
            }
            return back()->withErrors($errors)->withInput($request->all());
        }
    }
    public function admin_login(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('admin.auth.login');
        } else if ($request->method() == 'POST') {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
            $user = User::where('email', $request->email)->first();
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if ($user->role_id == 1) {
                    if (Hash::check($request->password, $user->password)) {
                        Auth::login($user);
                        return redirect()->intended('/home');
                    } else {
                        $errors['password'] = 'You have entered wrong password';
                    }
                }else{
                    $errors['email'] = 'This email is not register with us';
                }
                
            } else {
                $errors['email'] = 'This email is not register with us';
            }
            return back()->withErrors($errors)->withInput($request->all());
        }
    }
    
}
