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
use App\Models\ArrangeExam;
use App\Models\ClassAttendance;
use App\Models\SubmitExam;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade as PDF;

use function GuzzleHttp\Promise\task;

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
        $data['tasks'] = HomeTask::where('user_id',Auth::user()->id)->latest()->get();
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
        // $tasks = SubmitHomeTask::latest()->get();
        $tasks = DB::table('submit_home_task')
                    ->where('user_id',Auth::user()->id)
                    ->join('home_task','submit_home_task.task_id','=','home_task.id')
                    ->get();
        return view('teacher.submission_task',compact('tasks'));
    }
    public function videoCall(){
        return view('teacher.video_call');
    }
    public function manageExam(){
        $data['classes'] = Classes::get();
        $data['assign_exam'] = ArrangeExam::where('user_id',Auth::user()->id)->latest()->get();
        return view('teacher.exam')->with($data);;
    }

    public function taskReview(Request $request){
        $task = SubmitHomeTask::where('task_id',$request->data['task_id'])->first();
        $task->review = $request->data['review'];
        $task->save();
        return response()->json('success');
    }
    public function taskComment(Request $request,$id){
        $this->validate($request,[
            'comment' => 'required|max:255'
        ]);
        $task = SubmitHomeTask::where('task_id',$id)->first();
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

    public function assignExam(Request $request){
        $this->validate($request,[
            'class' => 'required',
            'subject' => 'required',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'full_marks' => 'required',
            'result_date' => 'required',
            'upload_file' => 'required|mimes:pdf'
        ]);

        if($request->hasFile('upload_file')){
            $file = $request->file('upload_file');
            $fileName = imageUpload($file,'teacher/exam');
        }else{
            $fileName = null;
        }

        $exam = new ArrangeExam();
        $exam->user_id = Auth::user()->id;
        $exam->class = $request->class;
        $exam->subject = $request->subject;
        $exam->date = $request->date;
        $exam->start_time = $request->start_time;
        $exam->end_time = $request->end_time;
        $exam->full_marks = $request->full_marks;
        $exam->result_date = $request->result_date;
        $exam->upload_file = $fileName;
        $exam->save();

        return redirect()->back()->with('success','Exam upload successfully');

    }

    public function examSubmission(){
        $data['classes'] = Classes::latest()->get();
        $data['users'] = User::where('role_id',4)->latest()->get();
        return view('teacher.submission_exam_filter')->with($data);
    }
    public function studentExamSubmission(Request $request ){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $submitted_exams_detail = SubmitExam::
                    where('user_id',Auth::user()->id)
                    ->join('arrange_exams','submit_exams.exam_id','=','arrange_exams.id')
                    ->orderBy('submit_exams.created_at','DESC')
                    ->get();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['student_wise_result'])) {
                $this->validate($request,[
                    'student_id' => 'required',
                    'class_name' => 'required'
                ]);

                Validator::make($request->all(), [
                    'student_id' => 'required',
                    'class_name' => 'required'
                ],$messages = [
                    'class_name.required' => 'The class field is required.',
                ])->validate();

                $student_id = $request->student_id;
                $data['user_details'] = User::where('id_no',$student_id)->first();
                $data['all_result'] = SubmitExam::where('roll_no',$student_id)
                ->where('marks','!=','')
                ->join('arrange_exams','arrange_exams.id','=','submit_exams.exam_id')
                ->get();
                $data['total_marks'] = SubmitExam::where('roll_no',$student_id)
                ->where('marks','!=','')
                ->join('arrange_exams','arrange_exams.id','=','submit_exams.exam_id')
                ->sum('marks');
                $data['total_full_marks'] = SubmitExam::where('roll_no',$student_id)
                ->where('marks','!=','')
                ->join('arrange_exams','arrange_exams.id','=','submit_exams.exam_id')
                ->sum('full_marks');
                $pdf = PDF::loadView('student.report',$data);
                return $pdf->download($student_id.'.pdf');
            }
            if (isset($_POST['class_wise_result'])) {
                Validator::make($request->all(), [
                    'class_name1' => 'required'
                ],$messages = [
                    'required' => 'The class field is required.',
                ])->validate();


                $data['class'] = $request->class_name1;
                $data['all_result'] = SubmitExam::
                where('arrange_exams.user_id',Auth::user()->id)
                ->where('arrange_exams.class',$request->class_name1)
                ->where('marks','!=','')
                ->join('arrange_exams','arrange_exams.id','=','submit_exams.exam_id')
                // ->join('users','users.id_no','=','submit_exams.roll_no')
                ->get();
                $pdf = PDF::loadView('teacher.report',$data);
                return $pdf->download($request->class_name1.'-results'.'.pdf');

            }
            if (isset($_POST['view_submission'])) {
                $this->validate($request,[
                    'subject' => 'required',
                    'class' => 'required'
                ]);
                $submitted_exams_detail = SubmitExam::
                        where('user_id',Auth::user()->id)
                        ->where('submit_exams.class',$request->class)
                        ->where('arrange_exams.subject',$request->subject)
                        ->join('arrange_exams','submit_exams.exam_id','=','arrange_exams.id')
                        ->orderBy('submit_exams.created_at','DESC')
                        ->get();
            }
        }
        return view('teacher.submission_exam',compact('submitted_exams_detail'));
    }

    public function examMarks(Request $request,$id)
    {
        $exam_detail = SubmitExam::where('exam_id',$id)->first();
        $exam_detail->marks = $request->marks;
        $exam_detail->save();
        return redirect()->back();
    }

    public function examComment(Request $request,$id){
        $this->validate($request,[
            'comment' => 'required|max:255'
        ]);
        $exam = SubmitExam::where('exam_id',$id)->first();
        $exam->comment = $request->comment;
        $exam->save();
        return response()->json('success');
    }

    public function view_participation(Request $request){
        $participation = ClassAttendance::where('class_id',$request->prop_id)
                        ->where('role_id',4)
                        ->join('users','users.id','=','class_users.user_id')
                        ->get();
                        // dd($participation);
        return response()->json($participation);
    }
}
