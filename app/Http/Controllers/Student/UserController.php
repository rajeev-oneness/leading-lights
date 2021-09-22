<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $current_user_id = Auth::user()->id;
        $student = User::where('id',$current_user_id)->first();
        return view('student.profile',compact('student'));
    }
    
    public function updateProfile(Request $request){
        $this->validate($request,[
            'first_name' => 'required |string| max:255',
            'last_name' => 'required |string| max:255',
            // 'email' => 'email',
            'mobile' => 'nullable|min:10|max:10',
            'fathers_name' => 'string | max:255|nullable',
            'dob' => 'date|nullable',
            'address' => 'string|max:255|nullable',
            'image' => 'image |mimes:png,jpg'
        ]);
        $student = User::find(Auth::id());

        if($request->hasFile('image')){
            $image = $request->file('image');
            if ($student->image !== 'default.png') {
                $image_name = explode('/', $student->image)[2];
                if(File::exists('upload/profile_image/'.$image_name)) {
                    File::delete('upload/profile_image/'.$image_name);
                }
            }
            $imageName = imageUpload($image,'profile_image');
        }else{
            $imageName = $student->image;
        }
        // $student->email = $request->email;
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->mobile = $request->mobile;
        $student->dob = $request->dob;
        $student->address = $request->address;
        $student->fathers_name = $request->fathers_name;
        $student->image = $imageName;
        $student->save();
        return redirect()->route('user.profile')->with('success','Profile updated');
    }

    public function changePassword()
    {
        $data = array();
        return view('student.change_password')->with($data);
    }

    function updatePassword(Request $request){
	    $data = array();
		$user_id = Auth::user()->id;	
        $validation = $this->validate_change_password($request->all());
        $validationError = $validation->errors();
        
        if($validation->fails()){
                        
            return redirect()->back()
                ->withErrors($validationError,'change_password_warning')
                ->withInput($request->all());
        }
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password, $hashedPassword)) {//To check db stored pass & provided pass
            if (!Hash::check($request->password, $hashedPassword)) {
                $user = User::findOrFail(Auth::id());
                $user->password = Hash::make($request->password);//hash a password  
                
                $postdata = array(
                    'password'   => bcrypt($request->input('password')),       
                    'updated_at' => date('Y-m-d H:i:s'),
                );

                //$update_user = DB::table('users')->where('id', '=', $user_id)->update($postdata);
                    $update_user =   User::where('id',$user_id)->update( $postdata);
                if($update_user){
    
                        return redirect()->back()->with('change_password_success_message', "Password has been changed successfully.");
                }
            }else {
                return redirect()->back()->with('change_password_warning', "New password can not be same as old password")->withInput($request->all());;
            }
        }else{
            return redirect()->back()->with('change_password_warning', "Current password does not match.")->withInput($request->all());
        }
	}
    protected function validate_change_password(array $data)
    {
    	$user_id = Auth::user()->id;
    	$hashedPassword = Auth::user()->password;
        $validator = Validator::make($data, [
        	 'old_password' => ['required',function($attribute,$value,$fail){
        	     if (!Hash::check($value, Auth::user()->password)) {
                    $fail('Old Password doesdn\'t match');
                }
        	 }],  
             'password' => 'required|min:6', 
             'password_confirmation' => 'required|same:password|min:6|',                   
           
            ],[
                'password_confirmation.same' => 'New password and confirm password must match'
            ]
        );

		return $validator;        
    } 
}
