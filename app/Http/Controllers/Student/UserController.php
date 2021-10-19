<?php

namespace App\Http\Controllers\Student;

use Carbon\Carbon;
use App\Models\User;
use App\Models\HomeTask;
use Barryvdh\DomPDF\Facade as PDF;

use App\Models\SubmitExam;
use App\Models\ArrangeExam;
use App\Models\ArrangeClass;
use Illuminate\Http\Request;
use App\Models\SubmitHomeTask;
use App\Models\ClassAttendance;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        $available_classes = ArrangeClass::where('class',Auth::user()->class)->latest()->get();
        return view('student.classes',compact('available_classes'));
    }

    public function dairy(Request $request){
        return view('student.dairy');
    }

    public function homework(Request $request){
        $class = Auth::user()->class;
        $data['home_works'] =  HomeTask::where('class',$class)->latest()->get();
        return view('student.home_work')->with($data);
    }

    public function exam(Request $request){
        $all_exams = ArrangeExam::latest()->get();
        return view('student.exam',compact('all_exams'));
    }

    public function payment(Request $request){
        return view('student.payments');
    }

    public function upload_homework(Request $request){
        $name = Auth::user()->first_name.' '.Auth::user()->last_name;
        $class = Auth::user()->class;
        $id_no = Auth::user()->id_no;
        $subject = $request->subject;

        $file = $request->file('file');
        $fileName = imageUpload($file,'student/home_task');

        $task = new  SubmitHomeTask;
        $task->name = $name;
        $task->class = $class;
        $task->subject = $subject;
        $task->roll_no = $id_no;
        $task->upload_doc = $fileName;
        $task->task_id = $request->task_id;
        $task->save();
        return response()->json('success');
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

    public function upload_exam(Request $request){
        $name = Auth::user()->first_name.' '.Auth::user()->last_name;
        $class = Auth::user()->class;
        $id_no = Auth::user()->id_no;
        $subject = $request->subject;

        $file = $request->file('file');
        $fileName = imageUpload($file,'student/exam');

        $exam = new  SubmitExam();
        $exam->name = $name;
        $exam->class = $class;
        $exam->subject = $subject;
        $exam->roll_no = $id_no;
        $exam->upload_doc = $fileName;
        $exam->exam_id = $request->exam_id;
        $exam->save();
        return response()->json('success');
    }

    public function report_generate(Request $request){
        $roll_no = Auth::user()->id_no;
        $data['user_details'] = User::where('id_no',$roll_no)->first();
        $data['all_result'] = SubmitExam::where('roll_no',$roll_no)
        ->where('marks','!=','')
        ->join('arrange_exams','arrange_exams.id','=','submit_exams.exam_id')
        ->get();
        $data['total_marks'] = SubmitExam::where('roll_no',$roll_no)
        ->where('marks','!=','')
        ->join('arrange_exams','arrange_exams.id','=','submit_exams.exam_id')
        ->sum('marks');
        $data['total_full_marks'] = SubmitExam::where('roll_no',$roll_no)
        ->where('marks','!=','')
        ->join('arrange_exams','arrange_exams.id','=','submit_exams.exam_id')
        ->sum('full_marks');
        $pdf = PDF::loadView('student.report',$data);
        return $pdf->download($roll_no.'.pdf');

    }
}
