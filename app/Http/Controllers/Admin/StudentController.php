<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Notifications\WelcomeMail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $students = User::where('role_id',4)->latest()->get();
       
       return view('admin.student.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classes::latest()->get();
        return view('admin.student.create',compact('classes'));
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
            'first_name' => 'required |string| max:255',
            'last_name' => 'required |string| max:255',
            'email' => 'required|email | unique:users',
            'class' => 'required',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $total_students = User::where('role_id',4)->count();

        $student = new User;
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->id_no = 'LLST'.$unique_id;
        $student->roll_no = $total_students+1;
        $student->class = $request->class;
        $student->save();

        //Send notification
        // dd($student);
        Notification::route('mail', $request->email)->notify(new WelcomeMail($student,$request->password));

        return redirect()->route('admin.students.index')->with('success','Student added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = User::find($id);
        return view('admin.student.view',compact('student'));
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
        $this->validate($request,[
            'first_name' => 'required |string| max:255',
            'last_name' => 'required |string| max:255',
            'mobile' => 'max:10',
            'dob' => 'date|nullable',
            'fathers_name' => 'max:255',
            'address' => 'max:255',
            'image' => 'image |mimes:png,jpg'
        ]);
        $student = User::find($id);

        if($request->hasFile('image')){
            $image = $request->file('image');
            if ($student->image !== 'default.png') {
                $image_name = explode('/', $student->image)[2];
                if(File::exists('upload/profile_image/'.$image_name)) {
                    File::delete('upload/profile_image/'.$image_name);
                }
            }
            $imageName = imageUpload($image,'profile_image');
        }else{
            $imageName = $student->image;
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
        $student->fathers_name = $request->fathers_name;
        $student->status = $request->status;
        $student->save();
        return redirect()->route('admin.students.index')->with('success','Student updated');
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
        return redirect()->route('admin.students.index')->with('success','Student deleted');
    }

    public function getCode(){
        $code = generateUniqueCode();
        $checkExisting = User::where('id_no',$code)->count();
        if ($checkExisting == 0) {
            return $code;
        }
        return $this->getCode();
    }

    public function approval($id){
        $user = User::find($id);
        if ($user->status == 0) {
            $user->status = 1;
            $user->save();
            return response()->json(['success' => true,'data' => 'activated']);
        }
        if ($user->status == 1) {
            $user->status = 0;
            $user->save();
            return response()->json(['success' => true,'data' => 'inactivated']);
        }       
    }
}
