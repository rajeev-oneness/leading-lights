<?php

namespace App\Http\Controllers\Teacher;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\HomeTask;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function index(){
        $current_user_id = Auth::user()->id;
        $teacher = User::where('id',$current_user_id)->first();
        return view('teacher.profile',compact('teacher'));
    }

    public function updateProfile(Request $request){ 
        $teacher = User::find(Auth::id());
        if ($request->qualification) {
           $teacher->qualification = $request->qualification;
        }
        if ($request->address) {
           $teacher->address = $request->address;
        }
        $teacher->save();
        return response()->json('success');
    }

    public function changePassword()
    {
        $data = array();
        return view('teacher.change_password')->with($data);
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

    public function homeTask(){
        $classes = Classes::latest()->get();
        // return view('teacher.hometask',compact('classes'));
        return view('teacher.home_task');
    }

    public function uploadHomeTask(Request $request){
        $this->validate($request,[
            'class' => 'required',
            'subject' => 'required',
            'submission_date' => 'required|date',
            'submission_time' => 'required',
            'upload_file' => 'required|mimes:pdf'
        ]);

        if($request->hasFile('upload_file')){
            $file = $request->file('upload_file');
            $fileName = imageUpload($file,'course');
        }else{
            $fileName = null;
        }

        $homeTask = new HomeTask();
        $homeTask->user_id = Auth::user()->id;
        $homeTask->class = $request->class;
        $homeTask->subject = $request->subject;
        $homeTask->submission_date = $request->submission_date;
        $homeTask->submission_time = $request->submission_time;
        $homeTask->upload_file = $fileName;
        $homeTask->save();

        return redirect()->back()->with('success','Task update successfully');

    }

    public function attendance(){
        return view('teacher.attendance');
    }
    public function class(){
        return view('teacher.access_class');
    }
    public function studentSubmission(){
        return view('teacher.submission_task');
    }
    public function videoCall(){
        return view('teacher.video_call');
    }
    public function manageExam(){
        return view('teacher.exam');
    }
}
