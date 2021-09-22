<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcement::latest()->get();
        return view('admin.announcement.index',compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.announcement.create');
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
            'title' => 'required|max:255',
            'date'  => 'date|required',
            'description' => 'required'
        ]);

        $announcement = new Announcement();
        $announcement->title = $request->title;
        $announcement->date = $request->date;
        $announcement->description = $request->description;
        $announcement->save();
        return redirect()->route('admin.announcement.index')->with('success','Announcement created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $announcement_details = Announcement::find($id);
        return view('admin.announcement.view',compact('announcement_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $announcement_details = Announcement::find($id);
        return view('admin.announcement.edit',compact('announcement_details'));
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
            'title' => 'required|max:255',
            'date'  => 'date|required',
            'description' => 'required'
        ]);

        $announcement = Announcement::find($id);
        $announcement->title = $request->title;
        $announcement->date = $request->date;
        $announcement->description = $request->description;
        $announcement->save();
        return redirect()->route('admin.announcement.index')->with('success','Announcement updated');
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
