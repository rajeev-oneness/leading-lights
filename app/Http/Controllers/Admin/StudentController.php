<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Classes;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Notifications\WelcomeMail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Notifications\AccountActivationMail;
use App\Notifications\AccountDeactivateMail;
use App\Notifications\ActivateAccount;
use App\Notifications\RejectionMail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\SpecialCourse;
use App\Models\Video;
use App\Notifications\WelcomeMailForPaidUsers;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = User::where('role_id', 4)->latest()->get();

        return view('admin.student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classes::latest()->get();
        return view('admin.student.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required |string| max:255',
            'last_name' => 'required |string| max:255',
            'email' => 'required|email | unique:users',
            'class' => 'required',
        ]);        
        $student_count = User::where('role_id', 4)->count();
        $num_padded = sprintf("%05d", ($student_count + 1));
        $id_no = 'LLST' . $num_padded;
            
        // $password = Str::random(10);
        $student = new User;
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->email = $request->email;
        $student->password = Hash::make($id_no);
        $student->id_no = $id_no;
        $student->class = $request->class;
        $student->role_id = 4;
        $student->save();

        //Send notification
        // Notification::route('mail', $request->email)->notify(new WelcomeMail($student));

        // Fee generate
        $feedata = [];
        if($student->class > 0){
            if (empty($data['special_course_ids'])){
                $check_class = Classes::where('id', $student->class)->first();
                if ($check_class) {
                    $next_date = date('Y-m-d',strtotime('first day of +2 month'));
                    $next_due_date = date('Y-m-d', strtotime($next_date. ' + 4 days'));
                    $feedata[] = [
                        'user_id' => $student->id,
                        'class_id' => $check_class->id,
                        'course_id' => 0,
                        'fee_type' => 'admission_fee',
                        'due_date' => $next_due_date,
                        'payment_month' => date('F',strtotime($next_due_date)),
                        'amount' => $check_class->monthly_fees + $check_class->admission_fees,
                    ];
                }
            }
        }

        if (count($feedata) > 0) {
            DB::table('fees')->insert($feedata);
        }

        return redirect()->route('admin.students.index')->with('success', 'Student added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['student'] = User::find($id);
        $data['student_age'] = Carbon::parse($data['student']->dob)->diff(Carbon::now())->format('%y years');
        $data['certificates'] = Certificate::where('user_id', $id)->get();
        return view('admin.student.view')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array();
        $data['student'] = User::find($id);
        $data['classes'] = Classes::latest()->get();
        $data['special_courses'] = SpecialCourse::latest()->get();
        return view('admin.student.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required |string| max:255',
            'last_name' => 'required |string| max:255',
            'mobile' => 'max:10',
            'dob' => 'nullable',
            'address' => 'max:255',
            'image' => 'mimes:png,jpg'
        ]);
        $student = User::find($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($student->image !== 'default.png') {
                $image_name = explode('/', $student->image)[2];
                if (File::exists('upload/profile_image/' . $image_name)) {
                    File::delete('upload/profile_image/' . $image_name);
                }
            }
            $imageName = imageUpload($image, 'profile_image');
        } else {
            $imageName = $student->image;
        }

        $special_course_ids = $request->special_course_ids;
        // $group->class_id = $request->class_id;
        if ($special_course_ids) {
            $s_course_ids= implode(',', $special_course_ids);
        }

        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->gender = $request->gender;
        $student->class = $request->class;
        // $student->email = $request->email;
        $student->mobile = $request->mobile;
        $student->dob = $request->dob;
        $student->address = $request->address;
        $student->image = $imageName;
        // $student->fathers_name = $request->fathers_name;
        $student->special_course_ids = $s_course_ids;
        $student->save();
        return redirect()->route('admin.students.index')->with('success', 'Student details updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        Payment::where('user_id', $id)->delete();
        return redirect()->route('admin.students.index')->with('success', 'Student deleted');
    }

    public function getCode()
    {
        $code = generateUniqueCode();
        $checkExisting = User::where('id_no', $code)->count();
        if ($checkExisting == 0) {
            return $code;
        }
        return $this->getCode();
    }

    public function approval($id)
    {
        $user = User::findOrFail($id);
        if ($user->status == 0) {
            $user->status = 1;
            $user->rejected = 0;
            $user->save();
            Notification::route('mail', $user->email)->notify(new WelcomeMail($user));
            return response()->json(['success' => true, 'data' => 'activated']);
        }
    }

    public function reject_student($id)
    {
        $user = User::findOrFail($id);
        if ($user->rejected == 0) {
            $user->rejected = 1;
            $user->is_rejected_document_uploaded = 0;
            $user->save();
            Notification::route('mail', $user->email)->notify(new RejectionMail($user));
            return response()->json(['success' => true, 'data' => 'rejected']);
        }
    }

    public function deactivate_account($id)
    {
        $user = User::findOrFail($id);
        if ($user->status == 1) {
            $user->deactivated = 1;
            $user->save();
            Notification::route('mail', $user->email)->notify(new AccountDeactivateMail($user));
            return response()->json(['success' => true, 'data' => 'inactivated']);
        }
    }
    public function activate_account($id)
    {
        $user = User::findOrFail($id);
        if ($user->status == 1) {
            $user->deactivated = 0;
            $user->save();
            Notification::route('mail', $user->email)->notify(new AccountActivationMail($user));
            return response()->json(['success' => true,'data' => 'inactivated']);
        }
    }
    /**
     * Registration Filter
     */
    public function studentRegistrationFilter(Request $request){
        // dd($request->all());
        //For regular class users
        // if ($request->registration_type === 'regular_class') {
            $classes = Classes::latest()->get();
            return view('admin.student.create', compact('classes'));
        // }
    }

    /**
     * Registration For Regular Class Student
     */

    public function studentRegistrationForRegularClass(Request $request){
        if ($request->method() == 'GET') {
           $data = array();
           $data['classes'] = Classes::latest()->get();;
           return view('admin.student.auth.regular_class_registration')->with($data);
        } else if ($request->method() == 'POST') {
            $this->validate($request,[
                'first_name' => 'required |string| max:255',
                'last_name' => 'required |string| max:255',
                'email' => 'required|email | unique:users',
                'class' => 'required',
            ]);
     
            $student_count = User::where('role_id', 4)->count();
            $num_padded = sprintf("%05d", ($student_count + 1));
            $id_no = 'LLST' . $num_padded;
                
            // $password = Str::random(10);
            $student = new User;
            $student->first_name = $request->first_name;
            $student->last_name = $request->last_name;
            $student->email = $request->email;
            $student->password = Hash::make($id_no);
            $student->id_no = $id_no;
            $student->class = $request->class;
            $student->role_id = 4;
            $student->registration_type = 1;
    
            $student->status = 1;
            $student->rejected = 0;
            $student->save();

            $user_id = $student->id;
            createNotification($user_id, 0, 0, 'student_registration');
            Notification::route('mail', $student->email)->notify(new WelcomeMailForPaidUsers($student));
    
            // Fee generate
            $feedata = [];
            if($student->class > 0){
                if (empty($data['special_course_ids'])){
                    $check_class = Classes::where('id', $student->class)->first();
                    if ($check_class) {
                        $next_date = date('Y-m-d',strtotime('first day of +2 month'));
                        $next_due_date = date('Y-m-d', strtotime($next_date. ' + 4 days'));
                        $feedata[] = [
                            'user_id' => $student->id,
                            'class_id' => $check_class->id,
                            'course_id' => 0,
                            'fee_type' => 'admission_fee',
                            'due_date' => $next_due_date,
                            'payment_month' => date('F',strtotime($next_due_date)),
                            'amount' => $check_class->monthly_fees + $check_class->admission_fees,
                        ];
                    }
                }
            }
    
            if (count($feedata) > 0) {
                DB::table('fees')->insert($feedata);
            }
    
            return redirect()->route('admin.students.index')->with('success', 'Student added');   
        }

    }

    /**
     * Registration For Special Course Student
     */

     public function studentRegistrationForSpecialCourse(Request $request){
         if ($request->method() == 'GET') {
            $data = array();
            $data['classes'] = Classes::latest()->get();
            $data['special_courses'] = SpecialCourse::where('class_id',null)->latest()->get();
            return view('admin.student.auth.special_course_registration')->with($data);
         }
         else if ($request->method() == 'POST') {
            $this->validate($request,[
                'first_name' => 'required |string| max:255',
                'last_name' => 'required |string| max:255',
                'email' => 'required|email | unique:users'
            ]);

            $student_count = User::where('role_id', 4)->count();
            $num_padded = sprintf("%05d", ($student_count + 1));
            $id_no = 'LLST' . $num_padded;

            if (isset($request['special_course_ids'])) {
                $special_course_ids = implode(',', $request['special_course_ids']);
                $admission_type = 2;
            } else {
                $special_course_ids = null;
                $admission_type = 1;
            }
                
            $user = new User();
            $user->first_name = $request['first_name'];
            $user->last_name = $request['last_name'];
            $user->email = $request['email'];
            $user->id_no =  $id_no;
            $user->class = $request['class'];
            $user->password = Hash::make($id_no);
            $user->special_course_ids = $special_course_ids;
            $user->registration_type = $admission_type;
            $user->save();

            $user->status = 1;
            $user->rejected = 0;
            $user->save();

            $user_id = $user->id;
            createNotification($user_id, 0, 0, 'student_registration');
            Notification::route('mail', $user->email)->notify(new WelcomeMailForPaidUsers($user));

            // Fee generate
            $feedata = [];
            if (!empty($request['special_course_ids']) && count($request['special_course_ids']) > 0) {
                foreach ($request['special_course_ids'] as $key => $course) {
                    $s_course = SpecialCourse::where('id', $course)->first();
                    $course_start_date = $s_course->start_date;
                    if ($s_course) {
                        $next_date = date('Y-m-01',strtotime($course_start_date));
                        $next_due_date = date('Y-m-d', strtotime($next_date. ' + 4 days'));
                        $feedata[] = [
                            'user_id' => $user->id,
                            'class_id' => 0,
                            'course_id' => $s_course->id,
                            'fee_type' => 'course_fee',
                            'due_date' => $next_due_date,
                            'payment_month' => date("F",strtotime($course_start_date)),
                            'amount' => $s_course->monthly_fees,
                        ];
                    }
                }
            }

            if (count($feedata) > 0) {
                DB::table('fees')->insert($feedata);
            }

            return redirect()->route('admin.students.index')->with('success', 'Student added'); 
         }
     }

    /**
     * Registration For Flash Course Student
     */
     public function studentRegistrationForFlashCourse(Request $request){
        if ($request->method() == 'GET') {
            $data = array();
            $data['flash_courses'] = Course::latest()->get();
            return view('admin.student.auth.flash_course_registration')->with($data);
        }
        else if ($request->method() == 'POST') {
            $this->validate($request,[
                'first_name' => 'required |string| max:255',
                'last_name' => 'required |string| max:255',
                'email' => 'required|email | unique:users',
                'class' => 'required',
            ]);

            $student_count = User::where('role_id', 4)->count();
            $num_padded = sprintf("%05d", ($student_count + 1));
            $id_no = 'LLST' . $num_padded;

            // Store student details
            $user = new User();
            $user->first_name = $request['first_name'];
            $user->last_name = $request['last_name'];
            $user->email = $request['email'];
            $user->password = Hash::make($id_no);
            $user->flash_course_id = $request['class'];
            $user->registration_type = 3;
            $user->id_no =  $id_no;
            $user->save();

            $user_id = $user->id;

            $user->status = 1;
            $user->rejected = 0;
            $user->save();

            createNotification($user_id, 0, 0, 'student_registration');
            Notification::route('mail', $user->email)->notify(new WelcomeMailForPaidUsers($user));

            // Fee generate
            $feedata = [];
            if($user->flash_course_id > 0){
                $s_course = Course::where('id', $request['class'])->first();
                $course_start_date = $s_course->start_date;
                if ($s_course) {
                    // $next_date = date('Y-m-01',strtotime($course_start_date));
                    // $next_due_date = date('Y-m-d', strtotime($next_date. ' + 4 days'));
                    $feedata[] = [
                        'user_id' => $user->id,
                        'class_id' => 0,
                        'course_id' => 0,
                        'flash_course_id' => $s_course->id,
                        'fee_type' => 'flash_course_fee',
                        // 'due_date' => $next_due_date,
                        'payment_month' => date("F"),
                        'amount' => $s_course->fees,
                    ];
                }
            }

            if (count($feedata) > 0) {
                DB::table('fees')->insert($feedata);
            }

            return redirect()->route('admin.students.index')->with('success', 'Student added'); 
        }
     }

     public function studentRegistrationForPaidVideo(Request $request){
        if ($request->method() == 'GET') {
            $data = array();
            $data['videos'] = Video::where('video_type',1)->latest()->get();
            return view('admin.student.auth.paid_video_registration')->with($data);
        }
        else if ($request->method() == 'POST') {
            $this->validate($request,[
                'first_name' => 'required |string| max:255',
                'last_name' => 'required |string| max:255',
                'email' => 'required|email | unique:users'
            ]);

            $student_count = User::where('role_id', 4)->count();
            $num_padded = sprintf("%05d", ($student_count + 1));
            $id_no = 'LLST' . $num_padded;

            $user = new User();
            $user->first_name = $request['first_name'];
            $user->last_name = $request['last_name'];
            $user->email = $request['email'];
            $user->password = Hash::make($id_no);
            $user->video_id = $request['class'];
            $user->registration_type = 4;
            $user->id_no =  $id_no;

            $user->status = 1;
            $user->rejected = 0;
            $user->save();

            $user_id = $user->id;

            Notification::route('mail', $user->email)->notify(new WelcomeMailForPaidUsers($user));
            createNotification($user_id, 0, 0, 'student_registration');

            // Fee generate
            $feedata = [];
            if($user->video_id > 0){
                $video_details= Video::where('id', $request['class'])->first();
                if ($video_details) {
                    $feedata[] = [
                        'user_id' => $user->id,
                        'class_id' => 0,
                        'course_id' => 0,
                        'paid_video_id' => $video_details->id,
                        'fee_type' => 'paid_video_fee',
                        'payment_month' => date("F"),
                        'amount' => $video_details->amount,
                    ];
                }
            }

            if (count($feedata) > 0) {
                DB::table('fees')->insert($feedata);
            }

            return redirect()->route('admin.students.index')->with('success', 'Student added'); 
        }
     }
}
