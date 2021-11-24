<?php

namespace App\Http\Controllers\Teacher;

use DateTime;
use DatePeriod;
use DateInterval;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Group;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\HomeTask;
use App\Models\Attendance;
use App\Models\SubmitExam;
use App\Models\ArrangeExam;
use App\Models\Certificate;
use App\Models\ArrangeClass;
use Illuminate\Http\Request;
use App\Models\SpecialCourse;
use App\Models\SubmitHomeTask;
use App\Models\ClassAttendance;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use function GuzzleHttp\Promise\task;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function index()
    {
        $current_user_id = Auth::user()->id;
        $data['classes'] = ArrangeClass::where('user_id', Auth::user()->id)
            ->join('subjects', 'subjects.id', '=', 'arrange_classes.class')
            ->whereDate('date', '=', date('Y-m-d'))->orderBy('arrange_classes.created_at', 'desc')->get();

        $data['teacher'] = User::where('id', $current_user_id)->first();
        $data['certificates'] = DB::table('certificate')->where('user_id', $current_user_id)->get();
        return view('teacher.profile')->with($data);
    }

    public function updateProfile(Request $request)
    {
        $teacher = User::find(Auth::id());
        if ($request->qualification) {
            $teacher->qualification = $request->qualification;
        }
        if ($request->address) {
            $teacher->address = $request->address;
        }
        if ($request->bio) {
            $this->validate($request, [
                'bio' => 'max:255'
            ]);
            $teacher->about_us = $request->bio;
        }
        $teacher->save();
        return response()->json('success');
    }

    public function changePassword()
    {
        $data = array();
        return view('teacher.change_password')->with($data);
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

    public function homeTask()
    {
        $data['groups'] = Group::latest()->where('teacher_id', Auth::user()->id)->get();
        $data['subjects'] = Subject::latest()->get();
        $data['classes'] = Classes::orderBy('name')->get();
        $data['tasks'] = HomeTask::where('user_id', Auth::user()->id)->latest()->get();
        // return view('teacher.hometask',compact('classes'));
        return view('teacher.home_task')->with($data);
    }

    public function uploadHomeTask(Request $request)
    {
        $this->validate($request, [
            'class' => 'required',
            'subject' => 'required',
            'submission_date' => 'required|date',
            'submission_time' => 'required|date_format:H:i',
            'upload_file' => 'required|mimes:pdf'
        ]);

        if ($request->hasFile('upload_file')) {
            $file = $request->file('upload_file');
            $fileName = imageUpload($file, 'teacher/home_task');
        } else {
            $fileName = null;
        }

        $class = $request->class;
        $after_explode_class = explode('-', $class);

        $homeTask = new HomeTask();
        $homeTask->user_id = Auth::user()->id;
        if ($after_explode_class[1] === 'class') {
            $homeTask->class = $after_explode_class[0];
            $homeTask->group_id = null;
        }
        if ($after_explode_class[1] === 'group') {
            $homeTask->group_id = $after_explode_class[0];
            $homeTask->class = null;
        }
        $homeTask->subject = $request->subject;
        $homeTask->submission_date = $request->submission_date;
        $homeTask->submission_time = $request->submission_time;
        $homeTask->upload_file = $fileName;
        $homeTask->save();

        return redirect()->back()->with('success', 'Task upload successfully');
    }

    public function attendance(Request $request)
    {
        if($request->ajax()){
            $attendance = Attendance::whereDate('date', $request->date)
            ->where('user_id',Auth::user()->id)
            ->latest()
            ->get();
            return response()->json($attendance);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $specific_attendance = Attendance::where('user_id', Auth::user()->id)
            ->where('date',date('Y-m-d'))->latest()->take(4)->get();
            $specific_date = date('Y-m-d');
            return view('teacher.attendance', compact('specific_attendance','specific_date'));
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['submit_btn'])) {

                if ($_POST['submit_btn'] === 'attendance') {
                    $this->validate($request, [
                        'date' => 'required|'
                    ]);
                    $date = $request->date;
                    $data['specific_date'] = $date;
                    $data['no_of_working_hours'] = Attendance::whereDate('date', $date)
                        ->selectRaw("SEC_TO_TIME(sum(TIME_TO_SEC(TIMEDIFF(logout_time,login_time) )) ) as 'total'")
                        ->first();
                    $data['specific_attendance'] = Attendance::where('user_id', Auth::user()->id)
                        ->whereDate('date', '=', $date)->latest()->take(4)->get();
                    // dd($data);
                    // dd($checked_attendance);
                    // dd($data['no_of_working_hours']->total);
                } else {
                    $this->validate($request, [
                        'start_date' => 'required|date',
                        'end_date' => 'required|date'
                    ]);
                    if ($request->start_date > $request->end_date) {
                        return redirect()->back()->with('error','Please select valid range');
                    }
                    $from = date($request->start_date);
                    $to = date($request->end_date);
                    $data['start_date'] = $request->start_date;
                    $data['end_date'] = $request->end_date;

                    $available_att = Attendance::where('user_id',Auth::user()->id)->whereBetween('date', [$from, $to])->latest()->get();
                    dd( $available_att);

                    for ($i = $from; $i <= $to ; $i++) {
                       $attendance_array[] = Attendance::where('user_id',Auth::user()->id)->whereDate('date', $i)->first();
                    }
                    dd($attendance_array);


                    $data['checked_attendance'] = Attendance::selectRaw('*')->where('user_id',Auth::user()->id)->whereBetween('date', [$from, $to])->latest()->get()->groupBy('date');
                }
                if (isset($data['specific_attendance'])) {
                    if ($data['specific_attendance']->count() > 0) {
                        return view('teacher.attendance')->with($data);
                    }
                    else {
                        $absent_date =  $date;
                        return view('teacher.attendance',compact('absent_date'));
                    }
                } elseif(isset($data['checked_attendance'])){
                    if ($data['checked_attendance']->count() > 0) {
                        return view('teacher.attendance')->with($data);
                    }
                    else {
                        $attendance = [];
                        $attendance['date'] = $date;
                        $attendance['login_time'] = 'N/A';
                        $attendance['logout_time'] = 'N/A';
                        return view('teacher.attendance')->with($attendance);
                    }
            }
               
            } else {
                $attendance = Attendance::find($request->attendance_id);
                $attendance->comment = $request->comment;
                $attendance->save();
                return response()->json('success');
            }
        }
    }
    public function class()
    {
        $data['groups'] = Group::latest()->where('teacher_id', Auth::user()->id)->get();
        $data['classes'] = Classes::orderBy('name')->get();
        $data['subjects'] = Subject::latest()->get();
        $data['arrange_classes'] = ArrangeClass::where('user_id', Auth::user()->id)->latest()->get();
        return view('teacher.access_class')->with($data);
    }
    public function studentSubmission()
    {
        // $tasks = SubmitHomeTask::latest()->get();
        $tasks = DB::table('submit_home_task')
            ->where('user_id', Auth::user()->id)
            ->join('home_task', 'submit_home_task.task_id', '=', 'home_task.id')
            ->get();
        return view('teacher.submission_task', compact('tasks'));
    }
    public function videoCall()
    {
        return view('teacher.video_call');
    }
    public function manageExam()
    {
        $data['groups'] = Group::latest()->where('teacher_id', Auth::user()->id)->get();
        $data['subjects'] = Subject::latest()->get();
        $data['classes'] = Classes::orderBy('name')->get();
        $data['assign_exam'] = ArrangeExam::where('user_id', Auth::user()->id)->latest()->get();
        return view('teacher.exam')->with($data);;
    }

    public function taskReview(Request $request)
    {
        $task = SubmitHomeTask::where('task_id', $request->data['task_id'])->first();
        $task->review = $request->data['review'];
        $task->save();
        return response()->json('success');
    }
    public function taskComment(Request $request, $id)
    {
        $this->validate($request, [
            'comment' => 'required|max:255'
        ]);
        $task = SubmitHomeTask::where('task_id', $id)->first();
        $task->comment = $request->comment;
        $task->save();
        return response()->json('success');
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
        $fileName = imageUpload($image, 'teacher_certificate');

        $certificate = new Certificate();
        $certificate->user_id = Auth::user()->id;
        $certificate->image = $fileName;
        $certificate->save();

        $user = User::find(Auth::user()->id);
        $user->is_rejected_document_uploaded = 1;
        $user->save();

        return redirect()->back();
    }

    public function arrange_class(Request $request)
    {
        $class = $request->class;
        $after_explode_class = explode('-', $class);
        $date = $request->date;
        $start_time = $request->start_time;
        $end_time = $request->end_time;

        $class_start_time = date('H:i', strtotime($start_time));
        $class_end_time = date('H:i', strtotime($end_time));
        $arrange_class = ArrangeClass::where('class', $after_explode_class[0])
            ->where('date', $date)
            ->whereTime('start_time', '<=', $class_start_time)
            ->whereTime('end_time', '>=', $class_start_time)
            ->count();
        $group_arrange_class = ArrangeClass::where('group_id', $after_explode_class[0])
            ->where('date', $date)
            ->whereTime('start_time', '<=', $class_start_time)
            ->whereTime('end_time', '>=', $class_start_time)
            ->count();

        if ($arrange_class == 0 && $group_arrange_class == 0) {
            $arrange_class = new ArrangeClass();
            $arrange_class->user_id = Auth::user()->id;
            $arrange_class->subject = $request->subject;
            if ($after_explode_class[1] === 'class') {
                $arrange_class->class = $after_explode_class[0];
                $arrange_class->group_id = null;
            }

            if ($after_explode_class[1] === 'group') {
                $arrange_class->group_id = $after_explode_class[0];
                $arrange_class->class = null;
            }

            $arrange_class->date = $date;
            $arrange_class->start_time = $request->start_time;
            $arrange_class->end_time = $request->end_time;
            $arrange_class->meeting_url = $request->meeting_url;
            $arrange_class->save();
            return response()->json(array(
                'success' => 'Data save successfully',
            ));
        } else {
            return response()->json(array(
                'error' => 'Already assigned a class on this time',
            ));
        }
    }

    public function class_attendance(Request $request)
    {
        $class_id = $request->class_id;
        $user_id = Auth::user()->id;
        $already_joined = ClassAttendance::where('class_id', $class_id)->where('user_id', $user_id)->first();

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

    public function assignExam(Request $request)
    {
        $this->validate($request, [
            // 'class' => 'required',
            // 'subject' => 'required',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            // 'full_marks' => 'required',
            // 'result_date' => 'required',
            // 'upload_file' => 'required|mimes:pdf'
        ]);

        $exam_start_time = date('H:i', strtotime($request->start_time));
        $exam_end_time = date('H:i', strtotime($request->end_time));

        $minutes_to_add = 180;
        $current_time = getAsiaTime24(date('Y-m-d H:i:s'));
        $time = new DateTime($request->date . $request->start_time);
        $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
        
        $new_time = $time->format('H:i');
        // dd($new_time);
        if ($exam_start_time > $exam_end_time) {
            return redirect()->back()->with('error', 'Please choose valid end time')->withInput();;
        }

        $after_explode_class = explode('-', $request->class);

        $arrange_exam = ArrangeExam::where('class', $after_explode_class[0])
        ->where('date', $request->date)
        ->whereTime('start_time', '<=', $exam_start_time)
        ->whereTime('end_time', '>=', $exam_start_time)
        ->count();
        $group_arrange_exam = ArrangeExam::where('group_id', $after_explode_class[0])
        ->where('date', $request->date)
        ->whereTime('start_time', '<=', $exam_start_time)
        ->whereTime('end_time', '>=', $exam_start_time)
        ->count();

        // $arrange_exam = ArrangeExam::where('class', $request->class)
        //     ->where('date', $request->date)
        //     ->whereTime('start_time', '<=', $exam_start_time)
        //     ->whereTime('end_time', '>=', $exam_start_time)
        //     ->count();
        if ($arrange_exam == 0 && $group_arrange_exam == 0) {
            if ($request->hasFile('upload_file')) {
                $file = $request->file('upload_file');
                $fileName = imageUpload($file, 'teacher/exam');
            } else {
                $fileName = null;
            }

            $class = $request->class;
            $after_explode_class = explode('-', $class);

            $exam = new ArrangeExam();
            $exam->user_id = Auth::user()->id;
            if ($after_explode_class[1] === 'class') {
                $exam->class = $after_explode_class[0];
                $exam->group_id = null;
            }
            if ($after_explode_class[1] === 'group') {
                $exam->group_id = $after_explode_class[0];
                $exam->class = null;
            }
            $exam->subject = $request->subject;
            $exam->date = $request->date;
            $exam->start_time = $request->start_time;
            $exam->end_time = $request->end_time;
            $exam->full_marks = $request->full_marks;
            $exam->result_date = $request->result_date;
            $exam->upload_file = $fileName;
            $exam->save();

            return redirect()->back()->with('success', 'Exam upload successfully');
        } else {
            return redirect()->back()->with('error', 'Exam already schedule this time')->withInput();;
        }
    }

    public function examSubmission()
    {
        $data['groups'] = Group::latest()->where('teacher_id', Auth::user()->id)->get();
        $data['subjects'] = Subject::latest()->get();
        $data['classes'] = Classes::orderBy('name')->get();
        $data['users'] = User::where('role_id', 4)->latest()->get();
        return view('teacher.submission_exam_filter')->with($data);
    }
    public function studentExamSubmission(Request $request)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $submitted_exams_detail = SubmitExam::where('user_id', Auth::user()->id)
                ->join('arrange_exams', 'submit_exams.exam_id', '=', 'arrange_exams.id')
                ->orderBy('submit_exams.created_at', 'DESC')
                ->get();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['student_wise_result'])) {
                // $this->validate($request, [
                //     'student_id' => 'required',
                //     'class_name' => 'required'
                // ]);

                Validator::make($request->all(), [
                    'student_id' => 'required',
                    'class_name' => 'required'
                ], $messages = [
                    'student_id.required' => 'The student field is required.',
                    'class_name.required' => 'The class field is required.',
                ])->validate();

                $student_id = $request->student_id;
                $data['user_details'] = User::where('id_no', $student_id)->first();
                $data['all_result'] = SubmitExam::where('id_no', $student_id)
                    ->where('marks', '!=', '')
                    ->join('arrange_exams', 'arrange_exams.id', '=', 'submit_exams.exam_id')
                    ->get();
                $data['total_marks'] = SubmitExam::where('id_no', $student_id)
                    ->where('marks', '!=', '')
                    ->join('arrange_exams', 'arrange_exams.id', '=', 'submit_exams.exam_id')
                    ->sum('marks');
                $data['total_full_marks'] = SubmitExam::where('id_no', $student_id)
                    ->where('marks', '!=', '')
                    ->join('arrange_exams', 'arrange_exams.id', '=', 'submit_exams.exam_id')
                    ->sum('full_marks');
                $pdf = PDF::loadView('student.report', $data);
                return $pdf->download($student_id . '.pdf');
            }
            if (isset($_POST['class_wise_result'])) {
                Validator::make($request->all(), [
                    'class_name1' => 'required'
                ], $messages = [
                    'required' => 'The class field is required.',
                ])->validate();


                $class = $request->class_name1;
                $after_explode_class = explode('-', $class);

                if ($after_explode_class[1] === 'class') {
                    $data['class'] = $after_explode_class[0];
                    $class_details = Classes::where('id', $after_explode_class[0])->first('name');

                    $data['all_result'] = SubmitExam::where('arrange_exams.user_id', Auth::user()->id)
                        ->where('arrange_exams.class', $after_explode_class[0])
                        ->where('marks', '!=', '')
                        ->join('arrange_exams', 'arrange_exams.id', '=', 'submit_exams.exam_id')
                        // ->join('users','users.id_no','=','submit_exams.roll_no')
                        ->get();
                }
                if ($after_explode_class[1] === 'group') {
                    $data['class'] = $after_explode_class[0];
                    $class_details = Group::where('id', $after_explode_class[0])->first('name');

                    $data['all_result'] = SubmitExam::where('arrange_exams.user_id', Auth::user()->id)
                        ->where('arrange_exams.group_id', $after_explode_class[0])
                        ->where('marks', '!=', '')
                        ->join('arrange_exams', 'arrange_exams.id', '=', 'submit_exams.exam_id')
                        // ->join('users','users.id_no','=','submit_exams.roll_no')
                        ->get();
                }
                $pdf = PDF::loadView('teacher.report', $data);
                return $pdf->download($class_details->name . '-results' . '.pdf');
            }
            if (isset($_POST['view_submission'])) {
                $this->validate($request, [
                    'subject' => 'required',
                    'class' => 'required'
                ]);
                $class = $request->class;
                $after_explode_class = explode('-', $class);

                if ($after_explode_class[1] === 'class') {
                    $submitted_exams_detail = SubmitExam::where('user_id', Auth::user()->id)
                        ->where('arrange_exams.class', $after_explode_class[0])
                        ->where('arrange_exams.subject', $request->subject)
                        ->join('arrange_exams', 'submit_exams.exam_id', '=', 'arrange_exams.id')
                        ->orderBy('submit_exams.created_at', 'DESC')
                        ->get();
                }
                if ($after_explode_class[1] === 'group') {
                    $submitted_exams_detail = SubmitExam::where('user_id', Auth::user()->id)
                        ->where('arrange_exams.group_id', $after_explode_class[0])
                        ->where('arrange_exams.subject', $request->subject)
                        ->join('arrange_exams', 'submit_exams.exam_id', '=', 'arrange_exams.id')
                        ->orderBy('submit_exams.created_at', 'DESC')
                        ->get();
                }
            }
        }
        return view('teacher.submission_exam', compact('submitted_exams_detail'));
    }

    public function examMarks(Request $request, $id)
    {
        $exam_detail = SubmitExam::where('exam_id', $id)
            ->join('arrange_exams', 'arrange_exams.id', '=', 'submit_exams.exam_id')
            ->first();
        // dd($exam_detail->marks);
        if ($request->marks > $exam_detail->full_marks) {
            return redirect()->back()->with('error', 'Please enter valid marks');
        }
        $exam = SubmitExam::where('exam_id', $id)->first();
        $exam->marks = $request->marks;
        $exam->save();
        return redirect()->back();
    }

    public function examComment(Request $request, $id)
    {
        $this->validate($request, [
            'comment' => 'required|max:255'
        ]);
        $exam = SubmitExam::where('exam_id', $id)->first();
        $exam->comment = $request->comment;
        $exam->save();
        return response()->json('success');
    }

    public function view_participation(Request $request)
    {
        $participation = ClassAttendance::where('class_id', $request->prop_id)
            ->where('role_id', 4)
            ->join('users', 'users.id', '=', 'class_users.user_id')
            ->get();
        // dd($participation);
        return response()->json($participation);
    }

    public function assigned_groups(Request $request)
    {
        $groups = Group::where('teacher_id', Auth::user()->id)->latest()->get();
        return view('teacher.assigned_group', compact('groups'));
    }

    //Whiteboard
    public function whiteboard(){
        return view('teacher.whiteboard');
    }

    public function updateBio(Request $request)
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
}
