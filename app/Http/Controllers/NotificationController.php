<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function notificationRead(Request $request)
    {
        $noti = Notification::findOrFail($request->id);
        $noti->read_flag = 1;
        $noti->save();
    }

    public function logsNotification(Request $request)
    {
        $user = Auth::user();
        // $data = Notification::where('user_id', $user->id)->latest();
        $notifications = Notification::where('user_id', '=', $user->id)->where('read_flag', '=', '0')->get();;
        return view('hr.notification', compact('notifications'));
    }

    public function logsNotificationForStudentEvent(Request $request)
    {
        $user = Auth::user();
        // $data = Notification::where('user_id', $user->id)->latest();
        $notifications = Notification::where('user_id', '=', $user->id)->where('read_flag', '=', '0')->get();;
        return view('student.notification', compact('notifications'));
    }

    public function logsNotificationForTeacher(Request $request)
    {
        $user = Auth::user();
        // $data = Notification::where('user_id', $user->id)->latest();
        $notifications = Notification::where('user_id', '=', $user->id)->where('read_flag', '=', '0')->get();;
        return view('teacher.notification', compact('notifications'));
    }

    public function notificationReadAll(Request $request)
    {
        $user = Auth::user();
        $noti = Notification::where('user_id', '=', $user->id)->where('read_flag', '=', '0')->update(['read_flag' => 1]);
    }
    // public function studentNotificationReadAll(Request $request)
    // {
    //     $user = Auth::user();
    //     $class = $user->class;
    //     // dd($class);
    //     // $noti = Notification::where('class_id', '=', $class)->where('read_flag', '=', '0')->get();
    //     $noti = Notification::where('class_id', '=', $class)->where('read_flag', '0')->update(['read_flag' => 1]);
    //     // dd($noti);
    // }
}
