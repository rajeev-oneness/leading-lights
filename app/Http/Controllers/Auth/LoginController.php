<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $inactive_user = User::where('email',$req->email)->where('status',0)->first();
        $user = User::where('email', $req->email)->first();
        if ($user) {
            if ($user->role_id == 4) {
                if ($inactive_user) {
                    auth()->logout();
                    return back()->with('error', 'Your account is not active.');
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
        auth()->guard()->logout();
        $request->session()->invalidate();
        return redirect('/');
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
