<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::latest()->get();
        return view('admin.groups.index',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['teachers'] = User::where('role_id',3)->latest()->get();
        $data['students'] = User::where('role_id',4)->latest()->get();
        return view('admin.groups.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student_ids = $request->student_ids;
        $teacher_id = $request->teacher_id;
        // dd($request->student_ids);
        Validator::make($request->all(), [
            'student_ids' => 'required',
            'teacher_id' => 'required',
            'name' => 'required|unique:student_groups'
        ], $messages = [
            'name.required' => 'The group name field is required.',
            'name.unique' => 'The group name  must  be unique',
            'teacher_id.required' => 'The teacher must be assigned',
            'student_ids.required' => 'Please choose any of students'
        ])->validate();

        
        $group = new Group();
        $group->name = $request->name;
        $group->teacher_id = $request->teacher_id;
        $group->student_ids = implode(',', $student_ids);
        $group->save();

        $group_id = $group->id;
        //group id assignment
        //For teacher
        $user = User::find($teacher_id);
        if ($user->group_ids) {
            $user->group_ids = $user->group_ids.','.$group_id;
        }else{
            $user->group_ids = $group_id;
        }
        $user->save();
        //For students
        foreach ($student_ids as $key => $id) {
            $user = User::find($id);
            if ($user->group_ids) {
                $user->group_ids = $user->group_ids.','.$group_id;
            }else{
                $user->group_ids = $group_id;
            }
            $user->save();
        }

        return redirect()->route('admin.groups.index')->with('success','Group successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['teachers'] = User::where('role_id',3)->latest()->get();
        $data['students'] = User::where('role_id',4)->latest()->get();
        $data['group'] = Group::findOrFail($id);
        $selected_students = $data['group']->student_ids;
        $student_ids= explode(',',$selected_students);
        foreach ($student_ids as $student_id) {
            $student_details[] = User::where('id',$student_id)->first();
        }
        $data['student_details'] = $student_details;
        // dd($data);
        return view('admin.groups.view')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['teachers'] = User::where('role_id',3)->latest()->get();
        $data['students'] = User::where('role_id',4)->latest()->get();
        $data['group'] = Group::findOrFail($id);
        return view('admin.groups.edit')->with($data);
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
        $student_ids = $request->student_ids;
        $teacher_id = $request->teacher_id;
        Validator::make($request->all(), [
            'student_ids' => 'required',
            'teacher_id' => 'required',
            'name' => 'required'
        ], $messages = [
            'name.required' => 'The group name field is required.',
            'name.unique' => 'The group name  must  be unique',
            'teacher_id.required' => 'The teacher must be assigned',
            'student_ids.required' => 'Please choose any of students'
        ])->validate();
        $group =  Group::find($id);
        $assigned_teacher_id = $group->teacher_id;
        $assigned_students_ids = $group->student_ids;
        $group->name = $request->name;
        $group->teacher_id = $request->teacher_id;
        $group->student_ids = implode(',', $request->student_ids);
        $group->save();

        $group_id = $group->id;
        //group id assignment
        //For teacher
        $assigned_teacher_details = User::find($assigned_teacher_id);
        $assigned_teacher_details->group_ids = null;
        $assigned_teacher_details->save();

        $user = User::find($teacher_id);
        $user->group_ids = $group_id;
        $user->save();

        //For students

        $all_student_ids= explode(',',$assigned_students_ids);
        foreach ($all_student_ids as $key => $id) {
            $assigned_student_details = User::find($id);
            $assigned_student_details->group_ids = null;
            $assigned_student_details->save();
        }

        foreach ($student_ids as $key => $id) {
            $user = User::find($id);
            if ($user->group_ids) {
                $user->group_ids = $user->group_ids.','.$group_id;
            }else{
                $user->group_ids = $group_id;
            }
            $user->save();
        }

        return redirect()->route('admin.groups.index')->with('success','Group successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
