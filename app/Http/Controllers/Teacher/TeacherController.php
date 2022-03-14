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
use App\Models\Notification;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Question;
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
        $data['subjects'] = Subject::latest()->get();
        $data['teacher'] = User::where('id', $current_user_id)->first();
        $data['certificates'] = Certificate::where('user_id', $current_user_id)->get();
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
        if ($request->subject) {
            $teacher->special_subject = implode(',', $request->subject);
        }
        if ($request->bio) {
            $this->validate($request, [
                'bio' => 'max:255'
            ]);
            $teacher->about_us = $request->bio;
        }
        $teacher->save();

        $user_id = $teacher->id;

        createNotification($user_id, 0, 0, 'update_teacher_profile');

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

                    createNotification($user_id, 0, 0, 'teacher_change_password');

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

    public function attendance(Request $request)
    {
        if ($request->ajax()) {
            $attendance = Attendance::whereDate('date', $request->date)
                ->where('user_id', Auth::user()->id)
                ->latest()
                ->get();
            return response()->json($attendance);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $specific_attendance = Attendance::where('user_id', Auth::user()->id)
                ->where('date', date('Y-m-d'))->latest()->take(4)->get();
            $specific_date = date('d-M-Y');
            return view('teacher.attendance', compact('specific_attendance', 'specific_date'));
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['submit_btn'])) {

                if ($_POST['submit_btn'] === 'attendance') {
                    $this->validate($request, [
                        'date' => 'required|'
                    ]);
                    $date = date('Y-m-d',strtotime($request->date));
                    $data['specific_date'] = $request->date;
                    $data['no_of_working_hours'] = Attendance::whereDate('date', $date)
                        ->selectRaw("SEC_TO_TIME(sum(TIME_TO_SEC(TIMEDIFF(logout_time,login_time) )) ) as 'total'")
                        ->first();
                    $data['specific_attendance'] = Attendance::where('user_id', Auth::user()->id)
                        ->whereDate('date', '=', $date)->latest()->take(4)->get();
                } else {
                    $this->validate($request, [
                        'start_date' => 'required|date',
                        'end_date' => 'required|date'
                    ]);
                    if ($request->start_date > $request->end_date) {
                        return redirect()->back()->with('error', 'Please select valid range');
                    }
                    $from = new DateTime($request->start_date);
                    $to = new DateTime($request->end_date);
                    $data['start_date'] = $request->start_date;
                    $data['end_date'] = $request->end_date;

                    for ($i = $from; $i <= $to ; $i->modify('+1 day')) {
                       $attendance = Attendance::where('user_id',Auth::user()->id)->whereDate('date', $i)->first();
                       if (empty($attendance)) {
                        $present_date[] = array(
                               "date" => $i->format("d-M-Y"),
                               "login_time" => null
                           );
                       }else{
                           $present_date[] = Attendance::where('user_id',Auth::user()->id)->whereDate('date', $i)->first();
                       }
                    }
                    if (empty($absent_date)) {
                        $absent_date = [];

                    }
                    if (empty($present_date)) {
                        $present_date = [];
                    }
                    $attendance = $present_date;
                    // dd($attendance);
                    $data['checked_attendance'] = $attendance;
                }
                if (isset($data['specific_attendance'])) {
                    if ($data['specific_attendance']->count() > 0) {
                        return view('teacher.attendance')->with($data);
                    } else {
                        $absent_date =  $date;
                        return view('teacher.attendance', compact('absent_date'));
                    }
                } elseif (isset($data['checked_attendance'])) {
                    return view('teacher.attendance')->with($data);
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
        $data = array();
        $data['groups'] = Group::latest()->where('teacher_id', Auth::user()->id)->get();
        if (Auth::user()->class_access == 1) {
            $data['classes'] = Classes::latest()->get();
        }else{
            $data['classes'] = [];
        }
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

    public function taskReview(Request $request)
    {
        $task = SubmitHomeTask::where('task_id', $request->data['task_id'])->first();
        $task->review = $request->data['review'];
        $task->save();
        return response()->json('success');
    }
    public function taskComment(Request $request, $id)
    {
        // dd($request->all(),$id);
        $this->validate($request, [
            'comment' => 'max:255',
            'review' => 'required'
        ]);
        $task = SubmitHomeTask::where('task_id', $id)->first();
        $task->comment = $request->comment;
        $task->review = $request->review;
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
        // dd($group);
        $after_explode_class = explode('-', $class);
        $date = date('Y-m-d',strtotime($request->date));
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

        $user_id = Auth::user()->id;

        if ($arrange_class == 0 && $group_arrange_class == 0) {
            $arrange_class = new ArrangeClass();
            $arrange_class->user_id = $user_id;
            $arrange_class->subject = $request->subject;
            if ($after_explode_class[1] === 'class') {
                $arrange_class->class = $after_explode_class[0];
                $arrange_class->group_id = null;
                createNotification($user_id, $after_explode_class[0], 0, 'teacher_arrange_class');
            }
            if ($after_explode_class[1] === 'group') {
                $arrange_class->group_id = $after_explode_class[0];
                $arrange_class->class = null;
                createNotification($user_id, 0, $after_explode_class[0], 'teacher_arrange_class');
            }

            $arrange_class->date = $date;
            $arrange_class->start_time = $request->start_time;
            $arrange_class->end_time = $request->end_time;
            $arrange_class->meeting_url = $request->meeting_url;
            $arrange_class->save();
            // $user_id = auth()->user->id;

            // createNotification($user_id, $class, 0, 'teacher_arrange_class');
            // createNotification($user_id, $class, $group, 'teacher_arrange_class');

            $notification = new Notification();
            $notification->user_id = $user_id;
            if ($after_explode_class[1] === 'class') {
                $notification->class_id = $after_explode_class[0];
            } elseif ($after_explode_class[1] === 'group') {
                $notification->group_id = $after_explode_class[0];
            }
            $notification->type = 'teacher_arrange_class';
            $notification->title = 'Class Arranged';
            $notification->message = 'Please Update and check';
            $notification->route = 'teacher.class';
            $notification->save();

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
    public function whiteboard()
    {
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
