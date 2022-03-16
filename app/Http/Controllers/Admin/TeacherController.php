<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\WelcomeMail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\AccountActivationMail;
use App\Notifications\RejectionMail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Notifications\AccountDeactivateMail;
use Illuminate\Support\Facades\Notification;
use App\Models\Certificate;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = User::where('role_id',3)->latest()->get();;
       return view('admin.teacher.index',compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teacher.create');
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
            'first_name' => 'required | string| max:255',
            'last_name' => 'required | string| max:255',
            'email' => 'required|email | unique:users',
            'doj' => 'required',
        ],[
            'doj.required' => 'The Date Of Joining field is required'
        ]);

        $teacher_count = User::where('role_id', 3)->count();
        $num_padded = sprintf("%05d", ($teacher_count + 1));
        $id_no = 'LLTR' . $num_padded;

        $password = generatePassword(6);

        $teacher = new User;
        $teacher->first_name = $request->first_name;
        $teacher->last_name = $request->last_name;
        $teacher->email = $request->email;
        $teacher->password = Hash::make($password);
        $teacher->doj = $request->doj;
        $teacher->role_id = 3;
        $teacher->id_no = $id_no;

        $teacher->status = 1;
        $teacher->rejected = 0;
        $teacher->save();

        $user_id = $teacher->id;
        createNotification($user_id, 0, 0, 'student_registration');
        //Send notification

        Notification::route('mail', $request->email)->notify(new WelcomeMail($teacher,$password));
        return redirect()->route('admin.teachers.index')->with('success','Teacher added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['teacher'] = User::find($id);
        $data['certificates'] = Certificate::where('user_id',$id)->get();
        return view('admin.teacher.view')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = User::find($id);
        return view('admin.teacher.edit',compact('teacher'));
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
        $this->validate($request,[
            'first_name' => 'required |string| max:255',
            'last_name' => 'required |string| max:255',
            'mobile' => 'required |max:10',
            'doj' => 'required |required',
            'address' => 'max:255',
            'image' => 'image |mimes:png,jpg',
        ],[
            'doj.required' => 'The Date Of Joining field is required'
        ]);
        $teacher = User::find($id);

        if($request->hasFile('image')){
            $image = $request->file('image');
            if ($teacher->image) {
                $image_name = explode('/', $teacher->image)[2];
                if(File::exists('upload/profile_image/'.$image_name)) {
                    File::delete('upload/profile_image/'.$image_name);
                }
            }
            $imageName = imageUpload($image,'profile_image');
        }else{
            $imageName = $teacher->image;
        }
        $teacher->first_name = $request->first_name;
        $teacher->last_name = $request->last_name;
        $teacher->gender = $request->gender;
        $teacher->mobile = $request->mobile;
        $teacher->doj = $request->doj;
        $teacher->address = $request->address;
        $teacher->image = $imageName;
        $teacher->save();
        return redirect()->route('admin.teachers.index')->with('success','Teacher updated');
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
        return redirect()->route('admin.teachers.index')->with('success','Teacher deleted');
    }

    public function getCode(){
        $code = generateUniqueCode();
        $checkExisting = User::where('id_no',$code)->count();
        if ($checkExisting == 0) {
            return $code;
        }
        return $this->getReferralCode();
    }

    public function approval($id){
        $password = generatePassword(6);
        $user = User::find($id);
        if ($user->status == 0) {
            $user->status = 1;
            $user->password =  Hash::make($password);
            $user->save();
            Notification::route('mail', $user->email)->notify(new WelcomeMail($user,$password));
            return response()->json(['success' => true,'data' => 'activated']);
        }
        if ($user->status == 1) {
            $user->status = 0;
            $user->save();
            Notification::route('mail', $user->email)->notify(new AccountDeactivateMail($user));
            return response()->json(['success' => true,'data' => 'inactivated']);
        }       
    }
    public function reject_teacher($id){
        $user = User::find($id);
        if ($user->rejected == 0) {
            $user->rejected = 1;
            $user->is_rejected_document_uploaded = 0;
            $user->save();
            Notification::route('mail', $user->email)->notify(new RejectionMail($user));
            return response()->json(['success' => true,'data' => 'rejected']);
        }
    }

    public function deactivate_account($id)
    {
        $user = User::findOrFail($id);
        if ($user->status == 1) {
            $user->deactivated = 1;
            $user->save();
            Notification::route('mail', $user->email)->notify(new AccountDeactivateMail($user));
            return response()->json(['success' => true,'data' => 'inactivated']);
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
}
