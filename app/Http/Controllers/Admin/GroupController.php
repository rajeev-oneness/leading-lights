<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Classes;
use Illuminate\Support\Facades\Validator;
use App\Traits\MessageChattings;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use MessageChattings;

    public function index()
    {
        $groups = Group::latest()->get();
        return view('admin.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['teachers'] = User::where('role_id', 3)->latest()->get();
        $data['students'] = User::select('classes.name as class_name', 'users.id as user_id', 'users.id_no as id_no', 'users.first_name as first_name', 'users.last_name as last_name')->where('role_id', 4)
            ->join('classes', 'classes.id', '=', 'users.class')
            ->orderBy('users.created_at', 'DESC')
            ->get();
        $data['classes'] = Classes::orderBy('name')->get();
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
            'class_id' => 'required',
            'name' => 'required|unique:student_groups'
        ], $messages = [
            'name.required' => 'The group name field is required.',
            'name.unique' => 'The group name  must  be unique',
            'teacher_id.required' => 'Please choose available teacher',
            'student_ids.required' => 'Please choose available students',
            'class_id.required' => 'Please choose available class',
        ])->validate();


        $group = new Group();
        $group->name = $request->name;
        $group->teacher_id = $request->teacher_id;
        $group->class_id = $request->class_id;
        $group->student_ids = implode(',', $student_ids);
        $group->save();

        $group_id = $group->id;
        //group id assignment
        //For teacher
        $teacher = User::find($teacher_id);
        if ($teacher->group_ids) {
            $teacher->group_ids = $teacher->group_ids . ',' . $group_id;
        } else {
            $teacher->group_ids = $group_id;
        }
        $teacher->save();
        //For students
        foreach ($student_ids as $key => $id) {
            $student = User::find($id);
            if ($student->group_ids) {
                $student->group_ids = $student->group_ids . ',' . $group_id;
            } else {
                $student->group_ids = $group_id;
            }
            $student->save();
            $requestForChat = new Request([
                'senderId' => $teacher->id,
                'receiverId' => $student->id
            ]);
            $this->sendMessageUniversal($requestForChat);
        }

        return redirect()->route('admin.groups.index')->with('success', 'Group successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $data['teachers'] = User::where('role_id', 3)->latest()->get();
        $data['students'] = User::select('classes.name as class_name', 'users.id as user_id', 'users.id_no as id_no', 'users.first_name as first_name', 'users.last_name as last_name')->where('role_id', 4)
            ->join('classes', 'classes.id', '=', 'users.class')
            ->orderBy('users.created_at', 'DESC')
            ->get();
        $data['group'] = Group::findOrFail($id);
        // $data['classes'] = Classes::find($data['group']->id);
        $data['classes'] = Classes::findOrFail($data['group']->class_id);
        $selected_students = $data['group']->student_ids;
        $student_ids = explode(',', $selected_students);
        foreach ($student_ids as $student_id) {
            $student_details[] = User::where('id', $student_id)->first();
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
        $data['group'] = Group::findOrFail($id);
        $data['teachers'] = User::where('role_id', 3)->latest()->get();
        $data['students'] = User::select('classes.name as class_name', 'users.id as user_id', 'users.id_no as id_no', 'users.first_name as first_name', 'users.last_name as last_name')->where('role_id', 4)
            ->join('classes', 'classes.id', '=', 'users.class')
            ->orderBy('users.created_at', 'DESC')
            ->get();

        // $data['selected_students'] = User::where('group_ids',  $data['group'])->get();

        // dd($data['selected_students']);
        $data['classes'] = Classes::orderBy('name')->get();
        $data['students_by_grooup'] = Classes::orderBy('name')->get();

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
            'name' => 'required',
            'class_id' => 'required',
        ], $messages = [
            'name.required' => 'The group name field is required.',
            'name.unique' => 'The group name  must  be unique',
            'teacher_id.required' => 'The teacher must be assigned',
            'student_ids.required' => 'Please choose any of students',
            'class_id.required' => 'Please choose available class',
        ])->validate();
        $group =  Group::find($id);
        $assigned_teacher_id = $group->teacher_id;
        $assigned_students_ids = $group->student_ids;
        $group->name = $request->name;
        $group->teacher_id = $request->teacher_id;
        $group->student_ids = implode(',', $request->student_ids);
        $group->class_id = $request->class_id;
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

        $all_student_ids = explode(',', $assigned_students_ids);
        foreach ($all_student_ids as $key => $id) {
            $assigned_student_details = User::find($id);
            $assigned_student_details->group_ids = null;
            $assigned_student_details->save();
        }

        foreach ($student_ids as $key => $id) {
            $user = User::find($id);
            if ($user->group_ids) {
                $user->group_ids = $user->group_ids . ',' . $group_id;
            } else {
                $user->group_ids = $group_id;
            }
            $user->save();
        }

        return redirect()->route('admin.groups.index')->with('success', 'Group successfully updated');
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
