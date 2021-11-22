<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
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

    public function notificationReadAll(Request $request)
    {
        $user = Auth::user();
        $noti = Notification::where('user_id', '=', $user->id)->where('read_flag', '=', '0')->update(['read_flag' => 1]);
    }
}
