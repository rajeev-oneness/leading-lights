<?php

namespace App\Http\Controllers\Student;

use Carbon\Carbon;
use App\Models\User;
use App\Models\HomeTask;
use App\Models\Attendance;

use App\Models\SubmitExam;
use App\Models\ArrangeExam;
use App\Models\ArrangeClass;
use Illuminate\Http\Request;
use App\Models\SubmitHomeTask;
use App\Models\ClassAttendance;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Certificate;
use App\Models\Classes;
use App\Models\Event;
use App\Models\Payment;
use App\Models\SpecialCourse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $current_user_id = Auth::user()->id;
        $data['classes'] = ArrangeClass::where('class', Auth::user()->class)
            ->join('subjects','subjects.id','=','arrange_classes.subject')
            ->whereDate('date', '=', date('Y-m-d'))->orderBy('arrange_classes.created_at','desc')->get();
        // dd( $data['classes']);
            $data['special_classes'] = ArrangeClass::where('group_id', Auth::user()->group_ids)
            ->join('subjects','subjects.id','=','arrange_classes.subject')
            ->whereDate('date', '=', date('Y-m-d'))->orderBy('arrange_classes.created_at','desc')->get();
        // dd($data['special_classes']);
        $data['student'] = User::where('id', $current_user_id)->first();
        $data['student_age'] = Carbon::parse($data['student']->dob)->diff(Carbon::now())->format('%y years');
        $data['certificates'] = DB::table('certificate')->where('user_id', $current_user_id)->first();
        $data['announcements'] = Announcement::where('class_id',Auth::user()->class)->get();
        return view('student.profile')->with($data);
    }

    public function updateProfile(Request $request)
    {
        $student = User::find(Auth::id());
        if ($request->dob) {
            $this->validate($request, [
                'dob' => 'date|nullable',
            ]);
            $student->dob = $request->dob;
        }
        if ($request->gender) {
            $student->gender = $request->gender;
        }
        if ($request->bio) {
            $this->validate($request, [
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

    function updatePassword(Request $request)
    {
        $data = array();
        $user_id = Auth::user()->id;
        $validation = $this->validate_change_password($request->all());
        $validationError = $validation->errors();

        if ($validation->fails()) {

            return redirect()->back()
                ->withErrors($validationError, 'change_password_warning')
                ->withInput($request->all());
        }
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password, $hashedPassword)) { //To check db stored pass & provided pass
            if (!Hash::check($request->password, $hashedPassword)) {
                $user = User::findOrFail(Auth::id());
                $user->password = Hash::make($request->password); //hash a password  

                $postdata = array(
                    'password'   => bcrypt($request->input('password')),
                    'updated_at' => date('Y-m-d H:i:s'),
                );

                //$update_user = DB::table('users')->where('id', '=', $user_id)->update($postdata);
                $update_user =   User::where('id', $user_id)->update($postdata);
                if ($update_user) {

                    return redirect()->back()->with('change_password_success_message', "Password has been changed successfully.");
                }
            } else {
                return redirect()->back()->with('change_password_warning', "New password can not be same as old password")->withInput($request->all());;
            }
        } else {
            return redirect()->back()->with('change_password_warning', "Current password does not match.")->withInput($request->all());
        }
    }
    protected function validate_change_password(array $data)
    {
        $user_id = Auth::user()->id;
        $hashedPassword = Auth::user()->password;
        $validator = Validator::make(
            $data,
            [
                'old_password' => ['required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('Old Password doesdn\'t match');
                    }
                }],
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password|min:6|',

            ],
            [
                'password_confirmation.same' => 'New password and confirm password must match'
            ]
        );

        return $validator;
    }


    public function classes(Request $request)
    {
        $available_classes = ArrangeClass::where('class', Auth::user()->class)->latest()->get();
        $group_wise_classes = ArrangeClass::
        where('group_id', Auth::user()->group_ids)->where('group_id','!=',null)->latest()->get();
        return view('student.classes', compact('available_classes','group_wise_classes'));
    }

    public function dairy(Request $request)
    {
        if ($request->ajax()) {  
            $classes = ArrangeClass::where('class', Auth::user()->class)->
            join('subjects','subjects.id','=','arrange_classes.class')
            ->get(['arrange_classes.id', 'name as title', 'date', 'start_time as description'])->toArray();
            // dd($classes);
            $special_classes = ArrangeClass::
            where('group_id', Auth::user()->group_ids)->where('group_id','!=',null)->
            join('subjects','subjects.id','=','arrange_classes.group_id')
            ->get(['arrange_classes.id', 'name as title', 'date', 'start_time as description'])->toArray();
            return response()->json(array_merge($classes,$special_classes));
        }
        $events = Event::where('class_id',Auth::user()->class)->get();
        $announcements = Announcement::where('class_id',Auth::user()->class)->get();
        return view('student.dairy',compact('events','announcements'));
    }

    public function homework(Request $request)
    {
        $data['class_wise_home_works'] =  HomeTask::where('class',  Auth::user()->class)->latest()->get();
        $data['group_wise_home_works'] =  HomeTask::where('group_id', Auth::user()->group_ids)->where('group_id','!=',null)->latest()->get();
        return view('student.home_work')->with($data);
    }

    public function exam(Request $request)
    {
        $data['class_wise_exam'] = ArrangeExam::where('class',  Auth::user()->class)->latest()->get();
        $data['group_wise_exam'] = ArrangeExam::where('group_id', Auth::user()->group_ids)->where('group_id','!=',null)->latest()->get();
        return view('student.exam')->with($data);
    }

    public function payment(Request $request)
    {
        $current_user_id = Auth::user()->id;
        $previous_payment = Payment::where('user_id',$current_user_id)->orderBy('id', 'desc')->first();
        
        if (!empty($previous_payment)) {
            //Next date for payment 
            $next_due_date = $previous_payment->next_due_date;
            $today_date = date('Y-m-d');

            if ($today_date > $next_due_date) {
                $date1=date_create($next_due_date);
                $date2=date_create($today_date);
                $diff=date_diff($date1,$date2);
                $extra_date = $diff->format("%a");
                $data['extra_date'] = $extra_date;
            }
        }
        $data['class_details'] = Classes::where('id',Auth::user()->class)->first();
        $data['admission_payment_details'] = Payment::where('user_id',$current_user_id)->where('fees_type','admission_fee')->first();
        $data['monthly_payment_details'] = Payment::where('user_id',$current_user_id)->where('fees_type','monthly_fees')->latest()->get();
        $data['previous_payment'] = Payment::where('user_id',$current_user_id)->orderBy('id', 'desc')->first();
        //Check students belong to special class
        $data['special_course_details'] = SpecialCourse::where('id',Auth::user()->special_course_id)->first();
        return view('student.payments')->with($data);
    }

    public function upload_homework(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'upload_doc' => 'required|mimes:pdf'
        ],$messages = [
            'required' => 'Please upload a document!',
            'mimes' => 'The document must be pdf format' 
        ]);
        $validationError = $validation->errors();
        

        if ($validation->fails()) {
            if ($_POST['submit_btn'] === 'special_task') {
                return redirect()->back()
                ->withErrors($validationError, 'special_task_upload_error');
            } else {
                return redirect()->back()
                ->withErrors($validationError, 'regular_task_upload_error');
            }
        }

        $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $class = Auth::user()->class;
        $id_no = Auth::user()->id_no;
        $subject = $request->subject;

        $file = $request->file('upload_doc');
        $fileName = imageUpload($file, 'student/home_task');

        $task = new  SubmitHomeTask;
        $task->name = $name;
        $task->class = $class;
        $task->subject = $subject;
        $task->id_no = $id_no;
        $task->upload_doc = $fileName;
        $task->task_id = $request->task_id;
        $task->save();
        if ($_POST['submit_btn'] === 'special_task'){
            return redirect()->back()->with('special_task_upload_success','Home task uploaded successfully');
        }else{
            return redirect()->back()->with('regular_task_upload_success','Home task uploaded successfully');
        }
    }

    public function class_attendance(Request $request)
    {
        $class_id = $request->class_id;
        $user_id = Auth::user()->id;
        $already_joined = ClassAttendance::where('class_id', $class_id)->where('user_id', $user_id)->first();

        //Attendance
        $check_attendance = Attendance::where('user_id', Auth::user()->id)
            ->whereDate('date', '=', date('Y-m-d'))
            ->first();
        if (!$check_attendance) {
            $attendance = new Attendance();
            $attendance->user_id = Auth::user()->id;
            $attendance->date = date('Y-m-d');
            $attendance->login_time = getAsiaTime24(date('y-m-d h:i:s'));
            $attendance->save();
        }

        $class = new ClassAttendance();
        if (!$already_joined) {
            if ($request->comment) {
                $class->class_id = $class_id;
                $class->user_id = $user_id;
                $class->is_attended = 0;
                $class->comment = $request->comment;
                $class->save();
            } else {
                $class->class_id = $class_id;
                $class->user_id = $user_id;
                $class->is_attended = 1;
                $class->save();
            }
        }
        return response()->json('success');
    }

    public function upload_exam(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'upload_doc' => 'required|mimes:pdf'
        ],$messages = [
            'required' => 'Please upload a document!',
            'mimes' => 'The document must be pdf format' 
        ]);
        $validationError = $validation->errors();

        if ($validation->fails()) {
            if ($_POST['submit_btn'] === 'special_exam') {
                return redirect()->back()
                ->withErrors($validationError, 'special_exam_upload_error');
            } else {
                return redirect()->back()
                ->withErrors($validationError, 'regular_exam_upload_error');
            }
        }
        $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $class = Auth::user()->class;
        $id_no = Auth::user()->id_no;
        $subject = $request->subject;

        $file = $request->file('upload_doc');
        $fileName = imageUpload($file, 'student/exam');

        $exam = new  SubmitExam();
        $exam->name = $name;
        $exam->class = $class;
        $exam->subject = $subject;
        $exam->id_no = $id_no;
        $exam->upload_doc = $fileName;
        $exam->exam_id = $request->exam_id;
        $exam->save();
        if ($_POST['submit_btn'] === 'special_exam'){
            return redirect()->back()->with('special_exam_upload_success','Exam uploaded successfully');
        }else{
            return redirect()->back()->with('regular_exam_upload_success','Exam uploaded successfully');
        }
    }

    public function report_generate(Request $request)
    {
        $id_no = Auth::user()->id_no;
        $data['user_details'] = User::where('id_no', $id_no)->first();
        $data['all_result'] = SubmitExam::where('id_no', $id_no)
            ->where('marks', '!=', '')
            ->join('arrange_exams', 'arrange_exams.id', '=', 'submit_exams.exam_id')
            ->get();
        $data['total_marks'] = SubmitExam::where('id_no', $id_no)
            ->where('marks', '!=', '')
            ->join('arrange_exams', 'arrange_exams.id', '=', 'submit_exams.exam_id')
            ->sum('marks');
        $data['total_full_marks'] = SubmitExam::where('id_no', $id_no)
            ->where('marks', '!=', '')
            ->join('arrange_exams', 'arrange_exams.id', '=', 'submit_exams.exam_id')
            ->sum('full_marks');
        $pdf = PDF::loadView('student.report', $data);
        return $pdf->download($id_no . '.pdf');
    }

    public function attendance(Request $request)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $checked_attendance = Attendance::where('user_id', Auth::user()->id)->latest()->get();
            return view('student.attendance', compact('checked_attendance'));
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['attendance'])) {
                $this->validate($request, [
                    'date' => 'required',
                    // 'end_date' => 'required'
                ]);

                $date = $request->date;
                // $end_date = $request->end_date;
                $checked_attendance = Attendance::where('user_id', Auth::user()->id)
                    ->whereDate('date', '=', $date)->get();
                // dd($checked_attendance);
                if ($checked_attendance->count() > 0) {
                    return view('student.attendance', compact('checked_attendance'));
                } else {
                    $attendance = [];
                    $attendance['date'] = $date;
                    $attendance['first_login_time'] = 'N/A';
                    $attendance['last_login_time'] = 'N/A';
                    return view('student.attendance')->with($attendance);
                }
            } else {
                $attendance = Attendance::find($request->attendance_id);
                $attendance->comment = $request->comment;
                $attendance->save();
                return response()->json('success');
            }
        }
    }

    public function certificate_upload(Request $request)
    {
        Validator::make($request->all(), [
            'upload_file' => 'required|mimes:pdf',
        ], $messages = [
            'upload_file.required' => 'This field is required.',
            'upload_file.mimes' => 'Please upload pdf file',
        ])->validate();

        $image = $request->file('upload_file');
        $fileName = imageUpload($image, 'student_certificate');

        $data['user_id'] = Auth::user()->id;
        $data['updated_at'] = date('Y-m-d H:i:s');

        $certificate = new Certificate();
        $certificate->user_id = Auth::user()->id;
        $certificate->image = $fileName;
        $certificate->save();

        $user = User::find(Auth::user()->id);
        $user->is_rejected_document_uploaded = 1;
        $user->save();

        return redirect()->back();
    }

    public function payment_receipt(Request $request,$payment_id){
        $current_user_id = Auth::user()->id;
        $data['payment_details'] = Payment::find($payment_id);
        $data['user_details'] = User::find($current_user_id);
        $pdf = PDF::loadView('student.payment_receipt', $data);
        return $pdf->download(Auth::user()->id_no . '.pdf');
    }
}
