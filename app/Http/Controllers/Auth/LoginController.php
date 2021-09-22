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
        // $inactive_user = User::where('email',$req->email)->where('status',0)->first();
        // if ($inactive_user) {
        //     auth()->logout();
        //     return back()->with('error', 'Your account is not active.');
        // }
        $user = User::where('email',$req->email)->first();
        if($user){
            if(Hash::check($req->password,$user->password)){
                Auth::login($user);
                return redirect()->intended('/home');
            }else{
                $errors['password'] = 'You have entered wrong password';
            }
        }else{
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
}
