<?php

namespace App\Http\Controllers\HR;

// use App\Http\Controllers\Admin\Notification;
use App\Models\User;
use App\Models\Event;
use App\Models\Group;
use App\Models\Classes;
use App\Models\Attendance;
use App\Models\Certificate;
use App\Models\Announcement;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentGalary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HRController extends Controller
{
    public function index()
    {

        $current_user_id = Auth::user()->id;
        $data['hr'] = User::where('id', $current_user_id)->first();
        return view('hr.profile')->with($data);
    }
    public function updateProfile(Request $request)
    {
        $hr = User::find(Auth::id());
        if ($request->qualification) {
            $hr->qualification = $request->qualification;
        }
        if ($request->address) {
            $hr->address = $request->address;
        }
        $hr->save();

        $user_id = $hr->id;

        createNotification($user_id, 0, 0, 'update_hr_address');

        return response()->json('success');
    }

    public function updateBio(Request $request)
    {
        $hr = User::find(Auth::id());
        if ($request->dob) {
            $this->validate($request, [
                'dob' => 'date|nullable',
            ]);
            $hr->dob = $request->dob;
        }
        if ($request->gender) {
            $hr->gender = $request->gender;
        }
        if ($request->bio) {
            $this->validate($request, [
                'bio' => 'max:255'
            ]);
            $hr->about_us = $request->bio;
        }

        $hr->save();

        $user_id = $hr->id;
        createNotification($user_id, 0, 0, 'update_hr_bio');
        return response()->json('success');
    }

    /* From here HR can see which type of user attendance he/she want to visit
     student Attendance or teacher attendance */
    public function attendance(Request $request)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data['checked_attendance'] = Attendance::where('user_id', Auth::user()->id)->latest()->get();
            return view('hr.attendance')->with($data);
        }
    }
    /*
        From here HR can select which type of user attendance he/she want to visit
        student Attendance or teacher attendance
    */
    public function attendanceFor(Request $request)
    {
        Validator::make($request->all(), [
            'role_id' => 'required',
        ], $messages = [
            'role_id.required' => 'Please select any one!',
        ])->validate();
        $this->validate($request, [
            'role_id' => 'required',
        ]);
        $role = $request->role_id;
        // $after_explode_role = explode('-', $role);

        if ($role == 3) {
            $attendance_detail = User::where('role_id', $role)
                ->latest()
                ->get();
            return view('hr.attendance_teacher_list', compact('attendance_detail'));
        }
        if ($role == 4) {
            $data['attendance_detail'] = User::where('role_id', $role)
                ->latest()
                ->get();
            $data['groups'] = Group::latest()->get();
            $data['classes'] = Classes::orderBy('name')->get();
            return view('hr.attendance_student')->with($data);
        }
    }

    public function attendanceStudentShow(Request $request, $id)
    {
        $user_id = $id;
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $specific_attendance = Attendance::where('user_id', $user_id)
                ->where('date', date('Y-m-d'))->latest()->take(4)->get();
            $specific_date = date('Y-m-d');
            return view('hr.attendance_date', compact('specific_attendance', 'specific_date', 'user_id'));
        }
        if ($request->ajax()) {
            $attendance = Attendance::whereDate('date', $request->date)
                ->where('user_id', $id)
                ->latest()
                ->get();
            return response()->json($attendance);
        }
        return view('hr.attendance_date', compact('user_id'));
    }

    public function attendanceShow(Request $request)
    {
        // return view('hr.attendance_date');
        $user_id = $request->user_id;
        if ($request->ajax()) {
            // dd($user_id);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $attendance = Attendance::where('date', $request->date)
                ->where('user_id', $user_id)
                ->latest()
                ->get();
            }

            // dd($attendance);
            return response()->json($attendance);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $specific_attendance = Attendance::where('user_id', $user_id)
                ->where('date', date('Y-m-d'))->latest()->take(4)->get();
            $specific_date = date('Y-m-d');
            return view('hr.attendance_date', compact('specific_attendance', 'specific_date'));
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
                    $data['specific_attendance'] = Attendance::where('user_id', $user_id)
                        ->whereDate('date', '=', $date)->latest()->take(4)->get();
                    $data['user_id'] = $user_id;
                    // dd($data);
                    // dd($data['specific_attendance']);
                    // dd($data['no_of_working_hours']->total);
                } else {
                    // dd($user_id);
                    // dd($request->all());
                    $this->validate($request, [
                        'start_date' => 'required|date',
                        'end_date' => 'required|date'
                    ]);
                    if ($request->start_date > $request->end_date) {
                        return redirect()->back()->with('error', 'Please select valid range');
                    }
                    $from = date($request->start_date);
                    $to = date($request->end_date);
                    $data['start_date'] = $request->start_date;
                    $data['end_date'] = $request->end_date;
                    $data['user_id'] = $request->user_id;
                    // $available_att = Attendance::where('user_id',$user_id)->whereBetween('date', [$from, $to])->latest()->get();
                    // dd( $available_att);

                    for ($i = $from; $i <= $to ; $i++) {
                       $attendance = Attendance::where('user_id',$user_id)->whereDate('date', $i)->first();
                       if (empty($attendance)) {
                           $absent_date[] = array(
                               "date" => $i
                           );
                       }else{
                           $present_date[] = Attendance::where('user_id',$user_id)->whereDate('date', $i)->first();
                       }
                    }
                    if (empty($absent_date)) {
                        $absent_date = [];

                    }
                    if (empty($present_date)) {
                        $present_date = [];
                    }
                    $attendance = array_merge($absent_date,$present_date);
                    // dd($attendance);

                    // $data['checked_attendance'] = Attendance::selectRaw('*')->where('user_id', $user_id)->whereBetween('date', [$from, $to])->latest()->get()->groupBy('date');
                    $data['checked_attendance'] = $attendance;
                }
                if (isset($data['specific_attendance'])) {
                    if ($data['specific_attendance']->count() > 0) {
                        return view('hr.attendance_date')->with($data);
                    } else {
                        $absent_date =  $date;
                        return view('hr.attendance_date', compact('absent_date'));
                    }
                } elseif (isset($data['checked_attendance'])) {
                    // dd($data);
                    // if ($data['checked_attendance']->count() > 0) {
                        return view('hr.attendance_date')->with($data);
                    // } else {
                    //     $attendance = [];
                    //     $attendance['date'] = $date;
                    //     $attendance['login_time'] = 'N/A';
                    //     $attendance['logout_time'] = 'N/A';
                    //     return view('hr.attendance_date')->with($attendance);
                    // }
                }
            }
        }
    }

    public function attendanceStudent(Request $request)
    {
        // dd($request->all());
        $user_id = $request->student_id;
        $attendance = Attendance::where('user_id', $user_id)
        ->where('date', date('Y-m-d'))
        ->latest()
        ->get();
        if (empty($attendance)) {
            $attendance_status = 0;
        } else {
            $attendance_status = 1;
        }
        $date = date('Y-m-d');
        $specific_attendance = array(
            "date" => $date,
            "attendance_status" => $attendance_status
        );
        // ddd($data);
        return view('hr.student_attendance',compact('user_id'))->with($specific_attendance);
    }

    public function studentAttendanceDetails(Request $request)
    {
        //  dd($request->all());
        $user_id = $request->user_id;
        if (isset($_POST['submit_btn'])) {

            if ($_POST['submit_btn'] === 'attendance') {
                $this->validate($request, [
                    'date' => 'required|'
                ]);
                $date = $request->date;
                $data['specific_date'] = $date;
                $attendance = Attendance::where('user_id', $user_id)
                ->where('date', $date)->first();
                if (empty($attendance)) {
                    $attendance_status = 0;
                } else {
                    $attendance_status = 1;
                }
                $data['specific_attendance'] = array(
                    "date" => $date,
                    "attendance_status" => $attendance_status
                );
            } else {
                $this->validate($request, [
                    'start_date' => 'required|date',
                    'end_date' => 'required|date'
                ]);
                if ($request->start_date > $request->end_date) {
                    return redirect()->back();
                    return redirect()->route('hr.studentAttendanceDetails')->with('error', 'Please select valid range');
                }
                $from = date($request->start_date);
                $to = date($request->end_date);
                $data['start_date'] = $request->start_date;
                $data['end_date'] = $request->end_date;

                $start = strtotime($from);
                $end = strtotime($to);

                $days_between = floor(abs($end - $start) / 86400);
                // dd($days_between);
                if ($days_between  > 30) {
                    return redirect()->route('hr.studentAttendanceDetails')->with('error', 'You can view 30 days attendence');
                }

                for ($i = $from; $i <= $to ; $i++) {
                   $attendance = Attendance::where('user_id',$user_id)->whereDate('date', $i)->first();
                   if (empty($attendance)) {
                       $absent_date[] = array(
                           "date" => $i,
                           "attendance_status" => 0
                       );
                   }else{
                       $present_date[] = array(
                        "date" => $i,
                        "attendance_status" => 1
                    );
                   }
                }
                if (empty($absent_date)) {
                    $absent_date = [];

                }
                if (empty($present_date)) {
                    $present_date = [];
                }
                $attendance = array_merge($absent_date,$present_date);
                $data['checked_attendance'] = $attendance;
            }
            if (isset($data['specific_attendance'])) {
                if ($data['specific_attendance']) {
                    return view('hr.student_attendance',compact('user_id'))->with($data);
                } else {
                    $absent_date =  $date;
                    return view('hr.student_attendance', compact('absent_date'));
                }
                    // return view('hr.student_attendance')->with($data);
            } elseif (isset($data['checked_attendance'])) {
                    return view('hr.student_attendance',compact('user_id'))->with($data);
            }
        }
    }
    // Events
    public function manageEvent(Request $request)
    {
        $data['groups'] = Group::latest()->get();
        // $data['subjects'] = Subject::latest()->get();
        $data['classes'] = Classes::orderBy('name')->get();
        $data['events'] = Event::where('user_id', Auth::user()->id)->paginate(2);
        // return view('teacher.hometask',compact('classes'));
        return view('hr.manage_event')->with($data);
    }

    public function uploadEvevnt(Request $request)
    {
        Validator::make($request->all(), [
            'class' => 'required',
            'title' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'desc' => 'required|max:500',
            'image' => 'required|mimes:jpeg,png,jpg'
        ], $messages = [
            'desc.required' => 'The description field is required.',
            'class.required' => 'The class/group field is required.',
        ])->validate();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = imageUpload($file, 'hr/event');
        } else {
            $fileName = null;
        }

        $class = $request->class;
        $after_explode_class = explode('-', $class);

        $event = new Event();
        $event->user_id = Auth::user()->id;
        if ($after_explode_class[1] === 'class') {
            $event->class_id = $after_explode_class[0];
            $event->group_id = null;
        }
        if ($after_explode_class[1] === 'group') {
            $event->group_id = $after_explode_class[0];
            $event->class_id = null;
        }
        $event->title = $request->title;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->desc = $request->desc;
        $event->image = $fileName;
        $event->save();

        $user_id = Auth::user()->id;

        createNotification($user_id, $class, 0, 'event_create');
        // createNotification($user_id, 0, 0, 'event_create');

        $notification = new Notification();
        $notification->user_id = $user_id;
        $notification->class_id = $class;
        $notification->group_id = 0;
        $event->type = 'event_create';
        $notification->title = 'Event createt';
        $notification->message = 'Please Update and check';
        $notification->route = 'hr.manage-event';
        $notification->save();

        return redirect('hr/event-management')->with('success', 'Event upload successfully');
    }

    public function notice(Request $request)
    {
        return view('hr.notice');
    }
    public function downloadReport(Request $request)
    {
        return view('hr.download_report');
    }
    public function changePassword()
    {
        $data = array();
        return view('hr.change_password')->with($data);
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

                    createNotification($user_id, 0, 0, 'hr_change_password');
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

    // public function event()
    // {
    //     $data['groups'] = Group::latest()->where('hr_id', Auth::user()->id)->get();
    //     // $data['subjects'] = Subject::latest()->get();
    //     $data['classes'] = Classes::orderBy('name')->get();
    //     $data['events'] = Event::where('user_id', Auth::user()->id)->latest()->get();
    //     // return view('teacher.hometask',compact('classes'));
    //     return view('hr.manage_event')->with($data);
    // }


    // Announcement
    public function Announcement(Request $request)
    {
        $classes = Classes::orderBy('name')->get();
        $announcements = Announcement::where('user_id', Auth::user()->id)->paginate(2);
        // dd($announcements);
        return view('hr.announcement', compact('classes', 'announcements'));
    }

    public function announcementUpload(Request $request)
    {
        Validator::make($request->all(), [
            'title' => 'required|string|max:150',
            'class_id' => 'required',
            'date' => 'required|date',
            'desc' => 'required|string|max:500',
        ], $messages = [
            'class_id.required' => 'The class field is required.',
            'desc.required' => 'The description field is required.',
        ])->validate();

        $class = $request->class_id;
        $user_id = Auth::user()->id;


        $announcement = new Announcement();
        $announcement->user_id = $user_id;
        $announcement->title = $request->title;
        $announcement->class_id = implode(',', $request->class_id);

        $announcement->date = $request->date;
        $announcement->description = $request->desc;
        // dd($announcement->description);
        $announcement->save();

        // dd($announcement);


        // createNotification($user_id, $class, 0, 'announcement_create');

        return redirect()->back()->with('success', 'Announcement upload successfully');
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

    // Student Galary
    public function studentGalary(Request $request)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            $photos = StudentGalary::where('user_id',Auth::user()->id)->latest()->get();;
            return view('hr.student_galary',compact('photos'));
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            Validator::make($request->all(), [
                'upload_file' => 'required|mimes:jpg,jpeg,png',
            ], $messages = [
                'upload_file.required' => 'This field is required.',
                'upload_file.mimes' => 'Please upload pdf file',
            ])->validate();
        }
        $image = $request->file('upload_file');
        $fileName = imageUpload($image, 'student_galary');

        $galary = new StudentGalary();
        $galary->image = $fileName;
        $galary->user_id = Auth::user()->id;
        $galary->save();
        return redirect()->back()->with('success','SUccessfully image uploaded');
    }
}
