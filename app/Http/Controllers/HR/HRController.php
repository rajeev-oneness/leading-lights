<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HRController extends Controller
{
    public function index(){

        $current_user_id = Auth::user()->id;
        // $data['classes'] = ArrangeClass::where('class', Auth::user()->class)
            // ->join('subjects','subjects.id','=','arrange_classes.class')
            // ->whereDate('date', '=', date('Y-m-d'))->orderBy('arrange_classes.created_at','desc')->get();
        $data['hr'] = User::where('id', $current_user_id)->first();
        // $data['student_age'] = Carbon::parse($data['student']->dob)->diff(Carbon::now())->format('%y years');
        // $data['certificates'] = DB::table('certificate')->where('user_id', $current_user_id)->first();
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
    public function attendance(Request $request)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $checked_attendance = Attendance::where('user_id', Auth::user()->id)->latest()->get();
            return view('hr.attendance',compact('checked_attendance'));
        }
    }
    public function manageEvevnt(Request $request)
    {
            return view('hr.manage_event');
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


    
}
