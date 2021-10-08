<?php

namespace App\Http\Controllers\Teacher;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Classes;
use App\Models\HomeTask;
use Illuminate\Http\Request;
use App\Models\SubmitHomeTask;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ArrangeClass;
use App\Models\ClassAttendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function index(){
        $current_user_id = Auth::user()->id;
        $data['teacher'] = User::where('id',$current_user_id)->first();
        $data['certificates'] = DB::table('teacher_certificate')->where('user_id',$current_user_id)->get();
        return view('teacher.profile')->with($data);
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
        $data['classes'] = Classes::latest()->get();
        $data['tasks'] = HomeTask::latest()->get();
        // return view('teacher.hometask',compact('classes'));
        return view('teacher.home_task')->with($data);
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
            $fileName = imageUpload($file,'teacher/home_task');
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

        return redirect()->back()->with('success','Task upload successfully');

    }

    public function attendance(){
        return view('teacher.attendance');
    }
    public function class(){
        $data['classes'] = Classes::get();
        $data['arrange_classes'] = ArrangeClass::where('user_id',Auth::user()->id)->latest()->get();
        return view('teacher.access_class')->with($data);
    }
    public function studentSubmission(){
        $tasks = SubmitHomeTask::latest()->get();
        return view('teacher.submission_task',compact('tasks'));
    }
    public function videoCall(){
        return view('teacher.video_call');
    }
    public function manageExam(){
        return view('teacher.exam');
    }

    public function taskReview(Request $request){
        $task = SubmitHomeTask::where('id',$request->data['task_id'])->first();
        $task->review = $request->data['review'];
        $task->save();
        return response()->json('success');
    }
    public function taskComment(Request $request,$id){
        $this->validate($request,[
            'comment' => 'required|max:255'
        ]);
        $task = SubmitHomeTask::where('id',$id)->first();
        $task->comment = $request->comment;
        $task->save();
        return response()->json('success');
    }

    public function certificate_upload(Request $request){
        if ($request->ajax()) {
            $image = $request->file('file');
            $data['image'] = imageUpload($image,'teacher_certificate');

            $data['user_id'] = Auth::user()->id;
            
            DB::table('teacher_certificate')->insert($data);

        }
    }

    public function arrange_class(Request $request)
    {
        $arrange_class = new ArrangeClass();
        $arrange_class->user_id = Auth::user()->id;
        $arrange_class->subject = $request->subject;
        $arrange_class->class = $request->class;
        $arrange_class->date = $request->date;
        $arrange_class->start_time = $request->start_time;
        $arrange_class->end_time = $request->end_time;
        $arrange_class->meeting_url = $request->meeting_url;
        $arrange_class->save();
        return response()->json(array(
            'success' => 'Data save successfully',
        ));
    }

    public function class_attendance(Request $request){
        $class_id = $request->class_id;
        $user_id = Auth::user()->id;
        $already_joined = ClassAttendance::where('class_id',$class_id)->where('user_id',$user_id)->first();

        $class = new ClassAttendance();
        if (!$already_joined) {
            if ($request->comment) {
                $class->class_id = $class_id;
                $class->user_id = $user_id;
                $class->is_attended = 0;
                $class->comment = $request->comment;
                $class->save();
            }else{
                $class->class_id = $class_id;
                $class->user_id = $user_id;
                $class->is_attended = 1;
                $class->save();
            }       
        }
        return response()->json('success');
    }
}
