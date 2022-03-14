<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Notification;
use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Group;
use App\Models\HomeTask;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeTaskController extends Controller
{
    public function index()
    {
        $data['tasks'] = HomeTask::where('user_id', Auth::user()->id)->latest()->get();
        return view('teacher.home_task.index')->with($data);
    }

    public function create()
    {
        $data = array();
        if (Auth::user()->class_access == 1) {
            $data['classes'] = Classes::latest()->get();
        }else{
            $data['classes'] = [];
        }
        $data['groups'] = Group::latest()->where('teacher_id', Auth::user()->id)->get();
        $data['subjects'] = Subject::latest()->get();
        return view('teacher.home_task.create')->with($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'class' => 'required',
            'subject' => 'required',
            'submission_date' => 'required|date',
            'submission_time' => 'required|date_format:H:i',
            'upload_file' => 'required|mimes:pdf'
        ]);
        // dd($request->all);

        if ($request->hasFile('upload_file')) {
            $file = $request->file('upload_file');
            $fileName = imageUpload($file, 'teacher/home_task');
        } else {
            $fileName = null;
        }

        $class = $request->class;
        $after_explode_class = explode('-', $class);

        $user_id = Auth::user()->id;

        $homeTask = new HomeTask();
        $homeTask->user_id = $user_id;
        if ($after_explode_class[1] === 'class') {
            $homeTask->class = $after_explode_class[0];
            $homeTask->group_id = null;
            createNotification($user_id, $after_explode_class[0], 0, 'teacher_upload_homework');
            // dd($notifi);
        }
        if ($after_explode_class[1] === 'group') {
            $homeTask->group_id = $after_explode_class[0];
            // dd($after_explode_class[0]);
            $homeTask->class = null;
            createNotification($user_id, 0, $after_explode_class[0], 'teacher_upload_homework');
        }
        $homeTask->subject = $request->subject;
        $homeTask->submission_date = date('Y-m-d',strtotime($request->submission_date));
        $homeTask->submission_time = $request->submission_time;
        $homeTask->upload_file = $fileName;
        $homeTask->save();

        // dd($homeTask);

        // createNotification($user_id, $class, 0, 'teacher_upload_homework');


        $notification = new Notification();
        $notification->user_id = $user_id;
        if ($after_explode_class[1] === 'class') {
            $notification->class_id = $after_explode_class[0];
        } elseif ($after_explode_class[1] === 'group') {
            $notification->group_id = $after_explode_class[0];
        }
        $notification->type = 'teacher_upload_homework';
        $notification->title = 'Homework uploaded successfully';
        $notification->message = 'Please Update and update as needed';
        $notification->route = 'teacher.homeTask';
        $notification->save();

        return redirect()->route('teacher.homeTask')->with('success', 'Task upload successfully');
    }
}
