<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Mockery\Matcher\Not;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::latest()->get();
        return view('admin.notification.index',compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notification.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|string|max:255',
            'date'  => 'required|date',
            'time'  => 'required'
        ]);

        $notification = new Notification();
        $notification->title = $request->title;
        $notification->date = $request->date;
        $notification->time = $request->time;
        $notification->save();
        return redirect()->route('admin.notification.index')->with('success','Notification added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification_details = Notification::find($id);
        return view('admin.notification.view',compact('notification_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notification_details = Notification::find($id);
        return view('admin.notification.edit',compact('notification_details'));
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
            'title' => 'required|string|max:255',
            'date'  => 'required|date',
            'time'  => 'required'
        ]);

        $notification = Notification::find($id);
        $notification->title = $request->title;
        $notification->date = $request->date;
        $notification->time = $request->time;
        $notification->save();
        return redirect()->route('admin.notification.index')->with('success','Notification update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Notification::find($id)->delete();
        return redirect()->route('admin.notification.index')->with('success','Notification deleted successfully');
    }
}
