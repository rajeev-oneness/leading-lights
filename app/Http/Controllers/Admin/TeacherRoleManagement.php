<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherRoleManagement extends Controller
{
    public function index()
    {
       $data = array();
       $data['teachers'] = User::where('role_id',3)->latest()->get();
       return view('admin.teacher-role.index')->with($data);
    }

    public function groupAccessUpdate(Request $req)
    {
       $teacher_details = User::find($req->teacher_id);
       $special_approve_status = $teacher_details->group_access;
       if ($special_approve_status == 0) {
         $teacher_details->group_access = 1;
         $teacher_details->save();
         return redirect()->back()->with('success',"Successfully updated");
       }
       if ($special_approve_status == 1) {
        $teacher_details->group_access = 0;
        $teacher_details->save();
        return redirect()->back()->with('success',"Successfully updated");
      }
    }
    public function classAccessUpdate(Request $req)
    {
       $teacher_details = User::find($req->teacher_id);
       $special_approve_status = $teacher_details->class_access;
       if ($special_approve_status == 0) {
         $teacher_details->class_access = 1;
         $teacher_details->save();
         return redirect()->back()->with('success',"Successfully updated");
       }
       if ($special_approve_status == 1) {
        $teacher_details->class_access = 0;
        $teacher_details->save();
        return redirect()->back()->with('success',"Successfully updated");
      }
    }
}
