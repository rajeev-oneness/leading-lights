<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_is', Auth::user()->id)->get();
        dd($notifications);
        return view('hr.layouts.header', compact('notifications'));
    }
}
