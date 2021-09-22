<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\WelcomeMail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

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
        $unique_id = $this->getCode();
        $this->validate($request,[
            'first_name' => 'required | string| max:255',
            'last_name' => 'required | string| max:255',
            'email' => 'required|email | unique:users',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'mobile' => 'max:10',
            'dob' => 'date|nullable',
            'address' => 'max:255',
            'image' => 'image |mimes:png,jpg'
        ]);

        $teacher = new User;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = imageUpload($image,'profile_image');
        }else{
            $imageName = 'default.png';
        }
        $teacher->first_name = $request->first_name;
        $teacher->last_name = $request->last_name;
        $teacher->gender = $request->gender;
        $teacher->class = $request->class;
        $teacher->section = $request->section;
        $teacher->email = $request->email;
        $teacher->password = Hash::make($request->password);
        $teacher->mobile = $request->mobile;
        $teacher->dob = $request->dob;
        $teacher->address = $request->address;
        $teacher->image = $imageName;
        $teacher->role_id = 3;
        $teacher->id_no = 'LLT'.$unique_id;
        $teacher->save();

        //Send notification

        Notification::route('mail', $request->email)->notify(new WelcomeMail($teacher,$request->password));
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
        $teacher = User::find($id);
        return view('admin.teacher.view',compact('teacher'));
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
            // 'email' => 'email',
            'mobile' => 'max:10',
            'dob' => 'date|nullable',
            'address' => 'max:255',
            'image' => 'image |mimes:png,jpg',
        ]);
        $teacher = User::find($id);

        if($request->hasFile('image')){
            $image = $request->file('image');
            if ($teacher->image !== 'default.png') {
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
        $teacher->class = $request->class;
        $teacher->section = $request->section;
        // $teacher->email = $request->email;
        $teacher->mobile = $request->mobile;
        $teacher->dob = $request->dob;
        $teacher->address = $request->address;
        $teacher->image = $imageName;
        $teacher->status = $request->status;
        $teacher->fathers_name = $request->fathers_name;
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
}
