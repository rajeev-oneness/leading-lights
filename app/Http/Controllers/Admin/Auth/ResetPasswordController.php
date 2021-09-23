<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\AdminPasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

class ResetPasswordController extends Controller
{
	
	function __construct(){

    }  


    public function resetPassword(Request $request, $token)
    {
    	if ($request->method() === 'GET') {
    		//Check Rand Key Is Exists------------------->
    		$email = Admin::where('rand_key', $token)->first();

            if ($email) {
                $email = $email->email;
            }

    		if(Admin::where('rand_key', $token)->count() > 0){
                //Check if Rand Key Expired or Not----------->
                $timestamp = explode('-', $token)[1];
                if(time() - $timestamp <= 60*60){ // <--- If Key not expired (1hr For testing)
                    
                    return view('admin.auth.passwords.reset')->with(['email' => $email, 'token' => $token]);
                }
                else{
                    Session::flash('error', "Your password reset link was expired!");
                    return redirect()->route('admin.forgotPassword');
                }

    		}
    		else{
                Session::flash('error', "Your password reset link was expired!");
                return redirect()->route('admin.forgotPassword');
    		}
    	}
    	else if($request->method() === 'POST'){
    		$user = Admin::where(['rand_key' => $request->token])->first();

    		if (Hash::check($request->password, $user->password)) {
    			Session::flash('error', "Old Password Cannot be same as new password");
    			return redirect()->back();
    		}
    		else{
    // 			if ($request->password !== $request->password_confirmation) {
    // 				Session::flash('warning', "Passwords Mismatched");
    // 				return redirect()->back();
    // 			}
    			
    			$validator = Validator::make($request->all(), [
                     'password' => 'required|min:6', 
                     'password_confirmation' => 'required|same:password|min:6|',                   
                    ]
                );
                $validationError = $validator->errors();
                if($validator->fails()){
                    return redirect()->back()
                        ->withErrors($validationError,'reset_password_warning')
                        ->withInput($request->all());
                }
    			$user->rand_key = md5(substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5))."-".time(); //<-- Create a random key with current timestamp

    			$user->password = Hash::make($request->password);
    			$user->save();

    			Session::flash('success', "Password Changed Successfully");
    			return redirect()->route('admin.login');
    		}
    	}
    }


    public function forgotPassword(Request $request)
    {
    	if ($request->method() === 'GET') {
    		return view('admin.auth.passwords.email');
    	}
    	else if($request->method() === 'POST'){
    		return abort(404);
    	}
    }


    public function sendResetLink(Request $request)
    {
    	$user_data = Admin::where('email', $request->email)->first();
    	
    	// $not_active_user_data = Admin::where('status',1)->where('email', $request->email)->first();

    	if (is_null($user_data)) {
    		Session::flash('error', "Invalid Email ID !!");
        	return redirect()->back();
    	}
    	
    	// if (is_null($not_active_user_data)) {
    	// 	Session::flash('forget_password_warning', "This account is not active!!");
        // 	return redirect()->back();
    	// }
    	
    	
    	/////
    	
    	$user_data->rand_key = md5(substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5))."-".time(); //<-- Create a random key with current timestamp

    	$user_data->save();
        $user_data->refresh();       
        $email_data = array(
            'name'       => $user_data->name,
            'link' => route('admin.resetPassword',$user_data->rand_key)
        );

        Notification::route('mail', $request->email)->notify(new AdminPasswordReset($email_data));
        // CRUDBooster::sendEmail(['to'=>$request->email,'data'=>$email_data,'template'=>'send_password_reset_link']);
                // $this->sendVerificationMail($user);
                
                // Session::flash('type', 'success'); 
                // Session::flash('message', 'Please wait for admin confirmation!'); 
    	/////

    // 	$user_data->rand_key = md5(substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5))."-".time(); //<-- Create a random key with current timestamp

    // 	$user_data->save();

    // 	$user_data->refresh();

    // 	$email_data = array(
    //         'name'       => $user_data->first_name.' '.$user_data->last_name,
    //         'email'      => $user_data->email,
    //         'token'      => $user_data->rand_key,
    //         'site_email' => $this->site_email,
    //         'base_url'   => url('/')
    //     );

    //     Mail::send('emails.reset_password', $email_data,  function ($message) use ($email_data) {
    //         $message->from($email_data['site_email'], 'Idanyone');
    //         $message->to( $email_data['email'] )->subject('Reset your password in Idanyone');
    //     });

        Session::flash('success', "Reset password link has been sent on your email id");
        return redirect()->back();
    }
}
