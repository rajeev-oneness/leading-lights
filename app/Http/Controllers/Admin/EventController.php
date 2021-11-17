<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\Classes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $events = Event::latest()->get();
       return view('admin.event.index',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classes::orderBy('name')->get();
        return view('admin.event.create',compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'class' => 'required',
            'title' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'desc' => 'required|max:500',
            'image' => 'required|mimes:jpeg,png,jpg'
        ], $messages = [
            'desc.required' => 'The description field is required.',
            'class.required' => 'The class/group field is required.',
        ])->validate();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = imageUpload($file, 'hr/event');
        } else {
            $fileName = null;
        }

        $class = $request->class;
        $after_explode_class = explode('-',$class);

        $event = new Event();
        $event->user_id = Auth::user()->id;
        if ($after_explode_class[1] === 'class') {
            $event->class_id = $after_explode_class[0];
            $event->group_id = null;
        }
        if ($after_explode_class[1] === 'group') {
            $event->group_id = $after_explode_class[0];
            $event->class_id = null;
        }
        $event->title = $request->title;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->desc = $request->desc;
        $event->image = $fileName;
        $event->save();

        return redirect()->route('admin.events.index')->with('success', 'Event upload successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event_details = Event::find($id);
        return view('admin.event.view',compact('event_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Event::find($id)->delete();
        return redirect()->back()->with('success','Event deleted');
    }
}
