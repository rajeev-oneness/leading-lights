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

    public function updateRole(Request $req)
    {
       $teacher_details = User::find($req->teacher_id);
       $special_approve_status = $teacher_details->is_special_approved;
       if ($special_approve_status == 0) {
         $teacher_details->is_special_approved = 1;
         $teacher_details->save();
         return redirect()->back()->with('success',"Successfully updated");
       }
       if ($special_approve_status == 1) {
        $teacher_details->is_special_approved = 0;
        $teacher_details->save();
        return redirect()->back()->with('success',"Successfully updated");
      }
    }
}
