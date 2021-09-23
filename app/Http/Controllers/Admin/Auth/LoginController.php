<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
    protected $redirectTo = '/admin/dashboard';
 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
 
    public function showLoginForm(){
        return view('admin.auth.login');
    }
 
    // 
    private function validator(Request $request)
    {
        //validation rules.
        $rules = [
            'email'    => 'required|email|exists:admins|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];

        //custom validation error messages.
        $messages = [
            'email.exists' => 'These credentials do not match our records.',
        ];

        //validate the request.
        $request->validate($rules,$messages);
    }
    private function loginFailed(){
        return redirect()
            ->back()
            ->withInput()
            ->with('error','Login failed, please try again!');
    }
    // public function login(Request $request)
    // {
    //     $this->validator($request);
        
    //     if(Auth::guard('admin')->attempt($request->only('email','password'),$request->filled('remember'))){
    //         //Authentication passed...
    //         return redirect()
    //             ->intended(route('admin.dashboard'))
    //             ->with('status','You are Logged in as Admin!');
    //     }

    //     //Authentication failed...
    //     return $this->loginFailed();
    // }
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
        $user = Admin::where('email',$req->email)->first();
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
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
 
        $request->session()->invalidate();
 
        return redirect()->route('admin.login');
    }
    
     /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
 
}
