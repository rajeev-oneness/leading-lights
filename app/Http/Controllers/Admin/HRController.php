<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Notifications\WelcomeMail;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Notifications\AccountActivationMail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Notifications\AccountDeactivateMail;
use App\Notifications\RejectionMail;
use Illuminate\Support\Facades\Notification;

class HRController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_hr_details = User::where('role_id',2)->latest()->get();
       
        return view('admin.hr.index',compact('all_hr_details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hr.create');
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
        $id_no = 'LLHR'.$unique_id;
        $this->validate($request,[
            'first_name' => 'required | string| max:255',
            'last_name' => 'required | string| max:255',
            'email' => 'required|email | unique:users',
            'doj' => 'required|date',
        ]);

        $teacher = new User;
        $teacher->first_name = $request->first_name;
        $teacher->last_name = $request->last_name;
        $teacher->email = $request->email;
        $teacher->password = Hash::make($id_no);
        $teacher->doj = $request->doj;
        $teacher->role_id = 2;
        $teacher->id_no = $id_no;
        $teacher->save();

        //Send notification

        // Notification::route('mail', $request->email)->notify(new WelcomeMail($teacher,$request->password));
        return redirect()->route('admin.hr.index')->with('success','HR added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['hr'] = User::find($id);
        $data['certificates'] = Certificate::where('user_id',$id)->get();
        return view('admin.hr.view')->with($data);
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
        $data['hr_details'] = User::find($id);
        return view('admin.hr.edit')->with($data);
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
            'doj' => 'required',
            'address' => 'max:255',
            'image' => 'image |mimes:png,jpg',
        ]);
        $hr = User::find($id);

        if($request->hasFile('image')){
            $image = $request->file('image');
            if ($hr->image) {
                $image_name = explode('/', $hr->image)[2];
                if(File::exists('upload/profile_image/'.$image_name)) {
                    File::delete('upload/profile_image/'.$image_name);
                }
            }
            $imageName = imageUpload($image,'profile_image');
        }else{
            $imageName = $hr->image;
        }
        $hr->first_name = $request->first_name;
        $hr->last_name = $request->last_name;
        $hr->gender = $request->gender;
        $hr->mobile = $request->mobile;
        $hr->doj = $request->doj;
        $hr->address = $request->address;
        $hr->image = $imageName;
        $hr->save();
        return redirect()->route('admin.hr.index')->with('success','HR details updated');
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
        Event::where('user_id',$id)->delete();
        return redirect()->route('admin.hr.index')->with('success','Teacher deleted');
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
        $user = User::find($id);
        if ($user->status == 0) {
            $user->status = 1;
            $user->save();
            Notification::route('mail', $user->email)->notify(new WelcomeMail($user));
            return response()->json(['success' => true,'data' => 'activated']);
        }
        if ($user->status == 1) {
            $user->status = 0;
            $user->save();
            Notification::route('mail', $user->email)->notify(new AccountDeactivateMail($user));
            return response()->json(['success' => true,'data' => 'inactivated']);
        }       
    }
    public function reject_hr($id){
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
            $user->password = Hash::make($user->id_no);
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
