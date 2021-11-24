<?php

namespace App\Http\Controllers\HR;

use App\Models\User;
use App\Models\Event;
use App\Models\Group;
use App\Models\Classes;
use App\Models\Attendance;
use App\Models\Certificate;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
    // Attendance
    public function attendance(Request $request)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data['checked_attendance'] = Attendance::where('user_id', Auth::user()->id)->latest()->get();
            // dd($data);
            return view('hr.attendance')->with($data);
        }
    }
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
                ->get();
            return view('hr.attendance_teacher_list', compact('attendance_detail'));
        }
        if ($role == 4) {
            $data['attendance_detail'] = User::where('role_id', $role)
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
            return view('hr.attendance_date', compact('specific_attendance', 'specific_date','user_id'));
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
                } else {
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
                    $data['checked_attendance'] = Attendance::selectRaw('*')->where('user_id', $user_id)->whereBetween('date', [$from, $to])->latest()->get()->groupBy('date');
                    $avl_attendance = Attendance::selectRaw('*')->where('user_id', $user_id)->whereBetween('date', [$from, $to])->latest()->get()->groupBy('date')->toArray();
                    $data['user_id'] = $user_id;

                    //Loop through date
                    for ($i=$from; $i < $to; $i++) { 
                        // $absent_attendance[] = !in_array($i,$avl_attendance);
                        if (!in_array($i,$avl_attendance)) {
                            $absent_attendance[] = $i;
                        }
                        // $avl_attendance = Attendance::where('user_id', $user_id)->whereDate('date', $i)->get()->groupBy('date');
                        // echo "<pre>";
                        // print_r($avl_attendance);
                        // if ($avl_attendance->isEmpty()) {
                        //     echo $i;
                        //     $arr_attendance[] = $avl_attendance;
                        // }
                        // else{
                        //     dd('test');
                        //     $absent_attendance[] = $i;
                        //     echo $i;
                        //     // $absent_attendance['status'] = 'Absent';
                        // }
                    }
                    // dd('test');
                    // dd($avl_attendance,$absent_attendance);
                    // if (isset($absent_attendance)) {
                    //     $data['absent_attendance'] = $absent_attendance;
                    // }
                    
                    // dd($absent_attendance);
                    // $data['checked_attendance'] = $arr_attendance;
                    // dd($arr_attendance, $data['checked_attendance']);
                }

                if (isset($data['specific_attendance'])) {
                    if ($data['specific_attendance']->count() > 0) {
                        return view('hr.attendance_date')->with($data);
                    } else {
                        $absent_date =  $date;
                        return view('hr.attendance_date', compact('absent_date'));
                    }
                } elseif (isset($data['checked_attendance'])) {
                    if ($data['checked_attendance']->count() > 0) {
                        return view('hr.attendance_date')->with($data);
                    } else {
                        $attendance = [];
                        // $attendance['date'] = $date;
                        $attendance['login_time'] = 'N/A';
                        $attendance['logout_time'] = 'N/A';
                        return view('hr.attendance_date')->with($attendance);
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
        $announcement = new Announcement();
        $announcement->user_id = Auth::user()->id;
        $announcement->title = $request->title;
        $announcement->class_id = implode(',', $request->class_id);

        $announcement->date = $request->date;
        $announcement->description = $request->desc;
        // dd($announcement);
        $announcement->save();

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
}
