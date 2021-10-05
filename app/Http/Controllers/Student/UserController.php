<?php

namespace App\Http\Controllers\Student;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HomeTask;
use App\Models\SubmitHomeTask;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $current_user_id = Auth::user()->id;
        $data['student'] = User::where('id',$current_user_id)->first();
        $data['student_age'] = Carbon::parse($data['student']->dob)->diff(Carbon::now())->format('%y years');
        return view('student.profile')->with($data);
    }
    
    public function updateProfile(Request $request){
        $student = User::find(Auth::id());
        if ($request->dob) {
            $this->validate($request,[
                'dob' => 'date|nullable',
            ]);
            $student->dob = $request->dob;
        }
        if ($request->gender) {
            $student->gender = $request->gender;
        }
        if ($request->bio) {
            $this->validate($request,[
                'bio' => 'max:255'
            ]);
            $student->about_us = $request->bio;
        }

        $student->save();
        return response()->json('success');
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


    public function classes(Request $request){
        return view('student.classes');
    }

    public function dairy(Request $request){
        return view('student.dairy');
    }

    public function homework(Request $request){
        $class = Auth::user()->class;
        $home_works =  HomeTask::where('class',$class)->latest()->get();
        return view('student.home_work',compact('home_works'));
    }

    public function exam(Request $request){
        return view('student.exam');
    }

    public function payment(Request $request){
        return view('student.payments');
    }

    public function upload_homework(Request $request){
        $name = Auth::user()->first_name.' '.Auth::user()->last_name;
        $class = Auth::user()->class;
        $id_no = Auth::user()->id_no;
        $subject = $request->subject;
        $submission_date = $request->submission_date;
        $submission_time = $request->submission_time;

        //Check already uploaded or not
        $already_uploaded = SubmitHomeTask::where('roll_no',$id_no)->where('class',$class)->where('subject',$subject)->where('submission_date',$submission_date)->where('submission_time',$submission_time)->count();
        // if ($already_uploaded > 0) {
        //     return redirect()->back()->with('error','Already uploaded home task');
        // }

        $date = date('m/d/Y');
        $date1 = date('m/d/Y', strtotime($submission_date));
        $date2 = date('m/d/Y', strtotime($date));

        $time = getAsiaTime(date('h:m:s'));
        $time1 = date('h:m:s', strtotime($submission_time));
        $time2 = date('h:m:s', strtotime($time));

        if ($date1 < $date2) {
            return redirect()->back()->with('error','This task last submission date has expired');
        }
        if ($time1 < $time2) {
            return redirect()->back()->with('error','This task last submission date and time has expired');
        }
        $this->validate($request,[
            'upload_doc' => 'required|mimes:pdf'
        ]);

        if($request->hasFile('upload_doc')){
            $image = $request->file('upload_doc');
            $fileName = imageUpload($image,'student/home_task');
        }else{
            $fileName = null;
        }
        $task = new  SubmitHomeTask;
        $task->name = $name;
        $task->class = $class;
        $task->subject = $subject;
        $task->roll_no = $id_no;
        $task->upload_doc = $fileName;
        $task->submission_date = $submission_date;
        $task->submission_time = $submission_time;
        $task->save();
        return redirect()->back()->with('success','Home task uploaded successful');
    }
}
